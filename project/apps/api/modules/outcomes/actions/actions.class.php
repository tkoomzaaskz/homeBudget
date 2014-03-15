<?php

/**
 * outcomes actions.
 *
 * @package    finances
 * @class      outcomeActions
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php
 */
class outcomesActions extends baseApiActions
{
  protected $db_table = 'Outcome';

  protected function typecast(&$outcome) {
    $outcome['id'] = (int) $outcome['id'];
    $outcome['category_id'] = (int) $outcome['category_id'];
    $outcome['created_by'] = (int) $outcome['created_by'];
    $outcome['amount'] = (float) $outcome['amount'];
  }
}
