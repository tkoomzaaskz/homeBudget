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
  public function executeUsers(sfWebRequest $request)
  {
    $this->urls = array(
      'list' => '@list?module=users',
      'single' => '@show?module=users&id=1'
    );
    $this->command = 'users';
    $this->setTemplate('command');
  }

  /**
   * Executes incomes action. Displays incomes command description.
   *
   * @param sfRequest A request object
   */
  public function executeIncomes(sfWebRequest $request)
  {
    $this->urls = array(
      'list' => '@list?module=incomes',
      'single' => '@show?module=incomes&id=1'
    );
    $this->command = 'incomes';
    $this->setTemplate('command');
  }

  /**
   * Executes outcomes action. Displays outcomes command description.
   *
   * @param sfRequest A request object
   */
  public function executeOutcomes(sfWebRequest $request)
  {
    $this->urls = array(
      'list' => '@list?module=outcomes',
      'single' => '@show?module=outcomes&id=1'
    );
    $this->command = 'outcomes';
    $this->setTemplate('command');
  }

  /**
   * Executes incomeCategories action. Displays income_categories command description.
   *
   * @param sfRequest A request object
   */
  public function executeIncomeCategories(sfWebRequest $request)
  {
    $this->urls = array(
      'list' => '@list?module=income_categories',
      'single' => '@show?module=income_categories&id=35'
    );
    $this->command = 'income_categories';
    $this->setTemplate('command');
  }

  /**
   * Executes outcomeCategories action. Displays outcome_categories command description.
   *
   * @param sfRequest A request object
   */
  public function executeOutcomeCategories(sfWebRequest $request)
  {
    $this->urls = array(
      'list' => '@list?module=outcome_categories',
      'single' => '@show?module=outcome_categories&id=1'
    );
    $this->command = 'outcome_categories';
    $this->setTemplate('command');
  }
}
