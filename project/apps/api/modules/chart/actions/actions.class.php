<?php

/**
 * chart actions.
 *
 * @package    finances
 * @class      chartActions
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php
 */
class chartActions extends baseApiActions
{
  /**
   * Retrieves parameters from request.
   *
   * @param sfRequest $request A request object
   * @param Array $required Required request parameters
   * @param Array $optional Optional request parameters
   */
  private function getParameters(sfWebRequest $request, $required, $optional) {
    $result = array();

    foreach ($required as $param)
      $result[$param] = $request->getParameter($param);

    foreach ($optional as $param)
      if ($request->hasParameter($param))
        $result[$param] = $request->getParameter($param);

    return $result;
  }

  /**
   * Executes category pie action
   *
   * @param sfRequest A request object
   */
  public function executeCategoryPie(sfWebRequest $request)
  {
    $params = $this->getParameters($request,
      array('date_from', 'date_to'),
      array('created_by', 'sum_subcategories')
    );
    return $this->format(ChartDataManager::getCategoryPieData($params));
  }

  /**
   * Executes monthly balance bars action
   *
   * @param sfRequest A request object
   */
  public function executeMonthlyBalanceBars(sfWebRequest $request)
  {
    $params = $this->getParameters($request,
      array('date_from', 'date_to'),
      array('created_by', 'sum_periods')
    );
    return $this->format(ChartDataManager::getMonthlyBalanceBarsData($params));
  }
}
