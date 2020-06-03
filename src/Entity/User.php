<?php

namespace Lydia\Entity;

/**
 * Class Entity
 */
class User extends Entity
{

    public $firstname;

    public  $lastname;

    public  $email;

    public $mobilenumber;

    public $creationtime;

    public $cguproDate;

    public $auth_token;

    public $public_token;

    public $private_token;

    public $lang;

    public $currency;

    public $phone_prefix;

    public $hash_id;

    public $email_hash;

    public $mobilenumber_hash;

    public $account_hash;


}