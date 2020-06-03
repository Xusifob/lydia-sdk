<?php

namespace Lydia\Services;

use Lydia\Entity\Credentials;
use Exception;
use Lydia\Entity\Payment;
use Lydia\Entity\User;
use Lydia\Entity\Request as LydiaRequest;

/**
 * Class Request
 *
 * See https://homologation.lydia-app.com/doc/api/#api-Request
 *
 */
class Request extends Requestor
{


    const STATUS_ACCEPTED = "1";

    const STATUS_WAITING = "0";

    const STATUS_REFUSED = "5";

    const STATUS_CANCELED = "6";

    const STATUS_REFUNDED = "7";

    const STATUS_WITHDRAWN = "8";

    const STATUS_UNKNOWN = "-1";


    /**
     * Payments constructor.
     * @param Credentials $credentials
     * @param User|null $user
     * @param $url
     */
    public function __construct(Credentials $credentials,$user,$url)
    {
        $url .= 'request/';
        parent::__construct($credentials,$user,$url);

    }


    /**
     * @param array $data
     * @return LydiaRequest
     * @throws Exception
     */
    public function doRequest($data = array())
    {
        $d = array(
            'provider_token' => $this->credentials->provider_token,
            'vendor_token' => $this->credentials->public_key,
            'skip_receipt_page' => 1,
            'type' => 'email',
            'threeDSecure' => 'no',
            'recipient' => $this->user->email,
            'currency' => $this->credentials->currency,
        );

        $data = array_merge($d,$data);

        $data = $this->post('do',$data);

        return new LydiaRequest($data);
    }

    /**
     *
     * https://homologation.lydia-app.com/doc/api/#api-Request-State
     *
     * Return the state of a payment
     *
     * @param $order_ref
     * @return LydiaRequest
     * @throws Exception
     */
    public function state($order_ref)
    {
        $data = $this->post('state',array(
            'vendor_token' => $this->credentials->public_key,
            'order_ref' => $order_ref,
        ));

        return new LydiaRequest($data);

    }


    /**
     *
     * https://homologation.lydia-app.com/doc/api/#api-Request-Cancel
     *
     * Cancel a remote request.
     *
     * @param $request_id
     * @throws Exception
     */
    public function cancel($request_id)
    {
        throw new Exception("Not implemented yet");
    }

}