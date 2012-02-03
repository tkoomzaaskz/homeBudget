<?php

/**
 * ChartDataManager class.
 *
 * @package    finances
 * @subpackage model
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ChartDataManager
{
  /**
   * Restructures array (no data is modified) - from
   * array
   *   0 =>
   *     array
   *       'sum' => string '3067.45' (length=7)
   *       'date' => string '2011-09' (length=7)
   * to:
   * array
   *   '2011-09' => 'sum' => string '3067.45' (length=7)
   *
   * @param Array $source
   * @return Array
   */
  static private function getTimeAsKeyTranslatedArray($source)
  {
    $result = array();
    foreach ($source as $value)
      $result[$value['date']] = $value['sum'];
    return $result;
  }

  static private function getBalancedValueArray($plus_array, $minus_array)
  {
    $balance_array = array();
    $dates = self::getArrayKeys($plus_array, $minus_array);
    foreach ($dates as $date)
      $balance_array[$date] = $plus_array[$date] - $minus_array[$date];
    return $balance_array;
  }

  static private function getArrayKeys($plus_array, $minus_array)
  {
    return array_unique(array_merge(array_keys($plus_array), array_keys($minus_array)));
  }

  static private function clearArrayKeys($source)
  {
    $result = array();
    foreach ($source as $entry)
      $result[] = $entry;
    return $result;
  }

/******************************************************************************/

  /**
   * Returns data for Category Pie chart. Sums up all outcomes of all categories.
   *
   * @param Array $chart - (optional) from/to
   * @return Array
   */
  static public function getCategoryPieData($chart)
  {
    // fetch data
    $categories = Doctrine::getTable('OutcomeCategory')
      ->getAllCategoriesWithOutcomesQuery($chart)
      ->execute();

    // construct result array
    $result = array();
    foreach ($categories as $category)
    {
      $sum = $category['cash_total_sum'];
      if ($sum) // not to add zero outcomes
        $result[$category['name']] = Tools::priceFormat($sum);
    }
    return $result;
  }

  /**
   * Returns data for Monthly Balance Bars chart. Sums up all incomes and
   * outcomes and compares them.
   *
   * @param Array $chart - (optional) from/to
   * @return Array - structure:
   * array
   *   'keys' =>
   *     array
   *       0 => string '2011-09' (length=7)
   *       1 => string '2011-10' (length=7)
   *       2 => string '2011-11' (length=7)
   *       3 => string '2011-12' (length=7)
   *       4 => string '2012-01' (length=7)
   *   'incomes' =>
   *     array
   *       0 => string '4569.04' (length=7)
   *       1 => string '4519.04' (length=7)
   *       2 => string '5009.04' (length=7)
   *       3 => string '6038.05' (length=7)
   *       4 => string '5721.04' (length=7)
   *   'outcomes' =>
   *     array
   *       0 => string '3294.87' (length=7)
   *       1 => string '3171.76' (length=7)
   *       2 => string '2200.29' (length=7)
   *       3 => string '2734.85' (length=7)
   *       4 => string '1550.87' (length=7)
   *   'balances' =>
   *     array
   *       0 => float 1274.17
   *       1 => float 1347.28
   *       2 => float 2808.75
   *       3 => float 3303.2
   *       4 => float 4170.17
   */
  static public function getMonthlyBalanceBarsData($chart)
  {
    // to do - empty periods (with no data - MySQL returns no rows)

    $outcomes = self::getTimeAsKeyTranslatedArray(
      Doctrine::getTable('Outcome')
      ->getOutcomeMonthlySumByDateRange($chart['date_from'].'-01', $chart['date_to'].'-31', $chart['created_by']));

    $incomes = self::getTimeAsKeyTranslatedArray(
      Doctrine::getTable('Income')
      ->getIncomeMonthlySumByDateRange($chart['date_from'].'-01', $chart['date_to'].'-31', $chart['created_by']));

    $balances = self::getBalancedValueArray($incomes, $outcomes);

    return array(
      'keys' => self::getArrayKeys($incomes, $outcomes),
      'incomes' => self::clearArrayKeys($incomes),
      'outcomes' => self::clearArrayKeys($outcomes),
      'balances' => self::clearArrayKeys($balances),
    );
  }
}
