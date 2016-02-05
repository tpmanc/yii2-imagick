# Yii 2 Imagick
Yii 2 class for working with Imagick.

## Install via Composer

Run the following command

```bash
$ composer require tpmanc/imagick "*"
```

or add

```bash
$ "tpmanc/imagick": "*"
```

to the require section of your `composer.json` file.

## Get size

```php
$img = Imagick::open('./image.jpg');
$img->getWidth();
$img->getHeight();
```

## Resize image

```php
Imagick::open('./image.jpg')->resize(800, 600)->saveTo('./resized.jpg');
Imagick::open('./image.jpg')->resize(800, false)->saveTo('./resized.jpg');
```

## Create thumbnail

```php
Imagick::open('./image.jpg')->thumb(64, 64)->saveTo('./thumb.jpg');
```

## Add border

```php
$width = 5;
$color = '#000'
Imagick::open('./image.jpg')->border($width, $color)->saveTo('./result.jpg');
```

```php
$width = 10;
$color = '#A91AD4'
Imagick::open('./image.jpg')->border($width, $color)->saveTo('./result.jpg');
```

## Vertical and horizontal mirror image

```php
// vertical
Imagick::open('./image.jpg')->flip()->saveTo('./result.jpg');
// horizontal
Imagick::open('./image.jpg')->flop()->saveTo('./result.jpg');
```

## Crop

```php
$xStart = 0;
$yStart = 0;
$xEnd = 150;
$yEnd = 150;
Imagick::open('./image.jpg')->crop($xStart, $yStart, $xEnd, $yEnd)->saveTo('./result.jpg');
```

## Blur

```php
$radius = 8;
$delta = 5;
Imagick::open('./image.jpg')->blur($radius, $delta)->saveTo('./result.jpg');
```

## Watermark

`xSize` and `ySize` 

### Set watermark position

Use `$xPosition` and `$yPosition` to set watermark position.

`$xPosition` should be 'left', 'right' or 'center'; `$yPosition` should be 'top', 'bottom' or 'center'.

```php
$xPosition = 'left';
$yPosition = 'top';
Imagick::open('./image.jpg')->watermark('./watermark.png'), $xPosition, $yPosition)->saveTo('./result.jpg');
```

```php
$xPosition = 'right';
$yPosition = 'center';
Imagick::open('./image.jpg')->watermark('./watermark.png'), $xPosition, $yPosition)->saveTo('./result.jpg');
```
### Set watermark size

Use `$xSize` and `$ySize` to set watermark size. Valid values:

 * Number: `$xSize = 100;`, `$ySize = 50`

 * Percent of parent: `$xSize = '100%';`, `$ySize = '50%'`

 * 'auto' to save proportion: `$xSize = '100%';`, `$ySize = 'auto'`

 * False: `$xSize = 100;`, `$ySize = false`

```php
$xPosition = 'center';
$yPosition = 'center';
$xSize = '100%';
$ySize = 'auto';
Imagick::open('./image.jpg')->watermark('./watermark.png'), $xPosition, $yPosition, $xSize, $ySize)->saveTo('./result.jpg');
```

```php
$xPosition = 'center';
$yPosition = 'center';
$xSize = '100%';
$ySize = '100%';
Imagick::open('./image.jpg')->watermark('./watermark.png'), $xPosition, $yPosition, $xSize, $ySize)->saveTo('./result.jpg');
```
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
