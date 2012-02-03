<?php

/**
 * IncomeTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class IncomeTable extends Doctrine_Table
{
  /**
   * Returns an instance of this class.
   *
   * @return object IncomeTable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('Income');
  }

  /**
   * Returns array of monthly sums of all incomes for a given date range,
   * optionally filtered by user.
   *
   * @param String $date_from
   * @param String $date_to
   * @param Integer $created_by
   * @return object Doctrine_Query
   */
  public static function getIncomeMonthlySumByDateRange($date_from, $date_to, $created_by = null)
  {
    $query = Doctrine_Query::create()
      ->select('SUM(i.amount) AS sum, DATE_FORMAT( i.created_at, "%Y-%m" ) AS date')
      ->from('Income i')
      ->where("i.created_at BETWEEN '{$date_from}' AND '{$date_to}'")
      ->groupBy('YEAR(i.created_at)')
      ->addGroupBy('MONTH(i.created_at)')
      ->orderBy('i.created_at ASC');
    if ($created_by) $query->andWhere('i.created_by = ?', $created_by);
    return $query->fetchArray();
  }

  /**
   * Returns query retrieving Income objects with related data. Method used in
   * symfony/doctrine admin backend module list.
   *
   * @return object Doctrine_Query
   */
  public static function getIncomesBackendListQuery()
  {
    return Doctrine_Query::create()
      ->from('Income i')
      ->leftJoin('i.Creator cr')
      ->orderBy('i.created_at DESC');
  }
}
