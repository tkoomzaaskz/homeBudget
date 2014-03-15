<?php

class baseApiActions extends sfActions {

  public function preExecute() {
    $this->getResponse()->setHttpHeader('Content-type', 'application/json');
  }

  public function getTable() {
    return Doctrine::getTable($this->db_table);
  }

  protected function format($result) {
    return $this->renderText(json_encode($result));
  }

  /**
   * Executes show action
   *
   * @param sfRequest A request object
   */
  public function executeShow(sfWebRequest $request) {
    $table = $this->getTable();
    $record = $table->findOneById($request->getParameter('id'))
      ->getData();

    $table->typecast($record);
    return $this->format($record);
  }

  /**
   * Executes list action
   *
   * @param sfRequest A request object
   */
  public function executeList(sfWebRequest $request) {
    $table = $this->getTable();
    $records = $table->findAll(Doctrine_Core::HYDRATE_ARRAY);

    foreach ($records as &$record)
      $table->typecast($record);

    return $this->format($table->wrap($records));
  }
}
