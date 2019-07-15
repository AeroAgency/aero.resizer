<?php
/**
 * Created by PhpStorm.
 * User: user1
 * Date: 16.01.2019
 * Time: 12:49
 */

namespace Aeroidea\Resizer;

use Imagick;

class ImagickResizer extends BaseResizer
{
    /**
     * @param string $input
     * @param int $width
     * @param int $height
     * @param string $output
     * @param int $quality
     * @param string $output_format
     * @param bool $force
     * @return string
     * @throws \ImagickException
     */
    public function resizeImg($input, $width, $height, $output = '', $quality = 90, $output_format = '', $force = false)
    {
        $this->prepareArguments($input, $output, $output_format);
        $foutput = $_SERVER['DOCUMENT_ROOT'] . $output;

        if (!file_exists($input)) {
            return "";
        }

        if ($this->isImageExist($input, $force, $foutput)) {
            return $output;
        }


        $imagick = new Imagick($input);
        $imagick->cropThumbnailImage($width, $height);
        return $this->saveFile($imagick, $quality, $output, $output_format);
    }

    protected function prepareArguments(&$input, &$output, $output_format = '')
    {
        $input = $_SERVER['DOCUMENT_ROOT'] . $input;

        if ($output_format) {
            $output = explode('.', $output);
            array_pop($output);
            array_push($output, $output_format);
            $output = implode('.', $output);
        }
    }

    /**
     * @param Imagick $imagick
     * @param int $quality
     * @param string $output
     * @param string $output_format
     * @return mixed
     * @throws \ImagickException
     */
    protected function saveFile(Imagick $imagick, $quality, $output, $output_format = '')
    {
        $imagick->setColorspace(Imagick::COLORSPACE_SRGB);
        $profiles = $imagick->getImageProfiles("icc", true);
        $imagick->stripImage();
        if (!empty($profiles)) {
            $imagick->profileImage('icc', $profiles['icc']);
        }

        if ($output_format) {
            $white = new Imagick();
            $white->newImage($imagick->getImageWidth(), $imagick->getImageHeight(), "white");
            $white->compositeimage($imagick, Imagick::COMPOSITE_OVER, 0, 0);
            $white->setImageFormat($output_format);
            $white->optimizeImageLayers();
            $white->setImageCompressionQuality($quality);
            $white->writeImage($_SERVER['DOCUMENT_ROOT'] . $output);
            $white->destroy();
            $white->clear();
        } else {
            $imagick->optimizeImageLayers();
            $imagick->setImageCompressionQuality($quality);
            $imagick->writeImage($_SERVER['DOCUMENT_ROOT'] . $output);
        }

        $imagick->destroy();
        $imagick->clear();

        return $output;
    }

    /**
     * @param string $input
     * @param int $width
     * @param int $height
     * @param string $output
     * @param int $quality
     * @param string $output_format
     * @param bool $force
     * @return string
     * @throws \ImagickException
     */
    public function resizeImgProportional($input, $width, $height, $output = '', $quality = 90, $output_format = '', $force = false)
    {
        $this->prepareArguments($input, $output, $output_format);
        $foutput = $_SERVER['DOCUMENT_ROOT'] . $output;
        
        if (!file_exists($input)) {
            return "";
        }

        if ($this->isImageExist($input, $force, $foutput)) {
            return $output;
        }


        $imagick = new Imagick($input);
        $imagick->resizeImage($width, $height, imagick::FILTER_CATROM, 1, true);
        return $this->saveFile($imagick, $quality, $output, $output_format);
    }

    /**
     * @return bool
     */
    public function checkResizer()
    {
        return class_exists('\Imagick');
    }

    /**
     * @return bool
     */
    public function needPrepareOutput()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function needPrepareInput()
    {
        return true;
    }

}