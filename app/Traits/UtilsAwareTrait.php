<?php


namespace App\Traits;


trait UtilsAwareTrait
{
    /**
     * Convert
     * @return float
     */
    public function intToFloat($amount)
    {
        if (strpos($amount, '.') !== false) {
            $amount = $this->floatToInt($amount);
        }
        return number_format(($amount / 100), 2, '.', '');
    }

    /**
     * Convert
     * @return int
     */
    public function floatToInt($amount): int
    {
        if (strpos($amount, '.') === false) {
            $amount = number_format(floatval(trim($amount)), 2, '.', '');
        }
        $num = intval(strval(number_format(floatval(trim($amount)), 2, '.', '') * 100));
        return $num;
    }
}
