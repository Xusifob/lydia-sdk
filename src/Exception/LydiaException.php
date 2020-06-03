<?php

namespace Lydia\Exception;

use \Exception;

class LydiaException extends Exception
{

    protected $data;

    public function __construct($message = "",$data = array(), $code = 0,$previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

}