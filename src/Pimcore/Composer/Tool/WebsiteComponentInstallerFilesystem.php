<?php 
namespace Pimcore\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class WebsiteComponentInstallerFilesystem extends \Composer\Util\Filesystem
{
    public function copyThenRemove($source, $target)
    {
        echo "-----> " . $target . "\n"; 
        
        parent::copyThenRemove($source, $target); 
    }
}
