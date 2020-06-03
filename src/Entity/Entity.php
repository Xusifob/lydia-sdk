<?php

namespace Lydia\Entity;

/**
 * Class Entity
 */
abstract class Entity
{


    /**
     * @var string
     */
    public $id;


    /**
     * Entity constructor.
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->setData($data);
    }

    /**
     * @param array $data
     */
    public function setData($data = array())
    {
        $vars = get_object_vars($this);

        foreach ($data as $key => $elem) {
            if (array_key_exists($key, $vars)) {
                $this->$key = $elem;
            }
        }
    }

}