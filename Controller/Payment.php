<?php 
include("Model/Model_payment.php");

class Payment {
    public static function CreatePayment($request){
        $data = new Model_Payment();
        return json_encode($data->CreatePayment($request->getBody()));
      
    }
    public static function GetStatusPayment($request){
        $data = new Model_Payment();
        return json_encode($data->GetPaymentStatus($request->getBody())); 
    }
    public static function UpdateStatusPayment($argv){
        $ModelPayment = new Model_Payment();
        
        $isTransaksi=$ModelPayment->GetPayment($argv[1]);
        if(count($isTransaksi) == 0){
            echo "Error Execute Transaction Not Found !! ";
            return;
        }   

        try {
            $isUpdateStatus=$ModelPayment->UpdateStatus($argv);
            if(($isUpdateStatus != NULL)){
                echo "Errror";
                return;
            }
            echo "Execute Succesfully";
        } catch (\Throwable $th) {
            echo "Error Execute ".$th;
        }

        


        
    }
}