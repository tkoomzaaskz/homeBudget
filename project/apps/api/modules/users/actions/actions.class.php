<?php

/**
 * users actions.
 *
 * @package    finances
 * @class      usersActions
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php
 */
class usersActions extends baseApiActions
{
  protected $db_table = 'sfGuardUser';

  protected function typecast(&$user) {
    $remove = array('algorithm', 'salt', 'password', 'is_active', 'is_super_admin', 'last_login');
    foreach ($remove as $field)
      unset($user[$field]);
    $user['id'] = (int) $user['id'];
  }
}
