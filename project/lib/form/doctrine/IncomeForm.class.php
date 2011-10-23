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
    unset($this['created_at'], $this['updated_at'], $this['updated_by']);

    $this->widgetSchema['date_from'] = new sfWidgetFormI18nDate(array('culture' => 'pl'));
    $this->widgetSchema['date_to'] = new sfWidgetFormI18nDate(array('culture' => 'pl'));

    if ($this->isNew())
    {
      $this->setDefault ('created_by', sfContext::getInstance()->getUser()->getId());
      $this->setDefault ('date_from', date('Y-m-01 00:00:00'));
      $current_month = date('m');
      $last_day_of_month = Tools::getDaysOfMonth($current_month);
      $this->setDefault ('date_to', date("Y-m-{$last_day_of_month} 00:00:00"));
    }
  }
}
