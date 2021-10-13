<?php

include_once 'Request.php';
include_once 'Router.php';
include_once 'Controller/Payment.php';
// use Controller\Payment;

$router = new Router(new Request);

$router->get('/', function() {
  return <<<HTML
  <h1>Hello world</h1>
HTML;
});


$router->get('/profile', function($request) {
  return <<<HTML
  <h1>Profile</h1>
HTML;
});

$router->post('/data', 'CreatePayment');


