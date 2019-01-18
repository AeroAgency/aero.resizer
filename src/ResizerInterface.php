<?php
/**
 * Created by PhpStorm.
 * User: user1
 * Date: 16.01.2019
 * Time: 12:50
 */

namespace Aero\Resizer;


interface ResizerInterface
{
    /**
     * Точный ресайз изображения
     * @param string $input Путь к исходному изображению
     * @param int $width Ширина итогового изображения
     * @param int $height Высота итогового изображения
     * @param string $output Путь к итоговому изображению
     * @param int $quality Качество изображения в пределах 1-100
     * @param string $output_format Формат выходного файла
     * @param bool $force Обязательное пересоздание файла
     * @return string Путь к итоговому изображению
     */
    public function resizeImg($input, $width, $height, $output = '', $quality = 90, $output_format = '', $force = false);

    /**
     * Пропорциональный ресайз изображения
     * @param string $input Путь к исходному изображению
     * @param int $width Ширина итогового изображения
     * @param int $height Высота итогового изображения
     * @param string $output Путь к итоговому изображению
     * @param int $quality Качество изображения в пределах 1-100
     * @param string $output_format Формат выходного файла
     * @param bool $force Обязательное пересоздание файла
     * @return string Путь к итоговому изображению
     */
    public function resizeImgProportional($input, $width, $height, $output = '', $quality = 90, $output_format = '', $force = false);

    /**
     * Проверка доступности ресайзера
     * @return bool
     */
    public function checkResizer();

    /**
     * Подготавливать путь к выходному файлу
     * @return bool
     */
    public function needPrepareOutput();

    /**
     * Подготавливать исходный сайт
     * @return bool
     */
    public function needPrepareInput();
}