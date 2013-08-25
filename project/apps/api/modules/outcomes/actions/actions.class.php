<?php

/**
 * outcomes actions.
 *
 * @package    finances
 * @class      outcomeActions
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php
 */
class outcomesActions extends sfActions {

  public function preExecute() {
    $this->getResponse()->setHttpHeader('Content-type', 'application/json');
  }

  /**
   * Executes index action
   *
   * @param sfRequest A request object
   */
  public function executeIndex(sfWebRequest $request) {
    $outcomes = array(
      'objects' => Doctrine::getTable('Outcome')
        ->findAll(Doctrine_Core::HYDRATE_ARRAY)
    );
    // translate response structure
    // to be removed when database schema is updated
    foreach ($outcomes['objects'] as &$outcome) {
      $this->translate($outcome);
    }

    return $this->renderText(json_encode($outcomes));
  }
  
  /**
   * Executes show action
   *
   * @param sfRequest A request object
   */
  public function executeShow(sfWebRequest $request) {
    $outcome = Doctrine::getTable('Outcome')
      ->findOneById($request->getParameter('id'))
      ->getData();
    $this->translate($outcome);
    return $this->renderText(json_encode($outcome));
  }

  private function translate(&$outcome) {
    $outcome['amount'] = $outcome['cash_total'];
    unset($outcome['cash_total']);
    $outcome['description'] = $outcome['comment'];
    unset($outcome['comment']);
  }
}
