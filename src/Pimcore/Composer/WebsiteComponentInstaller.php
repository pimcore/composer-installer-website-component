<?php 

namespace Pimcore\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
use Composer\IO\IOInterface; 
use Composer\Composer; 
use Composer\Util\Filesystem; 
use Composer\Downloader\DownloadManager;

class WebsiteComponentInstaller extends LibraryInstaller
{
	
    public function __construct(IOInterface $io, Composer $composer, $type = 'library', Filesystem $filesystem = null) {
    	
     	parent::__construct($io, $composer, $type, $filesystem);

    	$this->filesystem = new \Pimcore\Composer\Tool\WebsiteComponentInstallerFilesystem(); 
    	
    	$downloadManager = new DownloadManager($io, false, $this->filesystem);
    	
    	foreach(["archive","file","git","gzip","hg","path","pear","perforce","phar","rar","svn","tar","vcs","xz","zip"] as $downloaderType) {
    	    try {
    	        $downloader = $composer->getDownloadManager()->getDownloader($downloaderType); 
    	        $downloadManager->setDownloadManager($downloaderType, $downloader); 
    	    } catch (\Exception $e) {
    	        // nothing 
    	    }
    	}
    	
    	$this->downloadManager = $downloadManager; 
    }
	
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

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'pimcore-website-component' === $packageType;
    }
}
