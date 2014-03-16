<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$required_fields = array('id', 'category_id', 'amount', 'description', 'created_at', 'created_by');

// index test

$browser = new sfTestFunctional(new sfBrowser());
$browser->get('/outcomes')->
  with('request')->begin()->
    isParameter('module', 'outcomes')->
    isParameter('action', 'collection')->
  end();

$response = $browser->getResponse();
$browser->test()->is($response->getHttpHeader('content-type'), 'application/json');

$content = $response->getContent();
$decoded = json_decode($content, true);
$browser->test()->is(isset($decoded['objects']), true);
foreach($decoded['objects'] as $outcome)
    foreach($required_fields as $field)
        $browser->test()->is(isset($outcome[$field]) || is_null($outcome[$field]), true, $field);

// show test

$browser = new sfTestFunctional(new sfBrowser());
$browser->get('/outcomes/1')->
  with('request')->begin()->
    isParameter('module', 'outcomes')->
    isParameter('action', 'instance')->
    isParameter('id', '1')->
  end();

$response = $browser->getResponse();
$browser->test()->is($response->getHttpHeader('content-type'), 'application/json');

$content = $response->getContent();
$browser->test()->is(json_decode($content, true), array(
    'id' => 1,
    'category_id' => 35,
    'created_at' => '2000-10-07 17:38:21',
    'created_by' => 2,
    'amount' => 284.78,
    'description' => '284.78 spent for books stuff by John Lennon'
));

$decoded = json_decode($content, true);
foreach($required_fields as $field)
    $browser->test()->is(isset($decoded[$field]) || is_null($income[$field]), true, $field);
