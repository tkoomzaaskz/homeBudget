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
}
