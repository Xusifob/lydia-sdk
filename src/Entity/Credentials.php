<?php

namespace Lydia\Entity;

/**
 * Class Credentials
 * @package Lydia\Entity
 */
class Credentials extends Entity
{

    /**
     * @var string
     */
    public $private_key;

    /**
     * @var string
     */
    public $public_key;

    /**
     * @var string
     */
    public $currency = 'EUR';


    /**
     * @var string
     */
    public $provider_token;


    /**
     * @var string
     */
    public $provider_private_token;

}