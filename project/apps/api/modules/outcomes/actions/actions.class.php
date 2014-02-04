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
   * Executes list action
   *
   * @param sfRequest A request object
   */
  public function executeList(sfWebRequest $request) {
    $outcomes = Doctrine::getTable('Outcome')
        ->findAll(Doctrine_Core::HYDRATE_ARRAY);

    foreach ($outcomes as &$outcome)
      $this->translate($outcome);

    $result = array(
      'meta' => array (
        'limit' => null,
        'next' => null,
        'offset' => null,
        'previous' => null,
        'total_count' => count($outcomes)
      ),
      'objects' => $outcomes
    );

    return $this->renderText(json_encode($result));
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
    $outcome['id'] = (int) $outcome['id'];
    $outcome['category_id'] = (int) $outcome['category_id'];
    $outcome['created_by'] = (int) $outcome['created_by'];
    // translate response structure
    // to be removed when database schema is updated
    $outcome['amount'] = (float) $outcome['amount'];
    unset($outcome['amount']);
    $outcome['description'] = $outcome['comment'];
    unset($outcome['comment']);
  }
}
