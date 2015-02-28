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
  static public function processMoneyStrToFloat($money_string)
  {
    return floatval(str_replace(array(
        ' ', ','
      ), array(
        '', '.'
      ), $money_string));
  }

  static public function underscoreToCamelCase($string, $first_char_caps = false)
  {
    if( $first_char_caps == true )
    {
        $string[0] = strtoupper($string[0]);
    }
    $func = create_function('$c', 'return strtoupper($c[1]);');
    return preg_replace_callback('/_([a-z])/', $func, $string);
  }

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

  /**
   * Returns formatted date: current year, current month.
   *
   * @return String
   */
  static public function getCurrentMonthDate()
  {
    return date("Y-m");
  }

  /**
   * Returns formatted date: current year, current month, first day of current
   * month.
   *
   * @return String
   */
  static public function getBeginningOfTheCurrentMonthDate()
  {
    return date("Y-m-01");
  }

  /**
   * Returns formatted date: current year, current month, last day of current
   * month.
   *
   * @return String
   */
  static public function getEndingOfTheCurrentMonthDate()
  {
    return date("Y-m-".self::getDaysOfMonth(date("m")));
  }
}
