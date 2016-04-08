<?php 

namespace Pimcore\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
use Composer\IO\IOInterface; 
use Composer\Composer; 
use Composer\Util\Filesystem; 
use Composer\Downloader\DownloadManager;
use Composer\Repository\InstalledRepositoryInterface;
use Composer\Util\Silencer;

class WebsiteComponentInstaller extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
	    $docRootName = "./"; 
	    if($configDocRoot = $this->composer->getConfig()->get("document-root-path")) {
	        $docRootName = rtrim($configDocRoot,"/");
	    }
		
        return $docRootName . "/";
    }

    protected function installCode(PackageInterface $package)
    {
    	
    	$downloadPath = $this->getInstallPath($package) . "website/var/system/composer-website-" . uniqid() . "/";
    	mkdir($downloadPath, 0777);
        $this->downloadManager->download($package, $downloadPath);
        
        $targetPath = $this->getInstallPath($package);
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($downloadPath)) as $file) {
            if(is_file($file->getPathName())) {
                $relativePath = preg_replace("@^" . preg_quote($downloadPath, "@") . "@", "", $file->getPathName());
                if(preg_match("@^website/@", $relativePath)) {
                    $targetFile = $targetPath . $relativePath;
                    if(!is_dir(dirname($targetFile))) {
                        mkdir(dirname($targetFile), 0755, true);
                    }

                    copy($file->getPathName(), $targetFile);
                }
            }
        }
        
        // cleanup tmp
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($downloadPath, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $fileinfo) {
            $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
            $todo($fileinfo->getRealPath());
        }

        rmdir($downloadPath);
    }

    public function uninstall(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        // foo
    }

    protected function removeCode(PackageInterface $package)
    {
    	// foo
    }
    
    protected function removeBinaries(PackageInterface $package) 
    {
    	// foo
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'pimcore-website-component' === $packageType;
    }
}
