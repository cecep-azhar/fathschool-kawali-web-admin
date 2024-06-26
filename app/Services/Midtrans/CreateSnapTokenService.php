<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
    protected $order;

    public function __construct($order)
    {
        parent::__construct();

        $this->order = $order;
    }

    public function getSnapToken()
    {
        $auth_user = authUser();
        $params = [
            'transaction_details' => [
                'order_id' => $this->order['order_no'],
                'gross_amount' => $this->order['total_price'],
            ],
            'item_details' => [
                [
                    'id' => 1,
                    'price' => $this->order['total_price'],
                    'quantity' => 1,
                    'name' => 'Fee payment #'.$this->order['order_no'],
                ],
            ],
            'customer_details' => [
                'first_name' => $auth_user->name ?? 'name',
                'email' => $auth_user->email ?? 'email',
                'phone' => '123456789',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
