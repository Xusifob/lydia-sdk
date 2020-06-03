<?php

namespace Lydia\Services;


use Lydia\Entity\Credentials;
use \Exception;
use Lydia\Entity\User;
use Lydia\Exception\LydiaException;
use Symfony\Component\HttpClient\HttpClient;


/**
 * Class Requestor
 */
abstract class Requestor
{

    const SANDBOX_URL = 'https://homologation.lydia-app.com';

    const PRODUCTION_URL = 'https://lydia-app.com';

    /**
     * @var
     */
    protected $url;

    /**
     * @var Credentials
     */
    protected $credentials;


    /**
     * @var User|null
     */
    protected $user;


    /**
     * Requestor constructor.
     * @param Credentials $credentials
     * @param $url
     */
    public function __construct(Credentials $credentials,User $user = null,$url = self::SANDBOX_URL)
    {
        $this->credentials = $credentials;
        $this->user = $user;
        $this->url = $url;
    }


    /**
     * @param $url
     * @param $data
     *
     * @return array
     *
     * @throws Exception
     */
    protected function post($url,$data)
    {

        $args = array(
            'headers'     => array('Content-Type:application/x-www-form-urlencoded; charset=UTF-8'),
            'body'        => $data,
            'method'      => 'POST',
            'data_format' => 'body',
        );


        $client = HttpClient::create();

        $response = $client->request('POST',$this->url . $url . '.json',$args);

        ;

        $body = json_decode($response->getContent(),true);

        if(isset($body['status']) && $body['status'] === 'error') {
            throw new LydiaException($body['message'],$data);
        }

        if(isset($body['error']) && $body['error'] != 0) {
            throw new LydiaException($body['message'],$data);
        }

        return $body;

    }


    /**
     * @param $data
     */
    public function generateSignature($data)
    {

        ksort($data); // alphabetical sorting

        $sig = array();

        foreach ($data as $key => $val) {
            $sig[] .= $key.'='.$val;
        }

        $callSig = (implode("&", $sig)."&".$this->credentials->private_key);


        $callSig = md5($callSig);

        return $callSig;
    }


    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }


    /**
     * @param $url
     */
    public static function redirect($url)
    {
        header("Location: $url");
        echo "<script>window.location.href='$url';</script>";
        die();
    }


}