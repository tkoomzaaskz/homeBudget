<?php

/**
 * OutcomeCategory form base class.
 *
 * @method OutcomeCategory getObject() Returns the current form's model object
 *
 * @package    finances
 * @subpackage form
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOutcomeCategoryForm extends CategoryForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('outcome_category[%s]');
  }

  public function getModelName()
  {
    return 'OutcomeCategory';
  }

}
