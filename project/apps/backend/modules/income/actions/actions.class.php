<?php

require_once dirname(__FILE__).'/../lib/incomeGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/incomeGeneratorHelper.class.php';

/**
 * income actions.
 *
 * @package    finances
 * @subpackage income
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class incomeActions extends autoIncomeActions
{
  public function executeIndex(sfWebRequest $request)
  {
    parent::executeIndex($request);
    $query = $this->buildQuery()->copy();
    $root_alias = $query->getRootAlias();
    $total_data = $query
      ->limit(0)
      ->select("SUM({$root_alias}.amount) AS sum")
      ->fetchArray();
    $this->total_count = $total_data[0]['sum'];
  }
}
