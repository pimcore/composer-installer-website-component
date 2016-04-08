<?php 

namespace Pimcore\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
use Composer\IO\IOInterface; 
use Composer\Composer; 
use Composer\Util\Filesystem; 

class WebsiteComponentInstaller extends LibraryInstaller
{
	
    public function __construct(IOInterface $io, Composer $composer, $type = 'library', Filesystem $filesystem = null) {
    	
    	$this->filesystem = new \Pimcore\Composer\Tool\WebsiteComponentInstallerFilesystem(); 
    	
    	parent::__construct($io, $composer, $type, $filesystem);
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
