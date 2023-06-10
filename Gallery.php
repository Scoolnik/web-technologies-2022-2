<?php

class Gallery
{
    private array $directories;

    function __construct(string $filesDirectory)
    {
        $this->directories = ['previews' => $filesDirectory.'/previews/',
            'original' => $filesDirectory.'/original/'];
        if (!file_exists($_SERVER['DOCUMENT_ROOT'].$filesDirectory)) {
            mkdir($_SERVER['DOCUMENT_ROOT'].$filesDirectory);
        }
        foreach ($this->directories as $dir) {
            if (!file_exists($_SERVER['DOCUMENT_ROOT'].$dir)) {
                mkdir($_SERVER['DOCUMENT_ROOT'].$dir);
            }
        }
    }

    public function getPreviews(): array
    {
        $previews = scandir($_SERVER['DOCUMENT_ROOT'].$this->directories['previews']);
        $result = [];
        foreach (array_slice($previews, 2) as $file) {
            $result[] = '<a target="_blank" href="' . $this->directories['original'] . $file . '">
            <img src="' . $this->directories['previews'] . $file . '"></a>';
        }
        return $result;
    }

    public function addImage($filePath, $fileName): void {
        move_uploaded_file($filePath, $_SERVER['DOCUMENT_ROOT'].$this->directories['original'] . '/' . $fileName);
        copy($_SERVER['DOCUMENT_ROOT'].$this->directories['original'].'/'.$fileName,
            $_SERVER['DOCUMENT_ROOT'].$this->directories['previews'].$fileName);
        $this->resizeImage($_SERVER['DOCUMENT_ROOT'].$this->directories['previews'].$fileName, 400);
    }

    /** @throws ImagickException */
    function resizeImage($imagePath, $to_height): void {
        $imagick = new Imagick($imagePath);
        $width = $imagick->getImageWidth();
        $height = $imagick->getImageHeight();
        $coef = $to_height / $height;
        $imagick->resizeImage((int)($width * $coef), (int)($height * $coef), Imagick::FILTER_TRIANGLE, 0);
        $imagick->writeImage($imagePath);
        $imagick->clear();
        $imagick->destroy();
    }
}