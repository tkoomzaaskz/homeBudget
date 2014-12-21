<?php

/**
 * main actions.
 *
 * @package    finances
 * @class      mainActions
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php
 */
class mainActions extends sfActions
{
  /**
   * Executes index action
   *
   * @param sfRequest A request object
   */
  public function executeIndex(sfWebRequest $request)
  {
  }

  /**
   * Executes users action. Displays users command description.
   *
   * @param sfRequest A request object
   */
  public function executeModelUsers(sfWebRequest $request)
  {
    $this->urls = array(
      'collection' => '@collection?module=users',
      'instance' => '@instance?module=users&id=1'
    );
    $this->command = 'users';
    $this->setTemplate('command');
  }

  /**
   * Executes incomes action. Displays incomes command description.
   *
   * @param sfRequest A request object
   */
  public function executeModelIncomes(sfWebRequest $request)
  {
    $this->urls = array(
      'collection' => '@collection?module=incomes',
      'instance' => '@instance?module=incomes&id=1'
    );
    $this->command = 'incomes';
    $this->setTemplate('command');
  }

  /**
   * Executes outcomes action. Displays outcomes command description.
   *
   * @param sfRequest A request object
   */
  public function executeModelOutcomes(sfWebRequest $request)
  {
    $this->urls = array(
      'collection' => '@collection?module=outcomes',
      'instance' => '@instance?module=outcomes&id=1'
    );
    $this->command = 'outcomes';
    $this->setTemplate('command');
  }

  /**
   * Executes incomeCategories action. Displays income_categories command description.
   *
   * @param sfRequest A request object
   */
  public function executeModelIncomeCategories(sfWebRequest $request)
  {
    $this->urls = array(
      'collection' => '@collection?module=income_categories',
      'instance' => '@instance?module=income_categories&id=35'
    );
    $this->command = 'income_categories';
    $this->setTemplate('command');
  }

  /**
   * Executes outcomeCategories action. Displays outcome_categories command description.
   *
   * @param sfRequest A request object
   */
  public function executeModelOutcomeCategories(sfWebRequest $request)
  {
    $this->urls = array(
      'collection' => '@collection?module=outcome_categories',
      'instance' => '@instance?module=outcome_categories&id=1'
    );
    $this->command = 'outcome_categories';
    $this->setTemplate('command');
  }

  /**
   * Executes chartCategoryPie action. Displays category pie chart command description.
   *
   * @param sfRequest A request object
   */
  public function executeChartCategoryPie(sfWebRequest $request)
  {
    $this->urls = array(
      'example' => '@chart?action=categoryPie&date_from=2012-12-21&date_to=2013-01-27&created_by=2',
      'example sum subcategories' => '@chart?action=categoryPie&date_from=2012-12-21&date_to=2013-01-27&created_by=2&sum_subcategories=true',
    );
    $this->command = 'chart_category_pie';
    $this->setTemplate('command');
  }

  /**
   * Executes chartMonthlyBalanceBars action. Displays monthly balance bars chart command description.
   *
   * @param sfRequest A request object
   */
  public function executeChartMonthlyBalanceBars(sfWebRequest $request)
  {
    // days are not taken into account (truncated, these are monthly calculations)
    $this->urls = array(
      'example' => '@chart?action=monthlyBalanceBars&date_from=2012-12&date_to=2013-04&created_by=2',
      'example sum periods' => '@chart?action=monthlyBalanceBars&date_from=2012-12&date_to=2013-04&created_by=2&sum_periods=true',
    );
    $this->command = 'chart_monthly_balance_bars';
    $this->setTemplate('command');
  }
}
