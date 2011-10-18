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
}
