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
   * where all periods are defined (zero value if no value passed in source
   * array).
   *
   * @param Array $periods
   * @param Array $source
   * @return Array
   */
  static private function getPeriodedArray($periods, $source)
  {
    $result = array();
    foreach ($periods as $period)
      $result[$period] = 0;

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

  static private function generatePeriodsArrayByMonths($chart)
  {
    $result = array();
    $from_tmp = explode('-', $chart['date_from']);
    $from_year = $from_tmp[0];
    $from_month = $from_tmp[1];
    $to_tmp = explode('-', $chart['date_to']);
    $to_year = $to_tmp[0];
    $to_month = $to_tmp[1];
    for ($ind_year = (int) $from_year; $ind_year <= $to_year; $ind_year++)
    { // for all year mentioned
      $start_month = ($ind_year == $from_year ? $from_month : 1);
      $end_month = ($ind_year == $to_year ? $to_month : 12);
      for ($ind_month = (int) $start_month; $ind_month <= $end_month; $ind_month++)
      {
        $result[] = $ind_year.'-'.sprintf("%02d", $ind_month);
      }
    }
    return $result;
  }

  static private function clearArrayKeys($source)
  {
    $result = array();
    foreach ($source as $entry)
      $result[] = $entry;
    return $result;
  }

  /**
   * Returns the biggest absolute value passed in either incomes or outcomes.
   */
  static function roundToMax($incomes, $outcomes)
  {
    $max = max(max($incomes), abs(min($outcomes)));
    $i = 0;
    $copy = $max;
    while ($copy > 10)
    {
      $copy /= 10;
      $i++;
    }
    return round($max, -$i);
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
    $calc = array();
    foreach ($categories as $category)
    {
      $calc[$category['id']] = array(
        'name' => $category['name'],
        'parent_id' => $category['parent_id'],
        'sum' => $category['amount_sum'],
      );
    }

    // sum subcategories
    if ($chart['sum_subcategories'] == 'true')
      foreach ($calc as $id => &$r)
      {
        if ($r['parent_id'])
        {
          $calc[$r['parent_id']]['sum'] += $r['sum'];
          unset($calc[$id]);
        }
      }

    $result = array();
    foreach ($calc as $r)
    {
      if ($r['sum'] > 0)
        $result[$r['name']] = Tools::priceFormat($r['sum']);
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
    $periods = self::generatePeriodsArrayByMonths($chart);

    $outcomes_raw = Doctrine::getTable('Outcome')
      ->getOutcomeMonthlySumByDateRange($chart['date_from'].'-01', $chart['date_to'].'-31', $chart['created_by']);
    $outcomes = self::getPeriodedArray($periods, $outcomes_raw);

    $incomes_raw = Doctrine::getTable('Income')
      ->getIncomeMonthlySumByDateRange($chart['date_from'].'-01', $chart['date_to'].'-31', $chart['created_by']);
    $incomes = self::getPeriodedArray($periods, $incomes_raw);

    if ($chart['sum_periods'] == 'true') {
      $total_income = array_sum($incomes);
      $total_outcome = array_sum($outcomes);
      return array(
        'keys' => array($chart['date_from'] . ' - ' . $chart['date_to']),
        'incomes' => array($total_income),
        'outcomes' => array($total_outcome),
        'balances' => array($total_income - $total_outcome),
      );
    } else {
      $balances = self::getBalancedValueArray($incomes, $outcomes);
      return array(
        'keys' => self::getArrayKeys($incomes, $outcomes),
        'incomes' => self::clearArrayKeys($incomes),
        'outcomes' => self::clearArrayKeys($outcomes),
        'balances' => self::clearArrayKeys($balances),
      );
    }
  }
}
