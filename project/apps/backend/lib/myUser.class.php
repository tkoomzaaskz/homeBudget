<?php

class myUser extends sfGuardSecurityUser
{
  /**
   * Returns user id.
   *
   * @return Integer
   */
  public function getId()
  {
    return $this->getGuardUser()->getId();
  }
}
