<?php

namespace Lydia\Services;


use Lydia\Entity\Credentials;
use \Exception;
use Lydia\Entity\Payment;
use Lydia\Entity\Transaction;

/**
 * Class Payments
 */
class Payments extends Requestor
{


    /**
     * paid and collected
     */
    const STATUS_OK = 1;

    const STATUS_PROCESSING = 2;

    /**
     * paid but not collected
     */
    const STATUS_WAITING = 3;

    const STATUS_EXPIRED = 4;

    const STATUS_DECLINED = 5;

    const STATUS_CANCELED = 6;

    const STATUS_WAITING_FOR_PAYMENT = 7;

    const STATUS_PAYMENT_ERROR = 8;

    const STATUS_WAITING_FOR_FINISH = 9;

    /**
     * Payments constructor.
     * @param Credentials $credentials
     * @param $url
     */
    public function __construct(Credentials $credentials,$user,$url)
    {
        $url .= 'payment/';
        parent::__construct($credentials,$user,$url);

    }


    /**
     *
     * Init a payment weather or not payer or collecter have a Lydia account
     *
     * https://homologation.lydia-app.com/doc/api/#api-Payment-Init
     *
     * @param array $data
     * @return Payment
     * @throws Exception
     */
    public function init($data = array())
    {

        $d = array(
            'provider_token' => $this->credentials->provider_token,
            'skip_receipt_page' => 1,
            'recipient' => $this->user->mobilenumber,
            'currency' => $this->credentials->currency,
        );

        $data = array_merge($d,$data);

        $data = $this->post('init',$data);

        return new Payment($data['data']);

    }


    /**
     *
     * https://homologation.lydia-app.com/doc/api/#api-Payment-State
     *
     * Return the state of a payment
     *
     * @param $id
     * @return array
     * @throws Exception
     */
    public function state($id)
    {
        return $this->post('state',array(
            'provider_token' => $this->credentials->provider_token,
            'order_ref' => $id,
        ));
    }


    /**
     *
     * Finish a direct payment by allowing a withdraw.
     *
     * https://homologation.lydia-app.com/doc/api/#api-Payment-Finish
     *
     * @throws Exception
     */
    public function finish()
    {
        throw new Exception("Not implemented yet");
    }


    /**
     *
     * Process a face-to-face transaction
     *
     * @throws Exception
     */
    public function payment()
    {
        throw new Exception("Not implemented yet");
    }


    /**
     *
     * Allow payment from a business to an individual.
     *
     * @throws Exception
     */
    public function send()
    {
        throw new Exception("Not implemented yet");
    }

}