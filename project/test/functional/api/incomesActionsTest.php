<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$required_fields = array('id', 'category_id', 'amount', 'description', 'created_at', 'created_by');

// index test

$browser = new sfTestFunctional(new sfBrowser());
$browser->get('/incomes')->
  with('request')->begin()->
    isParameter('module', 'incomes')->
    isParameter('action', 'index')->
  end();

$response = $browser->getResponse();
$browser->test()->is($response->getHttpHeader('content-type'), 'application/json');

$content = $response->getContent();
$decoded = json_decode($content, true);
$browser->test()->is(isset($decoded['objects']), true);
foreach($decoded['objects'] as $income)
    foreach($required_fields as $field)
        $browser->test()->is(isset($income[$field]) || is_null($income[$field]), true);

// show test

$browser = new sfTestFunctional(new sfBrowser());
$browser->get('/incomes/1')->
  with('request')->begin()->
    isParameter('module', 'incomes')->
    isParameter('action', 'show')->
    isParameter('id', '1')->
  end();

$response = $browser->getResponse();
$browser->test()->is($response->getHttpHeader('content-type'), 'application/json');

$content = $response->getContent();
$browser->test()->is($content, '{"id":"1","category_id":"35","amount":"1501.59","description":"pensja sierpie\u0144 2011","created_at":"2011-08-10 00:00:00","created_by":"1"}');

$decoded = json_decode($content, true);
foreach($required_fields as $field)
    $browser->test()->is(isset($decoded[$field]) || is_null($income[$field]), true);
