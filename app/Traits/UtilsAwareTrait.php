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

    /**
     * @param $args
     * @param string $format
     * @return array
     */
    public function createLabels($args, $format = 'Y-m-d')
    {
        if (!isset($args['from']) || !isset($args['to'])) {
            return [];
        }

        // if fromDate equal or large from the To Date
        if ($this->sDate($args['from'])->format('Y-m-d') >= $this->sDate($args['to'])->format('Y-m-d')) {
            return [];
        }

        $step = '+1 day';
        if (isset($args['step'])) {
            $step = $args['step'];
        }

        $startDate = $this->sDate($args['from']);
        $endDate = $this->sDate($args['to'])->format('Y-m-d');

        $cout = [];
        do {
            $cout[] = $startDate->format('Y-m-d');
            $startDate = $startDate->modify($step);
        } while ($startDate->format('Y-m-d') <= $endDate);

//        array_push($cout, $startDate->format('Y-m-d'));
        return $cout;
    }

}
