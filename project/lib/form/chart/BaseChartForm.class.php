<?php

/**
 * Base Chart form.
 *
 * @package    finances
 * @subpackage form
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BaseChartForm extends BaseForm
{
  protected $culture = 'pl';

  private function getBaseYears()
  {
    $start = 2010;
    $end = date("Y");
    $years = range(2010, 2014);
    return array_combine($years, $years);
  }

  protected function addDateFrom($with_days)
  {
    $format = $with_days ? '%day%-%month%-%year%' : '%month%-%year%';
    $default = $with_days ? Tools::getBeginningOfTheCurrentMonthDate() : Tools::getCurrentMonthDate();
    $this->setWidget('date_from', new sfWidgetFormI18nDate(array(
      'culture' => $this->culture,
      'label'   => 'Data od',
      'can_be_empty' => false,
      'format'  => $format,
      'default' => $default,
      'years'   => $this->getBaseYears()
    )));
    $this->setValidator('date_from', new sfValidatorDate());
  }

  protected function addDateTo($with_days)
  {
    $format = $with_days ? '%day%-%month%-%year%' : '%month%-%year%';
    $default = $with_days ? Tools::getEndingOfTheCurrentMonthDate() : Tools::getCurrentMonthDate();
    $this->setWidget('date_to', new sfWidgetFormI18nDate(array(
      'culture' => $this->culture,
      'label'   => 'Data do',
      'can_be_empty' => false,
      'format'  => $format,
      'default' => $default,
      'years'   => $this->getBaseYears()
    )));
    $this->setValidator('date_to', new sfValidatorDate());
  }

  protected function addCreatedBy()
  {
    $this->setWidget('created_by', new sfWidgetFormDoctrineChoice(array(
      'label'     => 'Utworzył(a)',
      'default'   => null,
      'model'     => 'sfGuardUser',
      'add_empty' => true
    )));

    $this->setValidator('created_by', new sfValidatorDoctrineChoice(array(
      'required' => false,
      'model' => 'sfGuardUser',
      'column' => 'id'
    )));
  }

  protected function addSumSubcategories()
  {
    $this->setWidget('sum_subcategories', new sfWidgetFormInputCheckbox());
    $this->widgetSchema->setLabel('sum_subcategories', 'Sumuj podkategorie');
    $this->setDefault('sum_subcategories', false);

    $this->setValidator('sum_subcategories', new sfValidatorBoolean(array(
      'required' => false
    )));
  }

  protected function addSumPeriods()
  {
    $this->setWidget('sum_periods', new sfWidgetFormInputCheckbox());
    $this->widgetSchema->setLabel('sum_periods', 'Sumuj okresy');
    $this->setDefault('sum_periods', false);

    $this->setValidator('sum_periods', new sfValidatorBoolean(array(
      'required' => false
    )));
  }

  public function setUp()
  {
    $this->widgetSchema->setNameFormat('chart[%s]');
  }
}
