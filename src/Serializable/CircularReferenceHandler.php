<?php


namespace App\Serializable;


class CircularReferenceHandler
{
    public function __invoke($object)
    {
        //dump($object);
        return $object->getId();
    }
}