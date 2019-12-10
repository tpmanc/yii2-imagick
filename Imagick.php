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
     * @var integer Opened image height
     */
    private $height;

    /**
     * @var integer Opened image width
     */
    private $width;

    /**
     * Get opened image width
     * @return integer Image width
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Get opened image height
     * @return integer Image height
     */
    public function getHeight()
    {
        return $this->height;
    }
    
    /**
     * Constructor
     */
    private function __construct()
    {
    }

    /**
     * @param string $imagePath Path to image
     * @return Imagick
     */
    public static function open($imagePath)
    {
        $model = new self();
        $model->image = new \Imagick($imagePath);
        $geo = $model->image->getImageGeometry();
        $model->height = $geo['height'];
        $model->width = $geo['width'];
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
     * Add border
     * @param integer $width Border width
     * @param string $color Border color
     * @return Imagick
     */
    public function border($width, $color)
    {
        $border = new \ImagickDraw();
        $border->setFillColor('none');
        $border->setStrokeColor(new \ImagickPixel($color));
        $border->setStrokeWidth($width);
        $widthPart = $width / 2;
        $border->line(0, 0 + $widthPart, $this->width, 0 + $widthPart);
        $border->line(0, $this->height - $widthPart, $this->width, $this->height - $widthPart);
        $border->line(0 + $widthPart, 0, 0 + $widthPart, $this->height);
        $border->line($this->width - $widthPart, 0, $this->width - $widthPart, $this->height);
        $this->image->drawImage($border);
        return $this;
    }

    /**
     * Blur
     * @param float $radius
     * @param float $delta
     * @return Imagick
     */
    public function blur($radius, $delta)
    {
        $this->image->blurImage($radius, $delta);
        return $this;
    }

    /**
     * Crop image part
     * @param integer $startX
     * @param integer $startY
     * @param integer $width
     * @param integer $height
     * @return Imagick
     */
    public function crop($startX, $startY, $width, $height)
    {
        $this->image->cropImage($width, $height, $startX, $startY);
        return $this;
    }

    /**
     * Vertical mirror image
     * @return Imagick
     */
    public function flip()
    {
        $this->image->flipImage();
        return $this;
    }

    /**
     * Horizontal mirror image
     * @return Imagick
     */
    public function flop()
    {
        $this->image->flopImage();
        return $this;
    }

    /**
     * Add watermark to image
     * @param string $watermarkPath Path to watermark image
     * @param string $xPos Horizontal position - 'left', 'right' or 'center'
     * @param string $yPos Vertical position - 'top', 'bottom' or 'center'
     * @param bool|int|string $xSize Horizontal watermark size: 100, '50%', 'auto' etc.
     * @param bool|int|string $ySize Vertical watermark size: 100, '50%', 'auto' etc.
     * @param bool $xOffset
     * @param bool $yOffset
     * @return Imagick
     * @throws Exception
     */
    public function watermark(
        $watermarkPath,
        $xPos,
        $yPos,
        $xSize = false,
        $ySize = false,
        $xOffset = false,
        $yOffset = false
    ) {
        if ($watermarkPath !== null) {
            $watermark = new \Imagick($watermarkPath);

            // resize watermark
            $newSizeX = false;
            $newSizeY = false;
            if ($xSize !== false) {
                if (is_numeric($xSize)) {
                    $newSizeX = $xSize;
                } elseif (is_string($xSize) && substr($xSize, -1) === '%') {
                    $float = str_replace('%', '', $xSize) / 100;
                    $newSizeX = $this->width * ((float) $float);
                }
            }
            if ($ySize !== false) {
                if (is_numeric($ySize)) {
                    $newSizeY = $ySize;
                } elseif (is_string($ySize) && substr($ySize, -1) === '%') {
                    $float = str_replace('%', '', $ySize) / 100;
                    $newSizeY = $this->height * ((float) $float);
                }
            }
            if ($newSizeX !== false && $newSizeY !== false) {
                $watermark->adaptiveResizeImage($newSizeX, $newSizeY);
            } elseif ($newSizeX !== false && $newSizeY === false) {
                $watermark->adaptiveResizeImage($newSizeX, 0);
            } elseif ($newSizeX === false && $newSizeY !== false) {
                $watermark->adaptiveResizeImage(0, $newSizeY);
            }

            $startX = false;
            $startY = false;
            $watermarkSize = $watermark->getImageGeometry();
            if ($yPos === 'top') {
                $startY = 0;
                if ($yOffset !== false) {
                    $startY += $yOffset;
                }
            } elseif ($yPos === 'bottom') {
                $startY = $this->height - $watermarkSize['height'];
                if ($yOffset !== false) {
                    $startY -= $yOffset;
                }
            } elseif ($yPos === 'center') {
                $startY = ($this->height / 2) - ($watermarkSize['height'] / 2);
            } else {
                throw new \Exception('Param $yPos should be "top", "bottom" or "center" insteed "'.$yPos.'"');
            }

            if ($xPos === 'left') {
                $startX = 0;
                if ($xOffset !== false) {
                    $startX += $xOffset;
                }
            } elseif ($xPos === 'right') {
                $startX = $this->width - $watermarkSize['width'];
                if ($xOffset !== false) {
                    $startX -= $xOffset;
                }
            } elseif ($xPos === 'center') {
                $startX = ($this->width / 2) - ($watermarkSize['width'] / 2);
            } else {
                throw new \Exception('Param $xPos should be "left", "right" or "center" insteed "'.$xPos.'"');
            }

            $this->image->compositeImage($watermark, \Imagick::COMPOSITE_OVER, $startX, $startY);
        }
        return $this;
    }

    /**
     * Create thumbnail
     * @param integer $width
     * @param integer $height
     * @return Imagick
     */
    public function thumb($width, $height)
    {
        if ($this->width > $width || $this->height > $height) {
            if ($this->width >= $this->height || $height === false) {
                $this->image->thumbnailImage($width, 0);
            } else {
                $this->image->thumbnailImage(0, $height);
            }
        }

        return $this;
    }

    /**
     * Resize image
     * @param integer $width
     * @param integer $height
     * @return Imagick
     * @throws Exception
     */
    public function resize($width, $height)
    {
        if ($height === false && $width === false) {
            throw new \Exception('$width and $height can not be false simultaneously');
        }
        if ($width !== false && $height !== false) {
            if ($this->width >= $this->height) {
                $this->image->adaptiveResizeImage($width, 0);
            } else {
                $this->image->adaptiveResizeImage(0, $height);
            }
        } else {
            if ($width === false) {
                $this->image->adaptiveResizeImage(0, $height);
            } elseif ($height === false) {
                $this->image->adaptiveResizeImage($width, 0);
            }
        }
        return $this;
    }
}
