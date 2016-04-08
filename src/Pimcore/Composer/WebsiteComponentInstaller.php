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

    protected function removeCode(PackageInterface $package)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'pimcore-website-component' === $packageType;
    }
}
