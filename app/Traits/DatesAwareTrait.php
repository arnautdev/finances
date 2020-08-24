<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 10.05.19
 * Time: 19:52
 */

namespace App\Traits;

trait DatesAwareTrait
{
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
     *
     */
    public function equalTo()
    {

    }

    /**
     * @param $iDate
     * @param string $type
     */
    public function getDiff($iDate, $type = 'days')
    {
        $currentDate = $this->sDate();
        $diffToDate = $this->sDate($iDate);

        $diff = $currentDate->diff($diffToDate);
        switch ($type) {
            case 'days' :
                return $diff->format('%d');
                break;

            case 'datetime' :

                $ret = '';
                if ($diff->d > 0) {
                    $ret = $diff->d . ' days ' . (($diff->h == 0) ? 'ago ' : '');
                }

                if ($diff->h > 0) {
                    $ret .= $diff->h . ' hours ' . (($diff->i == 0) ? 'ago ' : '');
                }

                if ($diff->i > 0) {
                    $ret .= $diff->i . ' minutes ago ';
                }

                if ($diff->i == 0 && $diff->d == 0 && $diff->h == 0) {
                    $ret = 'Just now...';
                }

                return $ret;
                break;


            default:
                return $diff->format('%d');
        }
    }
}