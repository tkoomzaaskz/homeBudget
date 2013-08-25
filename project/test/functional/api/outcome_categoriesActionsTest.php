<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// index test

$browser = new sfTestFunctional(new sfBrowser());
$browser->get('/outcome_categories')->
  with('request')->begin()->
    isParameter('module', 'outcome_categories')->
    isParameter('action', 'list')->
  end();

$response = $browser->getResponse();
$browser->test()->is($response->getHttpHeader('content-type'), 'application/json');
