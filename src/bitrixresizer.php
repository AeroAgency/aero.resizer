<?php
/**
 * Created by PhpStorm.
 * User: user1
 * Date: 16.01.2019
 * Time: 12:49
 */

namespace Aero\Resizer;


class BitrixResizer implements ResizerInterface
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
     */
    public function resizeImg($input, $width, $height, $output = '', $quality = 90, $output_format = '', $force = false)
    {
        return $this->resize($input, $width, $height, BX_RESIZE_IMAGE_EXACT, $quality);
    }

    protected function resize($input, $width, $height, $type, $quality = 90)
    {
        $arImgResize = \CFile::ResizeImageGet(
            $input,
            ['width' => $width, 'height' => $height],
            $type,
            false,
            array("name" => "sharpen", "precision" => 0),
            false,
            $quality
        )["src"];

        return $arImgResize;
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
     */
    public function resizeImgProportional($input, $width, $height, $output = '', $quality = 90, $output_format = '', $force = false)
    {
        return $this->resize($input, $width, $height, BX_RESIZE_IMAGE_PROPORTIONAL, $quality);
    }

    /**
     * @return bool
     */
    public function checkResizer()
    {
        return class_exists('\CFile');
    }

    /**
     * @return bool
     */
    public function needPrepareOutput()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function needPrepareInput()
    {
        return false;
    }
}