<?php

namespace KG\ApiBundle\Services;

class VerifyData
{

    public function check(array $data, array $allowed)
    {
        return $this->sameLenght(
            $this->sanitize($data, $allowed),
            $allowed
        );

    }

    public function checkNoLenght(array $data, array $allowed)
    {
        return $this->sanitize($data, $allowed);
    }

    private function sanitize(array $data, array $allowed)
    {
        return array_intersect_key($data, array_flip($allowed));
    }

    private function sameLenght(array $data, array $allowed)
    {
        if(count($data) === count($allowed)){
            return $data;
        } else {
            throw new \Exception('Arrays are not the same lenght. Missing arguments');
        }
    }

}