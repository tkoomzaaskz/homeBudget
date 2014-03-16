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

  protected $required = array('first_name', 'last_name', 'email_address', 'username');
}
