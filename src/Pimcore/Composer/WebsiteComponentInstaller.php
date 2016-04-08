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

    protected function updateCode(PackageInterface $initial, PackageInterface $target)
    {
        // foo
    }
    
    protected function installCode(PackageInterface $package)
    {
        // foo
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
