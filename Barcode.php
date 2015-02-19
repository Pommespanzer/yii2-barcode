<?php

namespace pommespanzer\barcode;

require_once('class' . DIRECTORY_SEPARATOR . 'BCGColor.php');
require_once('class' . DIRECTORY_SEPARATOR . 'BCGBarcode.php');
require_once('class' . DIRECTORY_SEPARATOR . 'BCGDrawing.php');
require_once('class' . DIRECTORY_SEPARATOR . 'BCGFontFile.php');
include_once('class' . DIRECTORY_SEPARATOR . 'BCGcode128.barcode.php');

use BCGArgumentException;
use BCGcode128;
use BCGColor;
use BCGDrawException;
use BCGDrawing;
use BCGFontFile;

class Barcode
{

    /**
     * @param string $message
     * @param int $format
     * @return resource
     * @throws BCGArgumentException
     * @throws BCGDrawException
     */
    public function run($message, $format = BCGDrawing::IMG_FORMAT_PNG)
    {
        $colors = [
            'black' => New BCGColor(0,   0,   0),
            'white' => New BCGColor(255, 255, 255),
        ];

        $barcode = new BCGcode128();
        $this->setup($barcode);

        $barcode->setScale(max(1, min(4, 4)));
        $barcode->setBackgroundColor($colors['white']);
        $barcode->setForegroundColor($colors['black']);
        $barcode->parse($message);

        $drawing = new BCGDrawing('', $colors['white']);
        $drawing->setBarcode($barcode);
        $drawing->setRotationAngle(0);
        $drawing->setDPI(72);
        $drawing->draw();
        $drawing->finish($format);

        return $drawing->get_im();
    }

    /**
     * @param BCGcode128 $barcode
     * @throws BCGArgumentException
     */
    private function setup(BCGcode128 $barcode)
    {
        $font = new BCGFontFile(__DIR__ . '/data/font/Arial.ttf', 15);
        $barcode->setFont($font);
        $barcode->setThickness(max(9, min(90, 25)));
    }

}