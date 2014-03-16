<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// index test

$browser = new sfTestFunctional(new sfBrowser());
$browser->get('/income_categories')->
  with('request')->begin()->
    isParameter('module', 'income_categories')->
    isParameter('action', 'collection')->
  end();

$response = $browser->getResponse();
$browser->test()->is($response->getHttpHeader('content-type'), 'application/json');
