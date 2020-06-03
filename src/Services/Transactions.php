<?php

namespace Lydia\Services;

use Lydia\Entity\Credentials;
use Exception;
use Lydia\Entity\Refund;
use Lydia\Entity\Transaction;
use Lydia\Entity\User;

/**
 * Class Transactions
 *
 * See https://homologation.lydia-app.com/doc/api/#api-Transaction
 *
 */
class Transactions extends Requestor
{


    /**
     * Payments constructor.
     * @param Credentials $credentials
     * @param $url
     */
    public function __construct(Credentials $credentials,$user,$url)
    {
        $url .= 'transaction/';
        parent::__construct($credentials,$user,$url);

    }



    /**
     * @param \DateTime $start
     * @param \DateTime $end
     * @return Transaction[]
     * @throws Exception
     */
    public function listAll(\DateTime $start = null, \DateTime $end = null)
    {

        if(null === $start) {
            $start = new \DateTime();
            $start->modify('- 7 days');
        }
        if(null === $end) {
            $end = new \DateTime();
        }

        $transactions = $this->post('list',array(
            'startDate' => $start->format(\DateTime::ISO8601),
            'endDate' => $end->format(\DateTime::ISO8601),
            'vendor_token' => $this->credentials->public_key,
            'user_token' => $this->user->public_token,
        ));

        $t = array();

        foreach ($transactions['transactions'] as $transaction) {
            $t[] = new Transaction($transaction);
        }

        return $t;

    }


    /**
     * @param Transaction $transaction
     * @throws Exception
     */
    public function finish(Transaction $transaction)
    {
        throw new Exception("Not implemented yet");
    }

    /**
     *
     * Cancel a transaction (refund the payer).
     *
     * https://homologation.lydia-app.com/doc/api/#api-Transaction-Cancel
     *
     * @param Transaction $transaction
     * @throws Exception
     */
    public function cancel(Transaction $transaction)
    {
        throw new Exception("Not implemented yet");
    }

    /**
     * @param Transaction $transaction
     * @param array $data
     * @throws Exception
     */
    public function refund(\EL_Transaction $transaction,$data = array())
    {
        $d = array(
            'order_ref' => $transaction->order_ref,
            'amount' => $transaction->amount,
        );

        if(isset($data['amount'])) {
            $d['amount'] = $transaction->amount;
        }

        $data['signature'] = self::generateSignature($d);

        $d['vendor_token'] = $this->credentials->public_key;
        $d['user_token'] = $this->user->public_token;

        $data = array_merge($d,$data);

        $t = $this->post('refund',$data);

    }


    /**
     * @return Refund[]
     * @throws Exception
     */
    public function refunds()
    {
        $refunds = $this->post('refunds',array(
            'vendor_token' => $this->credentials->public_key,
            'user_token' => $this->user->public_token,
        ));

        $r = array();

        foreach ($refunds['refunds'] as $refund) {
            $r[] = new Refund($refund);
        }

        return $r;
    }


}