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

## Resize image

```php
Imagick::open('./image.jpg')->resize(800, 600)->saveTo('./resized.jpg');
Imagick::open('./image.jpg')->resize(800, false)->saveTo('./resized.jpg');
```

## Create thumbnail

```php
Imagick::open('./image.jpg')->thumb(64, 64)->saveTo('./thumb.jpg');
```