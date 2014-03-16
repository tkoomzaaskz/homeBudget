<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$required_fields = array('id', 'category_id', 'amount', 'description', 'created_at', 'created_by');

// index test

$browser = new sfTestFunctional(new sfBrowser());
$browser->get('/incomes')->
  with('request')->begin()->
    isParameter('module', 'incomes')->
    isParameter('action', 'collection')->
  end();

$response = $browser->getResponse();
$browser->test()->is($response->getHttpHeader('content-type'), 'application/json');

$content = $response->getContent();
$decoded = json_decode($content, true);
$browser->test()->is(isset($decoded['objects']), true);
foreach($decoded['objects'] as $income)
    foreach($required_fields as $field)
        $browser->test()->is(isset($income[$field]) || is_null($income[$field]), true, $field);

// show test

$browser = new sfTestFunctional(new sfBrowser());
$browser->get('/incomes/1')->
  with('request')->begin()->
    isParameter('module', 'incomes')->
    isParameter('action', 'instance')->
    isParameter('id', '1')->
  end();

$response = $browser->getResponse();
$browser->test()->is($response->getHttpHeader('content-type'), 'application/json');

$content = $response->getContent();
$browser->test()->is(json_decode($content, true), array(
    'id' => 1,
    'category_id' => 51,
    'amount' => 1384.45,
    'description' => '1384.45 earned for recordings stuff by John Lennon',
    'created_at' => '2004-05-11 09:40:53',
    'created_by' => 2
));

$decoded = json_decode($content, true);
foreach($required_fields as $field)
    $browser->test()->is(isset($decoded[$field]) || is_null($income[$field]), true, $field);
