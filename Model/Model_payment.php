<?php 

include("config/database.php");
class Model_Payment {
    private $tablename='transaksi_pembayaran';
    private $statustransaksi=[];
    private $db;

    public function __construct(){
        $this->db = new Database;
        $this->status_transaksi["PENDING"]=true;
        $this->status_transaksi["PAID"]=true;
        $this->status_transaksi["FAILED"]=true;
    }
     public  function CreatePayment($data){
        try {
            $references_id=time().rand(10*45, 100*98);
            $this->db->query('INSERT INTO ' . $this->tablename .' (invoice_id,references_id,item_name,amount,payment_type,customer_name,merchant_id,status) VALUES(:invoice_id, :references_id, :item_name,:amount,:payment_type,:customer_name,:merchant_id,:status)');

            $this->db->bind('invoice_id',$data["invoice_id"]);
            $this->db->bind('item_name',$data["item_name"]);
            $this->db->bind('payment_type',$data["payment_type"]);
            $this->db->bind('customer_name',$data["customer_name"]);
            $this->db->bind('amount',$data["amount"]);
            $this->db->bind('merchant_id',$data["merchant_id"]);
            $this->db->bind('status','PENDING');
            $this->db->bind('references_id',$references_id);

            $this->db->execute();
            
            $dataRespond["references_id"]=$references_id;
            $dataRespond["number_va"]="";

            if($data["payment_type"]== "VA"){
                $dataRespond["number_va"]=strval(time().rand(10*45, 100*98));    
            }

            $dataRespond["status"]="PENDING";
            
            return array("status_code"=>200,"msg"=>"Succes Insert Data",'data'=>$dataRespond); 
        
        } catch (\Throwable $th) {
            return array("status_code"=>500,"msg"=>"Internal Server Error","error_msg"=>$th);
        }
        
    }
    public  function GetPaymentStatus($data){
        try {

            $this->db->query('SELECT references_id,invoice_id,status FROM ' . $this->tablename .' WHERE references_id="'.$data["references_id"].'" AND merchant_id="'.$data["merchant_id"].'" order by created_at DESC LIMIT 1');
            $result=$this->db->resultSet();
            

            return array("status_code"=>200,"msg"=>"Succes Get Data",'data'=>$result); 
        } catch (\Throwable $th) {
            return array("status_code"=>500,"msg"=>"Internal Server Error","error_msg"=>$th);
        }
    }
    public  function GetPayment($references_id){
        try {

            

            $result = $this->db->query('SELECT * FROM ' . $this->tablename .' WHERE references_id="'.$references_id.'"');
            
            return $this->db->resultSet();

    
        } catch (\Throwable $th) {
            echo "Erorr Execute". $th;
            return [];
        }
    }
    public  function UpdateStatus($data){
        try {

            if(!isset($this->status_transaksi[$data[2]])){
                echo "Status Not Found To Set !!! \n";
                echo "STATUS YANG TERSEDIA : PENDING, PAID, FAILED ";
                
                return false;
            }

            $this->db->query('UPDATE ' . $this->tablename . ' SET status=:status WHERE references_id=:refrences_id');
            $this->db->bind('status',$data[2]);
            $this->db->bind('refrences_id',$data[1]);

            return $this->db->execute();
            
        } catch (\Throwable $th) {
            echo "Erorr Execute". $th;
            return [];
        }
    }
}