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
    
    
    public function isDirEmpty($dir) {
        return true; 
    }
    
    public function emptyDirectory($dir, $ensureDirectoryExists = true) {
        
    }
    
    public function removeDirectory($directory) {
        
    }
    
    public function removeDirectoryPhp($directory) {
        
    }
    
    public function unlink($path) {
        return true;    
    }
    
    public function rmdir($path) {
        return true; 
    }
    
    public function remove($file) {
        return true; 
    }
}
