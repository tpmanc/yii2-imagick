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

    /**
     * @param string $imagePath Path to image
     */
    public function __construct($imagePath)
    {
        $this->image = new \Imagick($imagePath);
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