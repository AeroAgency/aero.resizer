Aeroidea\Resizer\ImagickResizer
===============

Class ImagickResizer




* Class name: ImagickResizer
* Namespace: Aeroidea\Resizer
* Parent class: [Aeroidea\Resizer\BaseResizer](Aeroidea-Resizer-BaseResizer.md)



Constants
----------


### MIN_FILE_SIZE

    const MIN_FILE_SIZE = 30







Methods
-------


### resizeImg

    string Aeroidea\Resizer\ResizerInterface::resizeImg(string $input, integer $width, integer $height, string $output, integer $quality, string $output_format, boolean $force)

Точный ресайз изображения



* Visibility: **public**
* This method is defined by [Aeroidea\Resizer\ResizerInterface](Aeroidea-Resizer-ResizerInterface.md)


#### Arguments
* $input **string** - Путь к исходному изображению
* $width **integer** - Ширина итогового изображения
* $height **integer** - Высота итогового изображения
* $output **string** - Путь к итоговому изображению
* $quality **integer** - Качество изображения в пределах 1-100
* $output_format **string** - Формат выходного файла
* $force **boolean** - Обязательное пересоздание файла



### prepareArguments

    mixed Aeroidea\Resizer\ImagickResizer::prepareArguments($input, $output, string $output_format)

Подготовка параметров



* Visibility: **protected**


#### Arguments
* $input **mixed**
* $output **mixed**
* $output_format **string**



### saveFile

    mixed Aeroidea\Resizer\ImagickResizer::saveFile(\Imagick $imagick, integer $quality, string $output, string $output_format)

Сохранение файла



* Visibility: **protected**


#### Arguments
* $imagick **Imagick**
* $quality **integer**
* $output **string**
* $output_format **string**



### resizeImgProportional

    string Aeroidea\Resizer\ResizerInterface::resizeImgProportional(string $input, integer $width, integer $height, string $output, integer $quality, string $output_format, boolean $force)

Пропорциональный ресайз изображения



* Visibility: **public**
* This method is defined by [Aeroidea\Resizer\ResizerInterface](Aeroidea-Resizer-ResizerInterface.md)


#### Arguments
* $input **string** - Путь к исходному изображению
* $width **integer** - Ширина итогового изображения
* $height **integer** - Высота итогового изображения
* $output **string** - Путь к итоговому изображению
* $quality **integer** - Качество изображения в пределах 1-100
* $output_format **string** - Формат выходного файла
* $force **boolean** - Обязательное пересоздание файла



### checkResizer

    boolean Aeroidea\Resizer\ResizerInterface::checkResizer()

Проверка доступности ресайзера



* Visibility: **public**
* This method is defined by [Aeroidea\Resizer\ResizerInterface](Aeroidea-Resizer-ResizerInterface.md)




### needPrepareOutput

    boolean Aeroidea\Resizer\ResizerInterface::needPrepareOutput()

Подготавливать путь к выходному файлу



* Visibility: **public**
* This method is defined by [Aeroidea\Resizer\ResizerInterface](Aeroidea-Resizer-ResizerInterface.md)




### needPrepareInput

    boolean Aeroidea\Resizer\ResizerInterface::needPrepareInput()

Подготавливать исходный сайт



* Visibility: **public**
* This method is defined by [Aeroidea\Resizer\ResizerInterface](Aeroidea-Resizer-ResizerInterface.md)




### isImageExist

    boolean Aeroidea\Resizer\BaseResizer::isImageExist($input, $force, $foutput)

Проверка наличия конечного файла



* Visibility: **protected**
* This method is defined by [Aeroidea\Resizer\BaseResizer](Aeroidea-Resizer-BaseResizer.md)


#### Arguments
* $input **mixed**
* $force **mixed**
* $foutput **mixed**


