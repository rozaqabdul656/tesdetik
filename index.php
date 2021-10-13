<?php

include_once 'Request.php';
include_once 'Router.php';
require_once('Controller/Payment.php');

$router = new Router(new Request);

$router->post('/create_payment', 'Payment::CreatePayment');
$router->post('/get_payment_status', 'Payment::GetStatusPayment');


