<?php

/**
 * sfGuardUserTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class sfGuardUserTable extends PluginsfGuardUserTable
{
  /**
   * Returns an instance of this class.
   *
   * @return object sfGuardUserTable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('sfGuardUser');
  }

  public function typecast(&$user) {
    $remove = array('algorithm', 'salt', 'password', 'is_active', 'is_super_admin', 'last_login');
    foreach ($remove as $field)
      unset($user[$field]);
    $user['id'] = (int) $user['id'];
  }
}