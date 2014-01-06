<?php

/**
 * Category Pie Chart form.
 *
 * @package    finances
 * @subpackage form
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CategoryPieChartForm extends BaseChartForm
{
  public function configure()
  {
    $this->addDateFrom(true);
    $this->addDateTo(true);
    $this->addCreatedBy();
    $this->addSumSubcategories();

    $this->setDefaults(array(
      'date_from' => Tools::getBeginningOfTheCurrentMonthDate(),
      'date_to' => Tools::getEndingOfTheCurrentMonthDate(),
    ));
  }
}
