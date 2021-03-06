<?php
/**
 * Created by PhpStorm.
 * User: ap
 * Date: 18.04.2019
 * Time: 13:57
 */

namespace Aeroidea\Resizer;


/**
 * Class BaseResizer
 * @package Aeroidea\Resizer
 */
abstract class BaseResizer implements ResizerInterface
{
    /**
     *  Минимальный размер файла
     */
    const MIN_FILE_SIZE = 30;

    /**
     * Проверка наличия конечного файла
     *
     * @param $input
     * @param $force
     * @param $foutput
     * @return bool
     */
    protected function isImageExist($input, $force, $foutput): bool
    {
        return $foutput !== $input && !$force && file_exists($foutput) && filesize($foutput) > self::MIN_FILE_SIZE && filemtime($foutput) > filemtime($input);
    }
}