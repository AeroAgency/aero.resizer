Aeroidea\Resizer\Resizer
===============

Class ResizerFactory




* Class name: Resizer
* Namespace: Aeroidea\Resizer



Constants
----------


### RESIZE_EXACT

    const RESIZE_EXACT = 1





### RESIZE_PROPORTIONAL

    const RESIZE_PROPORTIONAL = 2





Properties
----------


### $baseResizer

    protected string $baseResizer = \Aeroidea\Resizer\NullResizer::class





* Visibility: **protected**
* This property is **static**.


### $cache

    protected array $cache = array()





* Visibility: **protected**
* This property is **static**.


### $imageExtensions

    protected array $imageExtensions = array('jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif', 'bmp' => 'image/bmp', 'webp' => 'image/webp')





* Visibility: **protected**
* This property is **static**.


### $resizer

    protected \Aeroidea\Resizer\ResizerInterface $resizer





* Visibility: **protected**


### $mainInput

    protected null $mainInput = null





* Visibility: **protected**


### $input

    protected null $input = null





* Visibility: **protected**


### $output

    protected null $output = null





* Visibility: **protected**


### $output_format

    protected string $output_format = null





* Visibility: **protected**


### $quality

    protected integer $quality = 80





* Visibility: **protected**


### $resizeType

    protected integer $resizeType = self::RESIZE_PROPORTIONAL





* Visibility: **protected**


### $result

    protected null $result = null





* Visibility: **protected**


### $width

    protected null $width = null





* Visibility: **protected**


### $height

    protected null $height = null





* Visibility: **protected**


### $force

    protected boolean $force = false





* Visibility: **protected**


### $outputFolder

    protected string $outputFolder = '/upload/resize_cache/'





* Visibility: **protected**


Methods
-------


### __construct

    mixed Aeroidea\Resizer\Resizer::__construct()

ResizerFactory constructor.



* Visibility: **private**




### getInstance

    \Aeroidea\Resizer\Resizer Aeroidea\Resizer\Resizer::getInstance()

Получение объекта ресайзера



* Visibility: **public**
* This method is **static**.




### setBaseResizer

    mixed Aeroidea\Resizer\Resizer::setBaseResizer(string $resizer)

Установка базового ресайзера



* Visibility: **public**
* This method is **static**.


#### Arguments
* $resizer **string** - Название класса ресайзера



### setResizer

    \Aeroidea\Resizer\Resizer Aeroidea\Resizer\Resizer::setResizer(string $resizer)

Установка ресайзера



* Visibility: **public**


#### Arguments
* $resizer **string** - Название класса ресайзера



### setInput

    \Aeroidea\Resizer\Resizer Aeroidea\Resizer\Resizer::setInput(integer|string $input)

Установка пути исходного файла, задается от корня сайта



* Visibility: **public**


#### Arguments
* $input **integer|string** - Исходное изображение



### prepareInput

    mixed Aeroidea\Resizer\Resizer::prepareInput(string|integer $input)

Преобразование исходного изображения



* Visibility: **protected**


#### Arguments
* $input **string|integer** - Исходное изображение



### setQuality

    \Aeroidea\Resizer\Resizer Aeroidea\Resizer\Resizer::setQuality(integer $quality)

Установка качества сжатия



* Visibility: **public**


#### Arguments
* $quality **integer** - Качество изображения в пределах 1-100



### setOutput

    \Aeroidea\Resizer\Resizer Aeroidea\Resizer\Resizer::setOutput(string $output)

Установка итогового пути, задается от корня сайта



* Visibility: **public**


#### Arguments
* $output **string** - Путь к итоговому изображению



### setResizeType

    \Aeroidea\Resizer\Resizer Aeroidea\Resizer\Resizer::setResizeType(integer $resizeType)

Установка типа ресайза



* Visibility: **public**


#### Arguments
* $resizeType **integer** - Тип ресайза (точный/пропорциональный)



### getResult

    string|null Aeroidea\Resizer\Resizer::getResult()

Возвращает ссылку на результат ресайза



* Visibility: **public**




### run

    \Aeroidea\Resizer\Resizer Aeroidea\Resizer\Resizer::run()

Выполнить ресайз



* Visibility: **public**




### resizeImg

    \Aeroidea\Resizer\Resizer Aeroidea\Resizer\Resizer::resizeImg(integer $width, integer $height)

Точный ресайз изображения



* Visibility: **public**


#### Arguments
* $width **integer** - Ширина итогового изображения
* $height **integer** - Высота итогового изображения



### checkInputFile

    mixed Aeroidea\Resizer\Resizer::checkInputFile()

Проверка исходного файла



* Visibility: **protected**




### prepareOutput

    null|string Aeroidea\Resizer\Resizer::prepareOutput(integer $width, integer $height, integer $type)

Формирование пути итогового изображения



* Visibility: **protected**


#### Arguments
* $width **integer** - Ширина изображения
* $height **integer** - Высота изображения
* $type **integer** - Тип ресайза



### resizeImgProportional

    \Aeroidea\Resizer\Resizer Aeroidea\Resizer\Resizer::resizeImgProportional(integer $width, integer $height)

Пропорциональный ресайз изображения



* Visibility: **public**


#### Arguments
* $width **integer** - Ширина итогового изображения
* $height **integer** - Высота итогового изображения



### setWidth

    \Aeroidea\Resizer\Resizer Aeroidea\Resizer\Resizer::setWidth(integer $width)

Установка ширины изображения



* Visibility: **public**


#### Arguments
* $width **integer** - Ширина



### setHeight

    \Aeroidea\Resizer\Resizer Aeroidea\Resizer\Resizer::setHeight(integer $height)

Установыка высоты изображения



* Visibility: **public**


#### Arguments
* $height **integer** - Высота



### setOutputFormat

    \Aeroidea\Resizer\Resizer Aeroidea\Resizer\Resizer::setOutputFormat(string $output_format)

Установка формата выходного файла



* Visibility: **public**


#### Arguments
* $output_format **string** - Формат выходного файла



### setForce

    \Aeroidea\Resizer\Resizer Aeroidea\Resizer\Resizer::setForce(boolean $force)

Установка обязательного пересоздания файла



* Visibility: **public**


#### Arguments
* $force **boolean**



### setOutputFolder

    \Aeroidea\Resizer\Resizer Aeroidea\Resizer\Resizer::setOutputFolder(string $outputFolder)

Установка папки для сохранения итоговых изображений



* Visibility: **public**


#### Arguments
* $outputFolder **string** - Путь к папке, задается от корня сайта


