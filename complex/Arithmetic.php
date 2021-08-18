<?php

namespace Complex;

use InvalidArgumentException;

class Arithmetic
{
    /**
     * Складывает два или более комплексных числа
     *
     * @param     array of string|integer|float|Complex    $complexValues
     * @return    Complex
     */
    public static function add(...$complexValues): Complex
    {
        if (count($complexValues) < 2) {
            throw new \Exception('Этой функции нужно минимум два аргумента');
        }

        $base = array_shift($complexValues);
        $result = clone Complex::validateComplexArg($base);

        foreach ($complexValues as $complex) {
            $complex = Complex::validateComplexArg($complex);

            if ($result->isComplex() && $complex->isComplex() &&
                $result->getSuffix() !== $complex->getSuffix()) {
                throw new Exception('Несоответствие суффиксов');
            }

            $real = $result->getReal() + $complex->getReal();
            $imaginary = $result->getImaginary() + $complex->getImaginary();

            $result = new Complex(
                $real,
                $imaginary,
                ($imaginary == 0.0) ? null : max($result->getSuffix(), $complex->getSuffix())
            );
        }

        return $result;
    }

    /**
     * Делит два или более комплексных числа
     *
     * @param     array of string|integer|float|Complex    $complexValues
     * @return    Complex
     */
    public static function divideby(...$complexValues): Complex
    {
        if (count($complexValues) < 2) {
            throw new \Exception('Этой функции нужно минимум два аргумента');
        }

        $base = array_shift($complexValues);
        $result = clone Complex::validateComplexArg($base);

        foreach ($complexValues as $complex) {
            $complex = Complex::validateComplexArg($complex);

            if ($result->isComplex() && $complex->isComplex() &&
                $result->getSuffix() !== $complex->getSuffix()) {
                throw new Exception('Несоответствие суффиксов');
            }
            if ($complex->getReal() == 0.0 && $complex->getImaginary() == 0.0) {
                throw new InvalidArgumentException('Деление на ноль');
            }

            $delta1 = ($result->getReal() * $complex->getReal()) +
                ($result->getImaginary() * $complex->getImaginary());
            $delta2 = ($result->getImaginary() * $complex->getReal()) -
                ($result->getReal() * $complex->getImaginary());
            $delta3 = ($complex->getReal() * $complex->getReal()) +
                ($complex->getImaginary() * $complex->getImaginary());

            $real = $delta1 / $delta3;
            $imaginary = $delta2 / $delta3;

            $result = new Complex(
                $real,
                $imaginary,
                ($imaginary == 0.0) ? null : max($result->getSuffix(), $complex->getSuffix())
            );
        }

        return $result;
    }

    /**
     * Умножает два или более комплексных числа
     *
     * @param     array of string|integer|float|Complex    $complexValues
     * @return    Complex
     */
    public static function multiply(...$complexValues): Complex
    {
        if (count($complexValues) < 2) {
            throw new \Exception('Этой функции нужно минимум два аргумента');
        }

        $base = array_shift($complexValues);
        $result = clone Complex::validateComplexArg($base);

        foreach ($complexValues as $complex) {
            $complex = Complex::validateComplexArg($complex);

            if ($result->isComplex() && $complex->isComplex() &&
                $result->getSuffix() !== $complex->getSuffix()) {
                throw new Exception('Несоответствие суффиксов');
            }

            $real = ($result->getReal() * $complex->getReal()) -
                ($result->getImaginary() * $complex->getImaginary());
            $imaginary = ($result->getReal() * $complex->getImaginary()) +
                ($result->getImaginary() * $complex->getReal());

            $result = new Complex(
                $real,
                $imaginary,
                ($imaginary == 0.0) ? null : max($result->getSuffix(), $complex->getSuffix())
            );
        }

        return $result;
    }

    /**
     * Вычитает два или более комплексных числа
     *
     * @param     array of string|integer|float|Complex    $complexValues
     * @return    Complex
     */
    public static function subtract(...$complexValues): Complex
    {
        if (count($complexValues) < 2) {
            throw new \Exception('Этой функции нужно минимум два аргумента');
        }

        $base = array_shift($complexValues);
        $result = clone Complex::validateComplexArg($base);

        foreach ($complexValues as $complex) {
            $complex = Complex::validateComplexArg($complex);

            if ($result->isComplex() && $complex->isComplex() &&
                $result->getSuffix() !== $complex->getSuffix()) {
                throw new Exception('Несоответствие суффиксов');
            }

            $real = $result->getReal() - $complex->getReal();
            $imaginary = $result->getImaginary() - $complex->getImaginary();

            $result = new Complex(
                $real,
                $imaginary,
                ($imaginary == 0.0) ? null : max($result->getSuffix(), $complex->getSuffix())
            );
        }

        return $result;
    }
}