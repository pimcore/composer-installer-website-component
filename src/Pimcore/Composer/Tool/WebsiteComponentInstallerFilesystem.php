<?php 
namespace Pimcore\Composer\Tool;

class WebsiteComponentInstallerFilesystem extends \Composer\Util\Filesystem
{
    public function copyThenRemove($source, $target)
    {
        $log = "/tmp/composer.log"; 
        
        $f = fopen($log, "a+");
        fwrite($f, "source: " . $source . "\n" . "target: " . $target . "\n----------\n");
        fclose($f);
        
        parent::copyThenRemove($source, $target); 
    }
}
