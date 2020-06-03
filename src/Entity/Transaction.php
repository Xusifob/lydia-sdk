<?php

namespace Lydia\Entity;

/**
 * Class Entity
 */
class Transaction extends Entity
{

   public $amount;

   public $currency;

   public $date;

   public $receiver_description;

   public $transmitter_feedback;

   public $order_id;

    /**
     *
     * @required
     *
     * @var string
     */
   public $transaction_identifier;

   public $commission_lydia;

   public $merchant_ident;

   public $merchant_ident_second;

    /**
     * @var array
     */
   public $ease_of_payment;


   public $state;




}