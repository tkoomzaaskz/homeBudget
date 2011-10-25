<?php

require_once dirname(__FILE__).'/../lib/eventGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/eventGeneratorHelper.class.php';

/**
 * event actions.
 *
 * @package    finances
 * @subpackage event
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventActions extends autoEventActions
{
  public function executeIndex(sfWebRequest $request)
  {
    parent::executeIndex($request);
    $query = $this->buildQuery()->copy();
    $root_alias = $query->getRootAlias();
    $total_data = $query
      ->limit(0)
      ->select("SUM({$root_alias}.cash_total) AS sum")
      ->fetchArray();
    $this->total_count = $total_data[0]['sum'];
  }
}
