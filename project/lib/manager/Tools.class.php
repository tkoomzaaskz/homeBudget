<?php

/**
 * Tools class.
 *
 * @package    finances
 * @subpackage model
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Tools
{
  /**
   * Formats price to show two digits after the dot and no additional characters
   * above the dot.
   *
   * @param String $value - value to be formatted.
   * @param Boolean $unit - if currency unit should be added.
   * @return String - formatted price.
   */
  static public function priceFormat($value, $unit = false)
  {
    return number_format($value, 2, '.', '') . ($unit ? ' zł' : '');
  }

  /**
   * Returns number of days of a given month for the current year.
   *
   * @param Integer $month - range 1..12
   * @return Integer - either 28, 29, 30 or 31.
   */
  static public function getDaysOfMonth($month)
  {
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    $date_string = strtotime("-1 second", strtotime("+1 month", strtotime($month."/01/".date("Y")."00:00:00")));
    $last_day_of_month = date("Y-m-d", $date_string);
    return substr($last_day_of_month, -2);
  }

  static public function getBeginningOfTheMonthDate()
  {
    return date("Y-m-01");
  }

  static public function getEndingOfTheMonthDate()
  {
    return date("Y-m-".self::getDaysOfMonth(date("m")));
  }
}
