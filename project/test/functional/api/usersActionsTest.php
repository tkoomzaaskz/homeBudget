<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());
$browser->get('/users')->
  with('request')->begin()->
    isParameter('module', 'users')->
    isParameter('action', 'index')->
  end();
$response = $browser->getResponse();
$browser->test()->is($response->getHttpHeader('content-type'), 'application/json');

$browser = new sfTestFunctional(new sfBrowser());
$browser->get('/users/1')->
  with('request')->begin()->
    isParameter('module', 'users')->
    isParameter('action', 'show')->
    isParameter('id', '1')->
  end();
$response = $browser->getResponse();
$browser->test()->is($response->getHttpHeader('content-type'), 'application/json');
