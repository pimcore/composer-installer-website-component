<?php 

namespace Pimcore\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

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

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'pimcore-website-component' === $packageType;
    }
}
