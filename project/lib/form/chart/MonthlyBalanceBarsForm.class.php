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
    $this->setWidget('created_by', new sfWidgetFormDoctrineChoice(array(
      'model' => 'sfGuardUser',
      'add_empty' => true
    )));

    $this->setValidator('created_by', new sfValidatorDoctrineChoice(array(
      'required' => false,
      'model' => 'sfGuardUser',
      'column' => 'id'
    )));

    $this->setDefaults(array(
      'date_from' => Tools::getCurrentMonthDate(),
      'date_to' => Tools::getCurrentMonthDate(),
    ));

    $this->widgetSchema->setLabel('created_by', 'Utworzył(a)');
    $this->setDefault('created_by', null);
  }
}
