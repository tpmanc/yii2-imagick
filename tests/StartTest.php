<?php

use tpmanc\imagick\Imagick;

class StartTest extends PHPUnit_Framework_TestCase
{
    private function getPath($file)
    {
        return IMG_DIR . $file;
    }

    private function getTempPath($file)
    {
        return TEMP_DIR . $file;
    }

    public function testImageSize()
    {
        $obj = Imagick::open($this->getPath('original.jpg'));
        $this->assertEquals(500, $obj->getWidth());
        $this->assertNotEquals(200, $obj->getWidth());
        $this->assertEquals(393, $obj->getHeight());
        $this->assertNotEquals(200, $obj->getHeight());
    }

    public function testBorder()
    {
        $obj = Imagick::open($this->getPath('original.jpg'));
        $obj->border(5, '#000')->saveTo($this->getTempPath('border.jpg'));
        $this->assertFileExists($this->getTempPath('border.jpg'));
        try {
            $obj->border(5, 'vbio')->saveTo($this->getTempPath('border.jpg'));
            $this->assertTrue(false);
        } catch (Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testCrop()
    {
        $obj = Imagick::open($this->getPath('original.jpg'));
        $obj->crop(10, 10, 50, 50)->saveTo($this->getTempPath('crop.jpg'));
        $this->assertFileExists($this->getTempPath('crop.jpg'));
        $crop = Imagick::open($this->getTempPath('crop.jpg'));
        $this->assertEquals(50, $crop->getWidth());
        $this->assertEquals(50, $crop->getHeight());
    }

    public function testThumb()
    {
        $obj = Imagick::open($this->getPath('original.jpg'));
        $obj->thumb(50, 50)->saveTo($this->getTempPath('thumb.jpg'));
        $this->assertFileExists($this->getTempPath('thumb.jpg'));
        $thumb = Imagick::open($this->getTempPath('thumb.jpg'));
        $this->assertEquals(50, $thumb->getWidth());
        $this->assertNotEquals(50, $thumb->getHeight());
    }

    public function testResize()
    {
        $obj = Imagick::open($this->getPath('original.jpg'));
        $obj->resize(150, 150)->saveTo($this->getTempPath('resize-1.jpg'));
        $this->assertFileExists($this->getTempPath('thumb.jpg'));
        $resize = Imagick::open($this->getTempPath('resize-1.jpg'));
        $this->assertEquals(150, $resize->getWidth());
        $this->assertNotEquals(150, $resize->getHeight());

        $obj = Imagick::open($this->getPath('original.jpg'));
        $obj->resize(150, false)->saveTo($this->getTempPath('resize-2.jpg'));
        $this->assertFileExists($this->getTempPath('thumb.jpg'));
        $resize = Imagick::open($this->getTempPath('resize-2.jpg'));
        $this->assertEquals(150, $resize->getWidth());
        $this->assertNotEquals(150, $resize->getHeight());

        $obj = Imagick::open($this->getPath('original.jpg'));
        $obj->resize(false, 150)->saveTo($this->getTempPath('resize-3.jpg'));
        $this->assertFileExists($this->getTempPath('thumb.jpg'));
        $resize = Imagick::open($this->getTempPath('resize-3.jpg'));
        $this->assertNotEquals(150, $resize->getWidth());
        $this->assertEquals(150, $resize->getHeight());

        $obj = Imagick::open($this->getPath('original.jpg'));
        try {
            $obj->resize(false, false)->saveTo($this->getTempPath('resize-4.jpg'));
            $this->assertTrue(false);
        } catch (\yii\base\InvalidConfigException $e) {
            $this->assertTrue(true);
        }
    }
}