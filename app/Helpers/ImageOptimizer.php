<?php

namespace App\Helpers;

class ImageOptimizer
{
    /**
     * Resizes and compresses an image file to a max width/height while maintaining aspect ratio.
     * Overwrites original file.
     *
     * @param string $filePath Full file path
     * @param int $maxWidth Max width (default 1920)
     * @param int $maxHeight Max height (default 1920)
     * @param int $quality JPEG quality 0-100 (default 82)
     * @return bool True if resized/compressed, false otherwise
     */
    public static function optimize(string $filePath, int $maxWidth = 1920, int $maxHeight = 1920, int $quality = 82): bool
    {
        @ini_set('memory_limit', '512M');
        if (!file_exists($filePath) || !is_file($filePath)) {
            return false;
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
            return false;
        }

        try {
            $info = @getimagesize($filePath);
            if (!$info) {
                return false;
            }

            list($origWidth, $origHeight, $type) = $info;

            // Calculate new dimensions
            $newWidth = $origWidth;
            $newHeight = $origHeight;

            $needsResize = ($origWidth > $maxWidth || $origHeight > $maxHeight);
            $needsCompression = (filesize($filePath) > 300 * 1024); // If larger than 300KB

            if (!$needsResize && !$needsCompression) {
                return false;
            }

            if ($needsResize) {
                $ratio = min($maxWidth / $origWidth, $maxHeight / $origHeight);
                $newWidth = (int)round($origWidth * $ratio);
                $newHeight = (int)round($origHeight * $ratio);
            }

            $srcImg = null;
            switch ($type) {
                case IMAGETYPE_JPEG:
                    $srcImg = @imagecreatefromjpeg($filePath);
                    break;
                case IMAGETYPE_PNG:
                    $srcImg = @imagecreatefrompng($filePath);
                    break;
                case IMAGETYPE_WEBP:
                    if (function_exists('imagecreatefromwebp')) {
                        $srcImg = @imagecreatefromwebp($filePath);
                    }
                    break;
            }

            if (!$srcImg) {
                return false;
            }

            $dstImg = imagecreatetruecolor($newWidth, $newHeight);

            // Handle transparency for PNG/WEBP
            if ($type === IMAGETYPE_PNG || $type === IMAGETYPE_WEBP) {
                imagealphablending($dstImg, false);
                imagesavealpha($dstImg, true);
            }

            imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

            // Overwrite file with compressed JPEG/PNG
            if ($type === IMAGETYPE_PNG && $extension === 'png') {
                imagepng($dstImg, $filePath, 8); // Compression level 0-9
            } else {
                imagejpeg($dstImg, $filePath, $quality);
            }

            imagedestroy($srcImg);
            imagedestroy($dstImg);

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
