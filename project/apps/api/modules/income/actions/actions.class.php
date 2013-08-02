<?php

/**
 * income actions.
 *
 * @package    finances
 * @class      incomeActions
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php
 */
class incomeActions extends sfActions
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
    $outcomes = Doctrine::getTable('Income')
      ->findAll(Doctrine_Core::HYDRATE_ARRAY);
    return $this->renderText(json_encode($outcomes));
  }
}
