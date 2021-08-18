<?php

/**
 *
 * Класс для управления комплексными числами
 *
 */
namespace Complex;

/**
 * Complex Number object.
 *
 * @package Complex
 *
 */
class Complex
{
    /**
     * @var    float    $realPart
     */
    protected $realPart = 0.0;

    /**
     * @var    float    $imaginaryPart
     */
    protected $imaginaryPart = 0.0;

    /**
     * @var    string    $suffix
     */
    protected $suffix;

    public function __construct($realPart = 0.0, $imaginaryPart = null, $suffix = 'i')
    {
        if ($imaginaryPart != 0.0 && empty($suffix)) {
            $suffix = 'i';
        } elseif ($imaginaryPart == 0.0 && !empty($suffix)) {
            $suffix = '';
        }

        $this->realPart = (float) $realPart;
        $this->imaginaryPart = (float) $imaginaryPart;
        $this->suffix = strtolower($suffix ?? '');
    }

    /**
     * Получает действительную часть комплексного числа.
     *
     * @return Float
     */
    public function getReal(): float
    {
        return $this->realPart;
    }

    /**
     * Получает мнимую часть комплексного числа.
     *
     * @return Float
     */
    public function getImaginary(): float
    {
        return $this->imaginaryPart;
    }

    /**
     * Получает суффикс комплексного числа
     *
     * @return String
     */
    public function getSuffix(): string
    {
        return $this->suffix;
    }

    /**
     * Проверка, является ли число действительным
     *
     * @return Bool
     */
    public function isReal(): bool
    {
        return $this->imaginaryPart == 0.0;
    }

    /**
     * Проверка, является ли число комплексным
     *
     * @return Bool
     */
    public function isComplex(): bool
    {
        return !$this->isReal();
    }

    public function format(): string
    {
        $str = "";
        if ($this->imaginaryPart != 0.0) {
            if (\abs($this->imaginaryPart) != 1.0) {
                $str .= $this->imaginaryPart . $this->suffix;
            } else {
                $str .= (($this->imaginaryPart < 0.0) ? '-' : '') . $this->suffix;
            }
        }
        if ($this->realPart != 0.0) {
            if (($str) && ($this->imaginaryPart > 0.0)) {
                $str = "+" . $str;
            }
            $str = $this->realPart . $str;
        }
        if (!$str) {
            $str = "0.0";
        }

        return $str;
    }

    /**
     * Возвращает строковое представление комплексног числа
     * 
     * @return String
     */
    public function __toString(): string
    {
        return $this->format();
    }

    /**
     * Проверяет, является ли аргумент допустимым комплексным числом
     *
     * @param     mixed    $complex
     * @return    Complex
     * @throws    Exception
     */
    public static function validateComplexArg($complex): Complex
    {
        if (is_scalar($complex) || is_array($complex)) {
            $complex = new Complex($complex);
        } elseif (!is_object($complex) || !($complex instanceof Complex)) {
            throw new Exception('Значение не является действительным комплексным числом');
        }

        return $complex;
    }
}