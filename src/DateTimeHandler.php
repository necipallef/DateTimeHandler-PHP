<?php

class DateTimeHandler
{

    /**
     * @return int
     */
    public static function now()
    {
        return time();
    }


    /**
     * @return string
     */
    public static function currentTime()
    {
        $format = 'Y-m-d H:i:s';
        return self::currentTimeWithFormat($format);
    }

    /**
     * @return string
     */
    public static function currentDate()
    {
        $format = 'Y-m-d';
        return self::currentTimeWithFormat($format);
    }

    /**
     * @param $format
     * @return string
     */
    public static function currentTimeWithFormat($format)
    {
        return self::timeWithFormat($format, self::now());
    }

    /**
     * @param string $format
     * @param string $time
     * @return string
     */
    public static function timeWithFormat($format, $time)
    {
        $date = gmdate($format, $time);
        if ($date === false) {
            return "";
        }

        return $date;
    }

    /**
     * @param $date_string
     * @param $day
     * @return string
     */
    public static function addDays($date_string, $day)
    {
        $format = 'Y-m-d H:i:s';
        return self::addDaysWithFormat($format, $date_string, $day);
    }

    /**
     * @param string $format
     * @param string $date_string
     * @param int $day
     * @return string
     */
    public static function addDaysWithFormat($format, $date_string, $day)
    {
        $seconds = (24 * 60 * 60) * $day;
        return self::addSecondsWithFormat($format, $date_string, $seconds);
    }


    /**
     * @param string $format
     * @param string $date_string
     * @param int $seconds
     * @return string
     */
    public static function addSecondsWithFormat($format, $date_string, $seconds)
    {
        $unix_time = self::strToTimeUTC($date_string);
        $unix_time += $seconds;
        return self::timeWithFormat($format, $unix_time);
    }


    /**
     * @param string $format
     * @param float $seconds
     * @return string
     */
    public static function afterSecondsFromNowWithFormat($format, $seconds)
    {
        return self::addSecondsWithFormat($format, self::currentTime(), $seconds);
    }


    /**
     * @param string $date_string
     * @return string
     */
    public static function getPreviousDay($date_string)
    {
        $format = 'Y-m-d H:i:s';
        return self::getPreviousDayWithFormat($format, $date_string);
    }

    /**
     * @param string $format
     * @param string $date_string
     * @return string
     */
    public static function getPreviousDayWithFormat($format, $date_string)
    {
        return self::addDaysWithFormat($format, $date_string, -1);
    }

    /**
     * @param string $date_string
     * @return string
     */
    public static function getNextDay($date_string)
    {
        $format = 'Y-m-d H:i:s';
        return self::getNextDayWithFormat($format, $date_string);
    }


    /**
     * @param string $format
     * @param string $date_string
     * @return string
     */
    public static function getNextDayWithFormat($format, $date_string)
    {
        return self::addDaysWithFormat($format, $date_string, 1);
    }


    /**
     * @param string $date_string
     * @return bool
     */
    public static function isLaterThanNow($date_string)
    {
        $now = self::currentTime();
        return self::isLaterThan($date_string, $now);
    }


    /**
     * @param string $first_date_string
     * @param string $second_date_string
     * @return bool
     */
    public static function isLaterThan($first_date_string, $second_date_string)
    {
        return $first_date_string > $second_date_string;
    }


    /**
     * @param string $date_string
     * @return int
     */
    public static function remainingTimeUntil($date_string)
    {
        return self::strToTimeUTC($date_string) - self::now();
    }


    /**
     * @param string $date_string
     * @return int
     */
    public static function elapsedTimeSince($date_string)
    {
        return self::now() - self::strToTimeUTC($date_string);
    }


    /**
     * @param string $date_string
     * @return false|int
     */
    public static function strToTimeUTC($date_string)
    {
        return strtotime($date_string . " UTC");
    }


    /**
     * @param float $seconds
     * @return string
     */
    public static function afterSecondsFromNow($seconds)
    {
        $format = 'Y-m-d H:i:s';
        return self::afterSecondsFromNowWithFormat($format, $seconds);
    }
}
