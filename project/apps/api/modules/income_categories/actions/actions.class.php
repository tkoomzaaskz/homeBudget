<?php

/**
 * income_categories actions.
 *
 * @package    finances
 * @class      income_categoriesActions
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php
 */
class income_categoriesActions extends baseApiActions
{
  protected $db_table = 'Category';

  /**
   * Executes list action
   *
   * @param sfRequest A request object
   */
  public function executeList(sfWebRequest $request) {
    $table = $this->getTable();
    $categories = $table->findByType('IncomeCategory', Doctrine_Core::HYDRATE_ARRAY);

    foreach ($categories as &$category)
      $this->typecast($category);

    return $this->format($table->wrap($categories));
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

    if ($category['type'] != 'IncomeCategory')
      $category = null;
    else
      $this->typecast($category);

    return $this->renderText(json_encode($category));
  }

  protected function typecast(&$category) {
    $category['id'] = (int) $category['id'];
    if (!is_null($category['parent_id']))
      $category['parent_id'] = (int) $category['parent_id'];
    unset($category['type']);
    unset($category['created_by']);
    unset($category['updated_by']);
  }
}
