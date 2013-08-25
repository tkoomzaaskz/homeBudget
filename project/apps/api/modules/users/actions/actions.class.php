<?php

/**
 * users actions.
 *
 * @package    finances
 * @class      usersActions
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php
 */
class usersActions extends sfActions
{
  public function preExecute() {
    $this->getResponse()->setHttpHeader('Content-type', 'application/json');
  }
  
  /**
   * Executes index action
   *
   * @param sfRequest A request object
   */
  public function executeIndex(sfWebRequest $request) {
    $users = array(
      'objects' => Doctrine::getTable('sfGuardUser')
        ->findAll(Doctrine_Core::HYDRATE_ARRAY)
    );
    foreach ($users['objects'] as &$user)
      $this->translate($user);
    return $this->renderText(json_encode($users));
  }
  
  /**
   * Executes show action
   *
   * @param sfRequest A request object
   */
  public function executeShow(sfWebRequest $request) {
    $user = Doctrine::getTable('sfGuardUser')
      ->findOneById($request->getParameter('id'))
      ->getData();
    $this->translate($user);
    return $this->renderText(json_encode($user));
  }

  private function translate(&$user) {
    $remove = array('algorithm', 'salt', 'password', 'is_active', 'is_super_admin', 'last_login');
    foreach ($remove as $field)
      unset($user[$field]);
  }
}
