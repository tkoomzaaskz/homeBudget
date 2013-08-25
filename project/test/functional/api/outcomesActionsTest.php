<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$required_fields = array('id', 'category_id', 'amount', 'description', 'created_at', 'created_by');

// index test

$browser = new sfTestFunctional(new sfBrowser());
$browser->get('/outcomes')->
  with('request')->begin()->
    isParameter('module', 'outcomes')->
    isParameter('action', 'list')->
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
    isParameter('action', 'show')->
    isParameter('id', '1')->
  end();

$response = $browser->getResponse();
$browser->test()->is($response->getHttpHeader('content-type'), 'application/json');

$content = $response->getContent();
$browser->test()->is($content, '{"id":1,"category_id":1,"created_at":"2011-09-01 00:00:00","created_by":2,"amount":121.46,"description":"szama"}');

$decoded = json_decode($content, true);
foreach($required_fields as $field)
    $browser->test()->is(isset($decoded[$field]) || is_null($income[$field]), true, $field);
