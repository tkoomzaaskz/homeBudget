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

  protected $required = array('category_id', 'amount', 'created_by');
}
