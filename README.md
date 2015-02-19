create barcode 
===============
use BCGcode

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist Pommespanzer/yii2-barcode "*"
```

or add

```
"Pommespanzer/yii2-barcode": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?php 
$barcode = new Barcode(); 
echo Html::img()
?>
```