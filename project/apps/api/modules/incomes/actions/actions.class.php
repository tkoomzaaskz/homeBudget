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
   * Executes list action
   *
   * @param sfRequest A request object
   */
  public function executeList(sfWebRequest $request) {
    $incomes = Doctrine::getTable('Income')
      ->findAll(Doctrine_Core::HYDRATE_ARRAY);

    foreach ($incomes as &$income)
      $this->translate($income);

    $result = array(
      'meta' => array (
        'limit' => null,
        'next' => null,
        'offset' => null,
        'previous' => null,
        'total_count' => count($incomes)
      ),
      'objects' => $incomes
    );

    return $this->renderText(json_encode($result));
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

    $this->translate($income);
    return $this->renderText(json_encode($income));
  }

  private function translate(&$income) {
    $income['id'] = (int) $income['id'];
    $income['category_id'] = (int) $income['category_id'];
    $income['created_by'] = (int) $income['created_by'];
    $income['amount'] = (float) $income['amount'];
  }
}
