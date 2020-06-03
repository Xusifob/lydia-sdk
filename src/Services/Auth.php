<?php

namespace Lydia\Services;

use Lydia\Entity\Credentials;
use Exception;
use Lydia\Entity\User;

/**
 * Class Auth
 *
 * See https://homologation.lydia-app.com/doc/api/#api-Auth
 *
 */
class Auth extends Requestor
{


    /**
     * Payments constructor.
     * @param Credentials $credentials
     * @param $url
     */
    public function __construct(Credentials $credentials,$user,$url)
    {
        $url .= 'auth/';
        parent::__construct($credentials,$user,$url);

    }


    /**
     * @param $phone
     * @param $password
     * @param array $data
     *
     * @return User
     *
     * @throws Exception
     */
    public function login($phone,$password,$data = array())
    {
        $data = array_merge(array(
            'notify' => "no",
            'phone' => $phone,
            'password'=> $password
        ),$data);

        $response = $this->post('login',$data);

        return new User($response['user']);

    }


    /**
     * @param array $data
     *
     * @return User
     *
     * @throws Exception
     */
    public function register($data = array())
    {
        $data['vendor_token'] = $this->credentials->public_key;

        $response = $this->post('register',$data);

        return new User($response['user']);

    }


    /**
     *
     * Creates a P2P Account
     *
     * @param array $data
     * @return User
     * @throws Exception
     */
    public function createAccount($data = array())
    {
        $data['provider_token'] = $this->credentials->provider_token;

        $response = $this->post('create_account',$data);

        return new User($response['user']);

    }

    public function vendorToken()
    {
        return $this->post('vendortoken',array(
            'vendor_id' => $this->credentials->public_key,
            'vendor_token' => $this->credentials->private_key,
        ));
    }


}