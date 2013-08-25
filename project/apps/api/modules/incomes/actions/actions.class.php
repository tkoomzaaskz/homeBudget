<?php

/**
 * incomes actions.
 *
 * @package    finances
 * @class      incomeActions
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php
 */
class incomesActions extends sfActions
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
    $incomes = array(
      'objects' => Doctrine::getTable('Income')
        ->findAll(Doctrine_Core::HYDRATE_ARRAY)
    );
    return $this->renderText(json_encode($incomes));
  }

  /**
   * Executes show action
   *
   * @param sfRequest A request object
   */
  public function executeShow(sfWebRequest $request) {
    $income = Doctrine::getTable('Income')
      ->findOneById($request->getParameter('id'))
      ->getData();
    return $this->renderText(json_encode($income));
  }
}
