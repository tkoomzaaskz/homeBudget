<?php

/**
 * outcome_categories actions.
 *
 * @package    finances
 * @class      outcome_categoriesActions
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php
 */
class outcome_categoriesActions extends sfActions
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
    $categories = Doctrine::getTable('Category')
      ->findByType('OutcomeCategory', Doctrine_Core::HYDRATE_ARRAY);

    foreach ($categories as &$category)
      $this->translate($category);

    $result = array(
      'meta' => array (
        'limit' => null,
        'next' => null,
        'offset' => null,
        'previous' => null,
        'total_count' => count($categories)
      ),
      'objects' => $categories
    );

    return $this->renderText(json_encode($result));
  }

  /**
   * Executes show action
   *
   * @param sfRequest A request object
   */
  public function executeShow(sfWebRequest $request) {
    $category = Doctrine::getTable('Category')
      ->findOneById($request->getParameter('id'))
      ->getData();

    if ($category['type'] != 'OutcomeCategory')
      $category = null;
    else
      $this->translate($category);

    return $this->renderText(json_encode($category));
  }

  private function translate(&$category) {
    $category['id'] = (int) $category['id'];
    if (!is_null($category['parent_id']))
      $category['parent_id'] = (int) $category['parent_id'];
    unset($category['type']);
    unset($category['created_by']);
    unset($category['updated_by']);
  }
}
