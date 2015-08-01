<?php
/**
 * @author Chukancev Nikita <tpxtrime@mail.ru>
 */
namespace tpmanc\imagick;

/**
 * Working with Imagemagick
 */
class Imagick
{
    private $image;

    
    private function __construct() {}

    /**
     * @param string $imagePath Path to image
     * @return tpmanc\imagick\Imagick
     */
    public static function open($imagePath)
    {
        $model = new self();
        $model->image = new \Imagick($imagePath);
        return $model;
    }

    /**
     * Save result
     * @param string $path Save path
     * @return void
     */
    public function saveTo($path)
    {
        $this->image->writeImage($path);
        $this->image->destroy();
    }

    /**
     * Create thumbnail
     * @param integer $width
     * @param integer $height
     * @return tpmanc\imagick\Imagick
     */
    public function thumb($width, $height)
    {
        if ($width >= $height) {
            $this->image->thumbnailImage($width, 0);
        } else {
            $this->image->thumbnailImage(0, $height);
        }
        return $this;
    }

    /**
     * Resize image
     * @param integer $width
     * @param integer $height
     * @return tpmanc\imagick\Imagick
     */
    public function resize($width, $height)
    {
        if ($width >= $height) {
            $this->image->adaptiveResizeImage($width, 0);
        } else {
            $this->image->adaptiveResizeImage(0, $height);
        }
        return $this;
    }
}