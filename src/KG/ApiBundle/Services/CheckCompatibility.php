<?php

namespace KG\ApiBundle\Services;


class CheckCompatibility
{
    public function isValid($comp)
    {
        if ($comp < 0 || $comp > 100) {
            throw new \Exception('The compatibility is not valuable', 409);
        }

        return $comp;
    }
}