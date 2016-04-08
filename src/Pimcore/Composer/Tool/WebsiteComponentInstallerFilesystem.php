<?php 
namespace Pimcore\Composer\Tool;

class WebsiteComponentInstallerFilesystem extends \Composer\Util\Filesystem
{
    public function copyThenRemove($source, $target)
    {
        echo "-----> " . $target . "\n"; 
        
        parent::copyThenRemove($source, $target); 
    }
}
