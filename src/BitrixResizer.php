<?php
/**
 * Created by PhpStorm.
 * User: GarinAG
 * Date: 16.01.2019
 * Time: 12:49
 */

namespace Aeroidea\Resizer;


/**
 * Class BitrixResizer
 * @package Aeroidea\Resizer
 */
class BitrixResizer implements ResizerInterface
{
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
        return $this->resize($input, $width, $height, BX_RESIZE_IMAGE_EXACT, $quality);
    }

    /**
     * Ресайз изображения
     *
     * @param $input
     * @param $width
     * @param $height
     * @param $type
     * @param int $quality
     * @return mixed
     */
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
        return $this->resize($input, $width, $height, BX_RESIZE_IMAGE_PROPORTIONAL, $quality);
    }

    /**
     * Проверка доступности ресайзера
     *
     * @return bool
     */
    public function checkResizer()
    {
        return class_exists('\CFile');
    }

    /**
     * Подготавливать путь к выходному файлу
     *
     * @return bool
     */
    public function needPrepareOutput()
    {
        return false;
    }

    /**
     * Подготавливать исходный сайт
     *
     * @return bool
     */
    public function needPrepareInput()
    {
        return false;
    }
}