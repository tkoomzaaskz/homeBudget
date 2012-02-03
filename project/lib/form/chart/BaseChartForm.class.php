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
  public function setUp()
  {
    $this->setWidgets(array(
      'date_from' => new sfWidgetFormInputText(),
      'date_to'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'date_from' => new sfValidatorDateTime(),
      'date_to'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setLabels(array(
      'date_from' => 'Data od',
      'date_to'   => 'Data do',
    ));

    $this->setDefaults(array(
      'date_from' => Tools::getBeginningOfTheCurrentMonthDate(),
      'date_to' => Tools::getEndingOfTheCurrentMonthDate(),
    ));

    $this->widgetSchema->setNameFormat('chart[%s]');
  }
}
