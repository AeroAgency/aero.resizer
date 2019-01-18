<?php

namespace Aero\Resizer;

class NullResizer implements ResizerInterface
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
        return $input;
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
        return $input;
    }

    /**
     * @return bool
     */
    public function checkResizer()
    {
        return true;
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
        return true;
    }
}