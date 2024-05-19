<?php

namespace Hyder\LaravelUtils\Services;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;
use Exception;

class ZipFacadeService
{
    private $fromDir = '';
    private $toDir = '';

    public function __construct()
    {
        $this->toDir = config('laravel-utils.zip.to_dir'); // Default to directory
    }

    /**
     * Set the directory to be zipped.
     *
     * @param string $fromDir
     * @return \Hyder\Zipify\Services\ZipFacadeService
     */
    public function fromDir(string $fromDir): ZipFacadeService
    {
        $this->fromDir = $fromDir;
        return $this;
    }

    /**
     * Set the directory to save the zip file.
     *
     * @param string $toDir
     * @return \Hyder\Zipify\Services\ZipFacadeService
     */
    public function toDir(string $toDir): ZipFacadeService
    {
        $this->toDir = $toDir;
        return $this;
    }

    /**
     * Create the ZIP file.
     *
     * @param string|null $name
     * @return \Hyder\Zipify\Services\ZipFacadeService
     * @throws Exception
     */
    public function create(string $name = null)
    {
        if ($name) {
            // Ensure the name ends with .zip, replacing any existing extension
            $name = pathinfo($name, PATHINFO_FILENAME) . ".zip";
            $fileName = $this->toDir . "/" . $name;
        } else {
            // Use a timestamp for the file name if none is provided
            $fileName = $this->toDir . "/" . time() . ".zip";
        }

        // Ensure the target directory exists
        $targetDir = dirname($fileName);
        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0775, true) && !is_dir($targetDir)) {
                $error = error_get_last();
                throw new Exception("Failed to create directory: $targetDir. Error: " . $error['message']);
            }
        }

        // Remove the file if it already exists
        if (file_exists($fileName)) {
            if (!unlink($fileName)) {
                throw new Exception("Failed to delete existing file: $fileName");
            }
        }

        $zip = new ZipArchive();
        if ($zip->open($fileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            throw new Exception("Cannot open <$fileName>");
        }

        // Traverse through the directory and add files to the zip
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->fromDir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($files as $file) {
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($this->fromDir) + 1);

            if (is_dir($filePath)) {
                $zip->addEmptyDir($relativePath);
            } elseif (is_file($filePath)) {
                $zip->addFile($filePath, $relativePath);
            }
        }

        if (!$zip->close()) {
            throw new Exception("Failed to close zip archive <$fileName>");
        }

        return $this;
    }
}
