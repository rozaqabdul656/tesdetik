<?php


use Phinx\Seed\AbstractSeed;

class Transaksipembayaran extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $data = array(
            array(
                'invoice_id' => 'ASD324832',
                'references_id' => '16341095821250',
                'item_name' => 'BASO',
                'amount' => '1000',
                'payment_type' => 'VA',
                "merchant_id"=>"D23",
                "status"=>"PENDING",
                "created_at"=> "2021-10-13 14:19:42"
            ),
            array(
                "invoice_id"=> "ASD324831",
                "references_id"=> "16341095821250",
                "item_name"=> "BASO SAPI",
                "amount"=> "1000",
                "payment_type"=> "VA",
                "customer_name"=> "rozaq",
                "merchant_id"=> "D23",
                "status"=> "PENDING",
                "created_at"=> "2021-10-13 16:20:27"
            )
            
        );
        $user = $this->table('transaksi_pembayaran');
        $user->insert($data)->save();
    }
}
