<?php

/**
 * Event
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    finances
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Event extends BaseEvent
{
  /**
   * Returns true if the event was made today.
   *
   * @return Boolean
   */
  public function isToday()
  {
    return true;
  }

  /**
   * Returns true if the event is expensive (cash amount the same or higher than
   * a constant given in application configuration).
   *
   * @return Boolean
   */
  public function isExpensive()
  {
    return ($this->getCashTotal() >= sfConfig::get('app_event_expensive'));
  }
}
