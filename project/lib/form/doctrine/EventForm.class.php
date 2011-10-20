<?php

/**
 * Event form.
 *
 * @package    test
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EventForm extends BaseEventForm
{
  public function configure()
  {
    if ($this->isNew())
    {
      $this->setDefault ('created_at', date('Y-m-d H:i:s'));
      $this->setDefault ('created_by', sfContext::getInstance()->getUser()->getId());
    }

    $this->widgetSchema['created_at'] = new sfWidgetFormI18nDate(array('culture' => 'pl'));
  }
}
