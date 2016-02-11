<?php

namespace KG\ApiBundle\Services;


class WhiteList
{
    public function user()
    {
        return ['password', 'username', 'prenom', 'nom', 'email', 'uuid'];
    }
}