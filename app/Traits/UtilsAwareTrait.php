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

    /**
     * Get date object
     * @param null $iDate
     * @return DateTime
     */
    public function getSqlDate($iDate = null)
    {
        $date = (is_null($iDate)) ? date('Y-m-d') : date('Y-m-d', strtotime($iDate));
        return new \DateTime($date);
    }

    /**
     * @param null $iDate
     * @return DateTime
     */
    public function sDate($iDate = null)
    {
        $date = date('Y-m-d H:i:s');
        if (!is_null($iDate)) {
            $date = date('Y-m-d H:i:s', strtotime($iDate));
        }
        return new \DateTime($date);
    }

    /**
     * @param $date
     * @return bool
     */
    public function isToday($date)
    {
        $date = $this->sDate($date);
        $today = $this->sDate();
        if ($date->format('Ymd') == $today->format('Ymd')) {
            return true;
        }
        return false;
    }
}
