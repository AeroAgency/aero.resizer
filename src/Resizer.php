<?php
/**
 * Created by PhpStorm.
 * User: GarinAG
 * Date: 16.01.2019
 * Time: 13:08
 */

namespace Aeroidea\Resizer;

use Aeroidea\Resizer\Exception\ResizerException;
use Exception;

/**
 * Class ResizerFactory
 * @package Aeroidea\Resizer
 */
class Resizer
{
    /**
     * @var int Точный ресайз
     */
    const RESIZE_EXACT = 1;

    /**
     * @var int Пропорциональный ресайз
     */
    const RESIZE_PROPORTIONAL = 2;

    /**
     * @var string Базовый ресайзер
     */
    protected static $baseResizer = NullResizer::class;

    /**
     * @var array Переменная кэша
     */
    protected static $cache = [];

    /**
     * @var array Список доступных расширений
     */
    protected static $imageExtensions = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'webp' => 'image/webp',
    ];

    /**
     * @var ResizerInterface Ресайзер
     */
    protected $resizer;

    /**
     * @var null|int|string Исходный файл
     */
    protected $mainInput = null;

    /**
     * @var null|int|string Исходный преобразованный файл
     */
    protected $input = null;

    /**
     * @var null|string Путь к итоговому изображению
     */
    protected $output = null;

    /**
     * @var string Формат выходного файла
     */
    protected $output_format = null;

    /**
     * @var int Качество сжатия
     */
    protected $quality = 80;

    /**
     * @var int Базовый тип ресайза
     */
    protected $resizeType = self::RESIZE_PROPORTIONAL;

    /**
     * @var null|string Итог ресайза, возвращает путь до картинки, либо null
     */
    protected $result = null;

    /**
     * @var null Ширина итогового изображения
     */
    protected $width = null;

    /**
     * @var null Высота итогового изображения
     */
    protected $height = null;

    /**
     * @var bool Обязательное пересоздание файла
     */
    protected $force = false;

    /**
     * @var string Папка для сохранения итоговых изображений
     */
    protected $outputFolder = '/upload/resize_cache/';

    /**
     * ResizerFactory constructor.
     */
    private function __construct()
    {
        $this->resizer = new self::$baseResizer;
    }

    /**
     * Получение объекта ресайзера
     *
     * @return Resizer
     */
    public static function getInstance()
    {
        return new self();
    }

    /**
     * Установка базового ресайзера
     *
     * @param string $resizer Название класса ресайзера
     */
    public static function setBaseResizer($resizer = null)
    {
        if (class_exists($resizer) && in_array(ResizerInterface::class, class_implements($resizer))) {
            /** @var ResizerInterface $resizerClass */
            $resizerClass = new $resizer;
            if ($resizerClass->checkResizer()) {
                self::$baseResizer = $resizer;
            }

            unset($resizerClass);
        }
    }

    /**
     * Установка ресайзера
     *
     * @param string $resizer Название класса ресайзера
     * @return Resizer
     */
    public function setResizer($resizer)
    {
        if (class_exists($resizer) && in_array(ResizerInterface::class, class_implements($resizer))) {
            /** @var ResizerInterface $resizerClass */
            $resizerClass = new $resizer;
            if ($resizerClass->checkResizer()) {
                $this->resizer = $resizerClass;
            }
        }

        return $this;
    }

    /**
     * Установка пути исходного файла, задается от корня сайта
     *
     * @param int|string $input Исходное изображение
     * @return Resizer
     */
    public function setInput($input)
    {
        $this->prepareInput($input);

        return $this;
    }

    /**
     * Преобразование исходного изображения
     *
     * @param string|int $input Исходное изображение
     */
    protected function prepareInput($input)
    {
        $this->mainInput = $input;
        if (is_numeric($input) && class_exists('\CFile')) {
            $this->input = \CFile::GetPath($input);
        } else {
            $this->input = $input;
        }
    }

    /**
     * Установка качества сжатия
     *
     * @param int $quality Качество изображения в пределах 1-100
     * @return Resizer
     */
    public function setQuality(int $quality)
    {
        if ($quality > 0 && $quality <= 100) {
            $this->quality = $quality;
        }

        return $this;
    }

    /**
     * Установка итогового пути, задается от корня сайта
     *
     * @param string $output Путь к итоговому изображению
     * @return Resizer
     */
    public function setOutput($output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     * Установка типа ресайза
     *
     * @param int $resizeType Тип ресайза (точный/пропорциональный)
     * @return Resizer
     */
    public function setResizeType(int $resizeType)
    {
        if (in_array($resizeType, [
            self::RESIZE_PROPORTIONAL,
            self::RESIZE_EXACT
        ])) {
            $this->resizeType = $resizeType;
        }

        return $this;
    }

    /**
     * Возвращает ссылку на результат ресайза
     *
     * @return string|null
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Выполнить ресайз
     *
     * @return Resizer
     * @throws Exception
     */
    public function run()
    {
        $width = $this->width;
        $height = $this->height;

        if ((empty($this->width) || empty($this->height)) && is_file($_SERVER['DOCUMENT_ROOT'] . $this->input)) {
            list($fileWidth, $fileHeight) = getimagesize($_SERVER['DOCUMENT_ROOT'] . $this->input);

            if (!$width && $height) {
                $width = intval($height * $fileWidth / $fileHeight);
            }
            if (!$height && $width) {
                $height = intval($width * $fileHeight / $fileWidth);
            }
            $width = $width ?: $fileWidth;
            $height = $height ?: $fileHeight;
        }

        switch ($this->resizeType) {
            case self::RESIZE_EXACT:
                $this->resizeImg($width, $height);
                break;
            default:
                $this->resizeImgProportional($width, $height);
                break;
        }

        return $this;
    }

    /**
     * Точный ресайз изображения
     *
     * @param int $width Ширина итогового изображения
     * @param int $height Высота итогового изображения
     * @return $this
     * @throws Exception
     */
    public function resizeImg($width, $height)
    {
        $input = $this->resizer->needPrepareInput() ? $this->input : $this->mainInput;
        $md5 = md5(serialize([$input, $width, $height, self::RESIZE_EXACT, $this->quality, $this->output_format, get_class($this->resizer)]));

        if (!empty(self::$cache[$md5])) {
            $this->result = self::$cache[$md5];
        } else {
            $this->checkInputFile();
            $output = $this->prepareOutput($width, $height, self::RESIZE_EXACT);

            try {
                $this->result = $this->resizer->resizeImg($input, $width, $height, $output, $this->quality, $this->output_format, $this->force);
                self::$cache[$md5] = $this->result;
            } catch (Exception $e) {
                throw new ResizerException($e->getMessage(), $e->getCode(), $e);
            }
        }

        return $this;
    }

    /**
     * Проверка исходного файла
     *
     * @throws Exception
     */
    protected function checkInputFile()
    {
        if (!$this->input || !file_exists($_SERVER['DOCUMENT_ROOT'] . $this->input)) {
            throw new Exception('File not found.');
        }

        $fileType = mime_content_type($_SERVER['DOCUMENT_ROOT'] . $this->input);

        if (!in_array($fileType, self::$imageExtensions)) {
            throw new Exception('Wrong file type.');
        }
    }

    /**
     * Формирование пути итогового изображения
     *
     * @param int $width Ширина изображения
     * @param int $height Высота изображения
     * @param int $type Тип ресайза
     * @return null|string
     * @throws Exception
     */
    protected function prepareOutput($width, $height, $type)
    {
        if (!$width) {
            throw new Exception('width param is required');
        }

        if (!$height) {
            throw new Exception('height param is required');
        }

        if ($this->resizer->needPrepareOutput()) {
            $file = $this->input;
            $output = "";

            if ($file) {
                $filePath = explode('/', $file);
                $fileName = array_pop($filePath);
                $outputPath = explode('/', $this->outputFolder);
                foreach ($filePath as $key => $part) {
                    if (in_array($part, $outputPath)) {
                        unset($filePath[$key]);
                    }
                }
                unset($outputPath);

                $filePath = implode('/', $filePath);
                $filePath = trim(str_replace('/upload', '', $filePath), '/') . '/';
                $output = $this->outputFolder . $filePath . $width . '_' . $height . '_' . $type . '_' . $this->quality . '/' . $fileName;
            }

            $output = $this->output ?? $output;

            if ($output) {
                $path = dirname($_SERVER['DOCUMENT_ROOT'] . $output);

                if (!is_dir($path)) {
                    mkdir($path, 0775, true);
                }

                if (!is_writable($path)) {
                    throw new Exception('Output folder permissions denied.');
                }
            }
        } else {
            $output = '';
        }

        return $output;
    }

    /**
     * Пропорциональный ресайз изображения
     *
     * @param int $width Ширина итогового изображения
     * @param int $height Высота итогового изображения
     * @return $this
     * @throws Exception
     */
    public function resizeImgProportional($width, $height)
    {
        $input = $this->resizer->needPrepareInput() ? $this->input : $this->mainInput;
        $md5 = md5(serialize([$input, $width, $height, self::RESIZE_PROPORTIONAL, $this->quality, $this->output_format, get_class($this->resizer)]));

        if (!empty(self::$cache[$md5])) {
            $this->result = self::$cache[$md5];
        } else {
            $this->checkInputFile();
            $output = $this->prepareOutput($width, $height, self::RESIZE_PROPORTIONAL);
            try {
                $this->result = $this->resizer->resizeImgProportional($input, $width, $height, $output, $this->quality, $this->output_format,
                    $this->force);
                self::$cache[$md5] = $this->result;
            } catch (Exception $e) {
                throw new ResizerException($e->getMessage(), $e->getCode(), $e);
            }
        }

        return $this;
    }

    /**
     * Установка ширины изображения
     *
     * @param int $width Ширина
     * @return Resizer
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Установыка высоты изображения
     *
     * @param int $height Высота
     * @return Resizer
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Установка формата выходного файла
     *
     * @param string $output_format Формат выходного файла
     * @return Resizer
     * @throws Exception
     */
    public function setOutputFormat($output_format)
    {
        if (array_key_exists($output_format, self::$imageExtensions)) {
            $this->output_format = $output_format;
        } else {
            throw new Exception('Wrong output file type.');
        }

        return $this;
    }

    /**
     * Установка обязательного пересоздания файла
     *
     * @param bool $force
     * @return Resizer
     */
    public function setForce(bool $force)
    {
        $this->force = $force;

        return $this;
    }

    /**
     * Установка папки для сохранения итоговых изображений
     *
     * @param string $outputFolder Путь к папке, задается от корня сайта
     * @return Resizer
     */
    public function setOutputFolder(string $outputFolder)
    {
        $this->outputFolder = $outputFolder;

        return $this;
    }
}