<?php

/**
 * outcome_categories actions.
 *
 * @package    finances
 * @class      outcome_categoriesActions
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php
 */
class outcome_categoriesActions extends baseApiActions
{
  protected $db_table = 'OutcomeCategory';

  /**
   * Executes show action
   *
   * @param sfRequest A request object
   */
  public function executeShow(sfWebRequest $request) {
    $table = $this->getTable();
    $category = $table->findOneById($request->getParameter('id'))
      ->getData();

    if ($category['type'] != $this->db_table)
      $category = null;
    else
      $table->typecast($category);

    return $this->format($category);
  }

  /**
   * Executes list action
   *
   * @param sfRequest A request object
   */
  public function executeList(sfWebRequest $request) {
    $table = $this->getTable();
    $categories = $table->findByType($this->db_table, Doctrine_Core::HYDRATE_ARRAY);

    foreach ($categories as &$category)
      $table->typecast($category);

    return $this->format($table->wrap($categories));
  }
}
