<?php

/**
 * IncomeCategory form base class.
 *
 * @method IncomeCategory getObject() Returns the current form's model object
 *
 * @package    finances
 * @subpackage form
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseIncomeCategoryForm extends CategoryForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('income_category[%s]');
  }

  public function getModelName()
  {
    return 'IncomeCategory';
  }

}
