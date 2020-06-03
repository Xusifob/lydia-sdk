<?php

namespace Lydia\Entity;

/**
 * Class Entity
 */
class Payment extends Entity
{


    public $amount;

    public $status;

    public $remote_transaction_pub_uuid;

    public $transaction_identifier;

    public $url;

    public $withdraw_url;

}
