<?php

class baseApiActions extends sfActions {

  public function preExecute()
  {
    $this->getResponse()->setHttpHeader('Content-type', 'application/json');
  }

  public function getTable()
  {
    return Doctrine::getTable($this->db_table);
  }

  protected function format($result)
  {
    return $this->renderText(json_encode($result));
  }

/*****************************************************************************/

  /**
   * Executes instance action
   *
   * @param sfRequest A request object
   */
  public function executeInstance(sfWebRequest $request)
  {
    if ($request->isMethod('get')) {
      return $this->executeShow($request);
    } elseif ($request->isMethod('post')) {
      return $this->executeUpdate($request);
    }
  }

  /**
   * Executes show action
   *
   * @param sfRequest A request object
   */
  public function executeShow(sfWebRequest $request)
  {
    $table = $this->getTable();
    $record = $table->findOneById($request->getParameter('id'))
      ->getData();

    $table->typecast($record);
    return $this->format($record);
  }

/*****************************************************************************/

  /**
   * Executes collection action
   *
   * @param sfRequest A request object
   */
  public function executeCollection(sfWebRequest $request)
  {
    if ($request->isMethod('get')) {
      return $this->executeList($request);
    } elseif ($request->isMethod('post')) {
      return $this->executeCreate($request);
    }
  }

  /**
   * Executes list action
   *
   * @param sfRequest A request object
   */
  public function executeList(sfWebRequest $request)
  {
    $table = $this->getTable();
    $records = $table->findAll(Doctrine_Core::HYDRATE_ARRAY);

    foreach ($records as &$record)
      $table->typecast($record);

    return $this->format($table->wrap($records));
  }

// FIXME: disable creating outcomes with income category and the opposite

  /**
   * Executes create action
   *
   * @param sfRequest A request object
   */
  public function executeCreate(sfWebRequest $request)
  {
    $record = new $this->db_table();
    $missing = array_diff($this->required, array_keys($request->getPostParameters()));
    if (count($missing)) {
      throw new Exception('Required fields missing: ' . implode(', ', $missing));
    }
    foreach ($this->required as $field) {
      $method = Tools::underscoreToCamelCase('set_' . $field);
      $record->$method($request->getPostParameter($field));
    }
    $record->save();
    return sfView::NONE;
  }
}
