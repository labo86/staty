edwrodrig\staty
========
Una biblioteca para generar [sitios estáticos](https://en.wikipedia.org/wiki/Static_web_page).
Esta librería reemplaza mi [antiguo proyecto](https://github.com/edwrodrig/static_generator).

[![Latest Stable Version](https://poser.pugx.org/edwrodrig/staty/v/stable)](https://packagist.org/packages/edwrodrig/staty)
[![Total Downloads](https://poser.pugx.org/edwrodrig/staty/downloads)](https://packagist.org/packages/edwrodrig/staty)
[![License](https://poser.pugx.org/edwrodrig/staty/license)](https://packagist.org/packages/edwrodrig/staty)
[![Build Status](https://travis-ci.org/edwrodrig/staty.svg?branch=master)](https://travis-ci.org/edwrodrig/staty)
[![codecov.io Code Coverage](https://codecov.io/gh/edwrodrig/staty/branch/master/graph/badge.svg)](https://codecov.io/github/edwrodrig/staty?branch=master)
[![Code Climate](https://codeclimate.com/github/edwrodrig/staty/badges/gpa.svg)](https://codeclimate.com/github/edwrodrig/staty)
![Hecho en Chile](https://img.shields.io/badge/country-Chile-red)

## Uso
```php
use edwrodrig\staty_core\Context;
use edwrodrig\staty_core\ReaderDirectory;
use edwrodrig\staty_core\Generator;

$context = new Context('web/path');

$reader = new ReaderDirectory($context, 'pages');
$pages = iterator_to_array($reader->readPages(), false);

$generator = new Generator('www');
$generator->setPageList($pages);
$generator->generate();
```

## Mis casos de uso

 * Facilidad para migrar sitios HTML/PHP existentes.
 * Facilidad para crear paginas en PHP puro.
 * Quiero mantener las cosas [tan simples como se pueda](https://en.wikipedia.org/wiki/KISS_principle).  


## Instalación
```
composer require edwrodrig/hapi
```

## Información de mi máquina de desarrollo
Salida de [system_info.sh](https://github.com/edwrodrig/staty/blob/master/scripts/system_info.sh)
```
+ hostnamectl
+ grep -e 'Operating System:' -e Kernel:
  Operating System: Ubuntu 20.04 LTS
            Kernel: Linux 5.4.0-33-generic
+ php --version
PHP 7.4.3 (cli) (built: May 26 2020 12:24:22) ( NTS )
Copyright (c) The PHP Group
Zend Engine v3.4.0, Copyright (c) Zend Technologies
    with Zend OPcache v7.4.3, Copyright (c), by Zend Technologies
    with Xdebug v2.9.2, Copyright (c) 2002-2020, by Derick Rethans
```

## Notas
  - El código se apega a las recomendaciones de estilo de [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md).
  - Este proyecto esta pensado para ser trabajado usando [PhpStorm](https://www.jetbrains.com/phpstorm).
  - Se usa [PHPUnit](https://phpunit.de/) para las pruebas unitarias de código.
  - Para la documentación se utiliza el estilo de [phpDocumentor](http://docs.phpdoc.org/references/phpdoc/basic-syntax.html). 

