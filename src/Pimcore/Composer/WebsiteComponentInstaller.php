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
        return $this->getDocumentRoot() . "website/var/composer/" . $package->getName() . "/";
    }

    /**
     * @return string
     */
    protected function getDocumentRoot() {
        $docRootName = "./";
        if ($configDocRoot = $this->composer->getConfig()->get("document-root-path")) {
            $docRootName = rtrim($configDocRoot, "/");
        }

        return $docRootName . "/";
    }

    /**
     * @param PackageInterface $package
     */
    protected function installCode(PackageInterface $package)
    {
        parent::installCode($package);

        $downloadPath = $this->getInstallPath($package);
        $targetPath = $this->getDocumentRoot();

        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($downloadPath)) as $file) {
            if (is_file($file->getPathName())) {
                $relativePath = preg_replace("@^" . preg_quote($downloadPath, "@") . "@", "", $file->getPathName());
                if (preg_match("@^(website|static)/@", $relativePath)) {
                    $targetFile = $targetPath . $relativePath;
                    if (!is_dir(dirname($targetFile))) {
                        mkdir(dirname($targetFile), 0755, true);
                    }

                    if (!file_exists($targetFile)) {
                        copy($file->getPathName(), $targetFile);
                    }
                }
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'pimcore-website-component' === $packageType;
    }
}
