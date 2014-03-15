<?php

/**
 * incomes actions.
 *
 * @package    finances
 * @class      incomeActions
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php
 */
class incomesActions extends baseApiActions
{
  protected $db_table = 'Income';

  protected function typecast(&$income) {
    $income['id'] = (int) $income['id'];
    $income['category_id'] = (int) $income['category_id'];
    $income['created_by'] = (int) $income['created_by'];
    $income['amount'] = (float) $income['amount'];
  }
}
