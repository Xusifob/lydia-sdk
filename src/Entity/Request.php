<?php

namespace Lydia\Entity;

/**
 * Class Credentials
 * @package Lydia\Entity
 */
class Request extends Entity
{
    public $request_id;

    /**
     * @var
     */
    public $request_uuid;

    /**
     * @var
     */
    public $message;

    /**
     * @var
     */
    public $mobile_url;

    /**
     * @var
     */
    public $state = \Lydia\Services\Request::STATUS_WAITING;


}