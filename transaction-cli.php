<?php 

include_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once('Controller/Payment.php');

updateStatus($argv);
function updateStatus($argv){
    if(!isset($argv[1])|| !isset($argv[2])){
        echo "Error Update Status parameter not valid !";
        return;
    }
    Payment::UpdateStatusPayment($argv);

}