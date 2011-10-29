<?php

/**
 * Income form.
 *
 * @package    finances
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class IncomeForm extends BaseIncomeForm
{
  public function configure()
  {
    $this->widgetSchema['created_at'] = new sfWidgetFormI18nDate(array('culture' => 'pl'));

    if ($this->isNew())
    {
      $this->setDefault ('created_by', sfContext::getInstance()->getUser()->getId());
      $this->setDefault ('created_at', date('Y-m-d 00:00:00'));
    }
  }
}
