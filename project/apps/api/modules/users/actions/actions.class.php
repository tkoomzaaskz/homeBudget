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
   * Executes list action
   *
   * @param sfRequest A request object
   */
  public function executeList(sfWebRequest $request) {
    $users = Doctrine::getTable('sfGuardUser')
      ->findAll(Doctrine_Core::HYDRATE_ARRAY);

    foreach ($users as &$user)
      $this->translate($user);

    $result = array(
      'meta' => array (
        'limit' => null,
        'next' => null,
        'offset' => null,
        'previous' => null,
        'total_count' => count($users)
      ),
      'objects' => $users
    );

    return $this->renderText(json_encode($result));
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
    $user['id'] = (int) $user['id'];
  }
}
