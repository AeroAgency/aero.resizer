<?php
/**
 * Created by PhpStorm.
 * User: APro
 * Date: 17.01.2019
 * Time: 12:49
 */

namespace Aero\Resizer;


class GoResizer implements ResizerInterface
{
    const RESIZER_SCRIPT_NAME = __DIR__ . '/bin/resizer';

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
        if ($output !== $input && !$force && file_exists($_SERVER['DOCUMENT_ROOT'] . $output)) {
            return $output;
        }
        return $this->resize($input, $width, $height, $output, 1, $quality);
    }

    protected function resize($input, $width, $height, $output, $bExact, $quality)
    {
        try {
            $filePath = $_SERVER['DOCUMENT_ROOT'] . $input;
            $outPath = $_SERVER['DOCUMENT_ROOT'] . $output;
            $command = self::RESIZER_SCRIPT_NAME . ' -in="' . $filePath . '" -out="' . $outPath . '" -w=' . (int)$width . ' -h=' . (int)$height . '  -q=' . (int)$quality . ' -exact=' . (int)$bExact;
            exec($command);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

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
     */
    public function resizeImgProportional($input, $width, $height, $output = '', $quality = 90, $output_format = '', $force = false)
    {
        if ($output !== $input && !$force && file_exists($_SERVER['DOCUMENT_ROOT'] . $output)) {
            return $output;
        }
        return $this->resize($input, $width, $height, $output, 0, $quality);
    }

    /**
     * @return bool
     */
    public function checkResizer()
    {
        return file_exists(self::RESIZER_SCRIPT_NAME) && is_executable(self::RESIZER_SCRIPT_NAME);
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