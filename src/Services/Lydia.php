<?php

namespace Lydia\Services;

use Lydia\Entity\Credentials;
use \Exception;
use Lydia\Entity\User;

/**
 * Class Lydia
 */
class Lydia extends Requestor
{



    const ENV_DEV = 'dev';

    const ENV_PROD = 'prod';


    /**
     * @var Payments
     */
    public $payments;


    /**
     * @var Auth
     */
    public $auth;


    /**
     * @var Transactions
     */
    public $transaction;


    /**
     * @var Request
     */
    public $request;


    /**
     * @var Withdraw
     */
    public $withdraw;


    /**
     * @var Business
     */
    public $business;


    /**
     * Lydia constructor.
     * @param Credentials $credentials
     * @param string $env
     */
    public function __construct(Credentials $credentials,User $user = null,$env = self::ENV_DEV)
    {
        if($env === self::ENV_PROD) {
            $url = self::PRODUCTION_URL;
        } else {
            $url = self::SANDBOX_URL;
        }

        $url .= '/api/';

        parent::__construct($credentials,$user,$url);

        $this->payments = new Payments($credentials,$user,$url);
        $this->auth = new Auth($credentials,$user,$url);
        $this->transaction = new Transactions($credentials,$user,$url);
        $this->request = new Request($credentials,$user,$url);
        $this->withdraw = new Withdraw($credentials,$user,$url);
        $this->business = new Business($credentials,$user,$url);

    }


    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        foreach (get_object_vars($this) as $elem) {
            if($elem instanceof Requestor) {
                $elem->setUser($user);
            }
        }
    }


}