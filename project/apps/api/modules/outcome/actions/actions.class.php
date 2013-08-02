<?php

/**
 * outcome actions.
 *
 * @package    finances
 * @class      outcomeActions
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php
 */
class outcomeActions extends sfActions {

  public function preExecute() {
    $this->getResponse()->setHttpHeader('Content-type', 'application/json');
  }
  
  /**
   * Executes index action
   *
   * @param sfRequest A request object
   */
  public function executeIndex(sfWebRequest $request) {
    $outcomes = Doctrine::getTable('Outcome')
      ->findAll(Doctrine_Core::HYDRATE_ARRAY);
    return $this->renderText(json_encode($outcomes));
  }
}
