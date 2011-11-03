<?php

/**
 * OutcomeCategory filter form base class.
 *
 * @package    finances
 * @subpackage filter
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOutcomeCategoryFormFilter extends CategoryFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('outcome_category_filters[%s]');
  }

  public function getModelName()
  {
    return 'OutcomeCategory';
  }
}
