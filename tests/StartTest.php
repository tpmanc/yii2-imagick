<?php

use tpmanc\imagick\Imagick;

class StartTest extends PHPUnit_Framework_TestCase
{
    public function testImageSize()
    {
        $obj = Imagick::open(Yii::getAlias('@img/original.jpg'));
        $this->assertEquals(500, $obj->getWidth());
        $this->assertNotEquals(200, $obj->getWidth());
        $this->assertEquals(393, $obj->getHeight());
        $this->assertNotEquals(200, $obj->getHeight());
    }

    public function testBorder()
    {
        $obj = Imagick::open(Yii::getAlias('@img/original.jpg'));
        $obj->border(5, '#000')->saveTo(Yii::getAlias('@temp/border.jpg'));
        $this->assertFileExists(Yii::getAlias('@temp/border.jpg'));
        try {
            $obj->border(5, 'vbio')->saveTo(Yii::getAlias('@temp/border.jpg'));
            $this->assertTrue(false);
        } catch (Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testCrop()
    {
        $obj = Imagick::open(Yii::getAlias('@img/original.jpg'));
        $obj->crop(10, 10, 50, 50)->saveTo(Yii::getAlias('@temp/crop.jpg'));
        $this->assertFileExists(Yii::getAlias('@temp/crop.jpg'));
        $crop = Imagick::open(Yii::getAlias('@temp/crop.jpg'));
        $this->assertEquals(50, $crop->getWidth());
        $this->assertEquals(50, $crop->getHeight());
    }

    public function testThumb()
    {
        $obj = Imagick::open(Yii::getAlias('@img/original.jpg'));
        $obj->thumb(50, 50)->saveTo(Yii::getAlias('@temp/thumb.jpg'));
        $this->assertFileExists(Yii::getAlias('@temp/thumb.jpg'));
        $thumb = Imagick::open(Yii::getAlias('@temp/thumb.jpg'));
        $this->assertEquals(50, $thumb->getWidth());
        $this->assertNotEquals(50, $thumb->getHeight());
    }

    public function testResize()
    {
        $obj = Imagick::open(Yii::getAlias('@img/original.jpg'));
        $obj->resize(150, 150)->saveTo(Yii::getAlias('@temp/resize-1.jpg'));
        $this->assertFileExists(Yii::getAlias('@temp/thumb.jpg'));
        $resize = Imagick::open(Yii::getAlias('@temp/resize-1.jpg'));
        $this->assertEquals(150, $resize->getWidth());
        $this->assertNotEquals(150, $resize->getHeight());

        $obj = Imagick::open(Yii::getAlias('@img/original.jpg'));
        $obj->resize(150, false)->saveTo(Yii::getAlias('@temp/resize-2.jpg'));
        $this->assertFileExists(Yii::getAlias('@temp/thumb.jpg'));
        $resize = Imagick::open(Yii::getAlias('@temp/resize-2.jpg'));
        $this->assertEquals(150, $resize->getWidth());
        $this->assertNotEquals(150, $resize->getHeight());

        $obj = Imagick::open(Yii::getAlias('@img/original.jpg'));
        $obj->resize(false, 150)->saveTo(Yii::getAlias('@temp/resize-3.jpg'));
        $this->assertFileExists(Yii::getAlias('@temp/thumb.jpg'));
        $resize = Imagick::open(Yii::getAlias('@temp/resize-3.jpg'));
        $this->assertNotEquals(150, $resize->getWidth());
        $this->assertEquals(150, $resize->getHeight());

        $obj = Imagick::open(Yii::getAlias('@img/original.jpg'));
        try {
            $obj->resize(false, false)->saveTo(Yii::getAlias('@temp/resize-4.jpg'));
            $this->assertTrue(false);
        } catch (\yii\base\InvalidConfigException $e) {
            $this->assertTrue(true);
        }
    }
}