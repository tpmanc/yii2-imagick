# Yii 2 Imagick
Yii 2 class for working with Imagick.

## Install via Composer

Run the following command

```bash
$ composer require tpmanc/yii2-imagick "*"
```

or add

```bash
$ "tpmanc/yii2-imagick": "*"
```

to the require section of your `composer.json` file.

Original image:

!["Original"](https://raw.github.com/tpmanc/yii2-imagick/master/examples/original.jpg)

## Get size

```php
$img = Imagick::open('./image.jpg');
$img->getWidth();
$img->getHeight();
```

## Resize image

```php
Imagick::open('./image.jpg')->resize(400, 300)->saveTo('./resized.jpg');
Imagick::open('./image.jpg')->resize(400, false)->saveTo('./resized.jpg');
```

!["Resize"](https://raw.github.com/tpmanc/yii2-imagick/master/examples/resize.jpg)

## Create thumbnail

```php
Imagick::open('./image.jpg')->thumb(200, 200)->saveTo('./thumb.jpg');
```

!["Thumb"](https://raw.github.com/tpmanc/yii2-imagick/master/examples/thumb.jpg)

## Add border

```php
$width = 5;
$color = '#000'
Imagick::open('./image.jpg')->border($width, $color)->saveTo('./result.jpg');
```

!["Resize"](https://raw.github.com/tpmanc/yii2-imagick/master/examples/border-1.jpg)

```php
$width = 10;
$color = '#A91AD4'
Imagick::open('./image.jpg')->border($width, $color)->saveTo('./result.jpg');
```

!["Resize"](https://raw.github.com/tpmanc/yii2-imagick/master/examples/border-2.jpg)

## Vertical and horizontal mirror image

```php
// vertical
Imagick::open('./image.jpg')->flip()->saveTo('./result.jpg');
// horizontal
Imagick::open('./image.jpg')->flop()->saveTo('./result.jpg');
```

!["Flip"](https://raw.github.com/tpmanc/yii2-imagick/master/examples/flip.jpg)

!["Flop"](https://raw.github.com/tpmanc/yii2-imagick/master/examples/flop.jpg)

## Crop

```php
$xStart = 0;
$yStart = 0;
$xEnd = 150;
$yEnd = 150;
Imagick::open('./image.jpg')->crop($xStart, $yStart, $xEnd, $yEnd)->saveTo('./result.jpg');
```

!["Crop"](https://raw.github.com/tpmanc/yii2-imagick/master/examples/crop.jpg)

## Blur

```php
$radius = 8;
$delta = 5;
Imagick::open('./image.jpg')->blur($radius, $delta)->saveTo('./result.jpg');
```

!["Blur"](https://raw.github.com/tpmanc/yii2-imagick/master/examples/blur.jpg)

## Watermark

### Set watermark position

Use `$xPosition` and `$yPosition` to set watermark position.

`$xPosition` should be 'left', 'right' or 'center'; `$yPosition` should be 'top', 'bottom' or 'center'.

```php
$xPosition = 'left';
$yPosition = 'top';
Imagick::open('./image.jpg')->watermark('./watermark.png'), $xPosition, $yPosition)->saveTo('./result.jpg');
```

!["Watermark"](https://raw.github.com/tpmanc/yii2-imagick/master/examples/watermark-1.jpg)

```php
$xPosition = 'right';
$yPosition = 'center';
Imagick::open('./image.jpg')->watermark('./watermark.png'), $xPosition, $yPosition)->saveTo('./result.jpg');
```

!["Watermark"](https://raw.github.com/tpmanc/yii2-imagick/master/examples/watermark-2.jpg)

### Set watermark size

Use `$xSize` and `$ySize` to set watermark size. Valid values:

 * Number: `$xSize = 100;`, `$ySize = 50`

 * Percent of parent: `$xSize = '100%';`, `$ySize = '50%'`

 * `'auto'` to save proportion: `$xSize = '100%';`, `$ySize = 'auto'`

 * `false`: `$xSize = 100;`, `$ySize = false`

```php
$xPosition = 'center';
$yPosition = 'center';
$xSize = '100%';
$ySize = 'auto';
Imagick::open('./image.jpg')->watermark('./watermark.png'), $xPosition, $yPosition, $xSize, $ySize)->saveTo('./result.jpg');
```

!["Watermark"](https://raw.github.com/tpmanc/yii2-imagick/master/examples/watermark-3.jpg)

```php
$xPosition = 'center';
$yPosition = 'center';
$xSize = '100%';
$ySize = '100%';
Imagick::open('./image.jpg')->watermark('./watermark.png'), $xPosition, $yPosition, $xSize, $ySize)->saveTo('./result.jpg');
```

!["Watermark"](https://raw.github.com/tpmanc/yii2-imagick/master/examples/watermark-4.jpg)

### Set watermark offset

Use `$xOffset` and `$yOffset` to set offset from parent image border.

```php
$xPosition = 'right';
$yPosition = 'bottom';
$xSize = false;
$ySize = false;
$xOffset = 50;
$yOffset = 50;
Imagick::open('./image.jpg')->watermark('./watermark.png'), $xPosition, $yPosition, $xSize, $ySize, $xOffset, $yOffset)->saveTo('./result.jpg');
```
!["Watermark"](https://raw.github.com/tpmanc/yii2-imagick/master/examples/watermark-5.jpg)
