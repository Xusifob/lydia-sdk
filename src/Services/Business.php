<?php

namespace Lydia\Services;


use Lydia\Entity\Balance;
use Lydia\Entity\Credentials;
use \Exception;
use Lydia\Entity\Payment;
use Lydia\Entity\Transaction;

/**
 *
 * See https://homologation.lydia-app.com/doc/api/#api-Business
 *
 * Class Business
 */
class Business extends Requestor
{


    /**
     * Payments constructor.
     * @param Credentials $credentials
     * @param $url
     */
    public function __construct(Credentials $credentials,$user,$url)
    {
        $url .= 'business/';
        parent::__construct($credentials,$user,$url);

    }


    /**
     *
     * @see https://homologation.lydia-app.com/doc/api/#api-Business-Addcashier
     *
     * Add a cashier (without creating an account) to a business.
     *
     * @throws Exception
     */
    public function addCashier()
    {
        throw new Exception("Not implemented yet");
    }



    /**
     *
     * @see https://homologation.lydia-app.com/doc/api/#api-Business-Create
     *
     * Create a new business.
     *
     * @throws Exception
     */
    public function create()
    {
        throw new Exception("Not implemented yet");
    }

    /**
     *
     * @see https://homologation.lydia-app.com/doc/api/#api-Business-Getpermission
     *
     * Return an array containing the permission attributed for a given number in a given business
     *
     *
     * @throws Exception
     */
    public function getPermission()
    {
        throw new Exception("Not implemented yet");

    }

    /**
     *
     * @see https://homologation.lydia-app.com/doc/api/#api-Business-Removecashier
     *
     * Remove all right to a cashier for a business
     *
     *
     * @throws Exception
     */
    public function removeCashier()
    {
        throw new Exception("Not implemented yet");

    }

    /**
     *
     * @see https://homologation.lydia-app.com/doc/api/#api-Business-b2cbalance
     *
     * Retrieve the amount available for B2C payment for a given business.
     *
     *
     * @return Balance
     * @throws Exception
     */
    public function b2cBalance()
    {

        $data = array(
            'vendor_token' => $this->credentials->public_key,
        );

        $data['signature'] = self::generateSignature($data);


        $d = $this->post('b2cbalance',$data);


        return new Balance($d['balance']);

    }


}