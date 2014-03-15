<?php

class mainComponents extends sfComponents
{
  public function executeMenu($request)
  {
    $this->action = $request->getParameter('action');
  }
}
