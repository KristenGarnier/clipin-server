<?php

namespace KG\ApiBundle\Services;


class GetOr404
{
    public function check($res){
        if(!$res){
            throw new \Exception('User does not exist', 404);
        }

        return $res;
    }

    public function checkArray($res){
        if(empty($res)){
            throw new \Exception('Query does not match to any user', 404);
        }

        return $res;
    }
}