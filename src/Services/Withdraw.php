<?php

namespace Lydia\Services;

use Lydia\Entity\Credentials;
use Exception;
use Lydia\Entity\Transaction;
use Lydia\Entity\User;
use Lydia\Entity\Withdraw as LydiaWithdraw;

/**
 * Class Withdraw
 *
 * See https://homologation.lydia-app.com/doc/api/#api-Withdraw
 *
 */
class Withdraw extends Requestor
{


    /**
     * Payments constructor.
     * @param Credentials $credentials
     * @param $url
     */
    public function __construct(Credentials $credentials,$user,$url)
    {
        $url .= 'withdraw/';
        parent::__construct($credentials,$user,$url);

    }



    /**
     * @param array $data
     *
     * @param Transaction[] $transactions
     *
     * @return LydiaWithdraw
     *
     * @throws Exception
     */
    public function request(array $transactions = array())
    {

        $t = array();

        foreach ($transactions as $transaction) {
            $t[] = $transaction->transaction_identifier;
        }

        $data['recipient'] = $this->user->email;

        $data['transaction_identifier_list'] = json_encode($t);

        $data['signature'] = $this->generateSignature($data);
        $data['provider_token'] = $this->credentials->provider_token;

        $response = $this->post('request',$data);

        return new LydiaWithdraw($response['data']);

    }


}