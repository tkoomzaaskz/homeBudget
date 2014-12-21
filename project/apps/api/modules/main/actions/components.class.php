<?php

class mainComponents extends sfComponents
{
  public function executeMenu($request)
  {
    // module is always 'main'
    $this->action = $request->getParameter('action');

    // action => label
    $this->links = array(
        'modelUsers' => 'users',
        'modelIncomes' => 'incomes',
        'modelOutcomes' => 'outcomes',
        'modelIncomeCategories' => 'income categories',
        'modelOutcomeCategories' => 'outcome categories',
        'chartCategoryPie' => 'category pie chart',
        'chartMonthlyBalanceBars' => 'monthly balance bars chart'
    );
  }
}
