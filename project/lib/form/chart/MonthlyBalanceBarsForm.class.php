<?php

/**
 * Monthly Balance Bars Chart form.
 *
 * @package    finances
 * @subpackage form
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MonthlyBalanceBarsChartForm extends BaseChartForm
{
  public function configure()
  {
    $this->addDateFrom(false);
    $this->addDateTo(false);
    $this->addCreatedBy();
    $this->addSumPeriods();

    $this->setDefaults(array(
      'date_from' => Tools::getCurrentMonthDate(),
      'date_to' => Tools::getCurrentMonthDate(),
    ));
  }
}
