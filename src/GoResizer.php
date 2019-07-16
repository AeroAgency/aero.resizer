<?php
/**
 * Created by PhpStorm.
 * User: APro
 * Date: 17.01.2019
 * Time: 12:49
 */

namespace Aeroidea\Resizer;


/**
 * Class GoResizer
 * @package Aeroidea\Resizer
 */
class GoResizer extends BaseResizer
{
    /**
     * Путь до исполняемого файла
     */
    const RESIZER_SCRIPT_NAME = __DIR__ . '/bin/resizer';

    /**
     * Точный ресайз изображения
     *
     * @param string $input Путь к исходному изображению
     * @param int $width Ширина итогового изображения
     * @param int $height Высота итогового изображения
     * @param string $output Путь к итоговому изображению
     * @param int $quality Качество изображения в пределах 1-100
     * @param string $output_format Формат выходного файла
     * @param bool $force Обязательное пересоздание файла
     * @return string Путь к итоговому изображению
     */
    public function resizeImg($input, $width, $height, $output = '', $quality = 90, $output_format = '', $force = false)
    {
        if ($this->isImageExist($input, $force, $output)) {
            return $output;
        }
        return $this->resize($input, $width, $height, $output, 1, $quality);
    }

    /**
     * Ресайз изображения
     *
     * @param $input
     * @param $width
     * @param $height
     * @param $output
     * @param $bExact
     * @param $quality
     * @return mixed
     */
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
     * Пропорциональный ресайз изображения
     *
     * @param string $input Путь к исходному изображению
     * @param int $width Ширина итогового изображения
     * @param int $height Высота итогового изображения
     * @param string $output Путь к итоговому изображению
     * @param int $quality Качество изображения в пределах 1-100
     * @param string $output_format Формат выходного файла
     * @param bool $force Обязательное пересоздание файла
     * @return string Путь к итоговому изображению
     */
    public function resizeImgProportional($input, $width, $height, $output = '', $quality = 90, $output_format = '', $force = false)
    {
        if ($this->isImageExist($input, $force, $output)) {
            return $output;
        }
        return $this->resize($input, $width, $height, $output, 0, $quality);
    }

    /**
     * Проверка доступности ресайзера
     *
     * @return bool
     */
    public function checkResizer()
    {
        return file_exists(self::RESIZER_SCRIPT_NAME) && is_executable(self::RESIZER_SCRIPT_NAME);
    }

    /**
     * Подготавливать путь к выходному файлу
     *
     * @return bool
     */
    public function needPrepareOutput()
    {
        return true;
    }

    /**
     * Подготавливать исходный сайт
     *
     * @return bool
     */
    public function needPrepareInput()
    {
        return true;
    }
}