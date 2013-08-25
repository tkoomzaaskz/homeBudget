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
    $this->urls = array(
      'users' => array(
        'list' => '@list?module=users',
        'single' => '@show?module=users&id=1'
      ),
      'incomes' => array(
        'list' => '@list?module=incomes',
        'single' => '@show?module=incomes&id=1'
      ),
      'outcomes' => array(
        'list' => '@list?module=outcomes',
        'single' => '@show?module=outcomes&id=1'
      ),
      'income categories' => array(
        'list' => '@list?module=income_categories',
        'single' => '@show?module=income_categories&id=35'
      ),
      'outcome categories' => array(
        'list' => '@list?module=outcome_categories',
        'single' => '@show?module=outcome_categories&id=1'
      ),
    );
  }
}
