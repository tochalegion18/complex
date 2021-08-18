<?php

use Complex\Complex as Complex;
use Complex\Arithmetic;

include(__DIR__ . '/../vendor/autoload.php');

$values = [
    new Complex(123),
    new Complex(456, 123),
    new Complex(0.0, 456),
];

foreach ($values as $value) {
    echo $value, PHP_EOL;
}

echo 'Сложение', PHP_EOL;

$result = Arithmetic::add(...$values);
echo '=> ', $result, PHP_EOL;

echo PHP_EOL;

echo 'Вычитание', PHP_EOL;

$result = Arithmetic::subtract(...$values);
echo '=> ', $result, PHP_EOL;

echo PHP_EOL;

echo 'Умножение', PHP_EOL;

$result = Arithmetic::multiply(...$values);
echo '=> ', $result, PHP_EOL;

echo PHP_EOL;

echo 'Деление', PHP_EOL;

$result = Arithmetic::divideby(...$values);
echo '=> ', $result, PHP_EOL;