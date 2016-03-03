<?php

namespace KG\ApiBundle\Services;


class WhiteList
{
    public function user()
    {
        return ['password', 'username', 'prenom', 'nom', 'email', 'uuid', 'age' , 'adresse', 'metier', 'entreprise', 'ville', 'cp', 'tel'];
    }

    public function userQuery(){
        return array_merge($this->user(), ['totalRencontres']);
    }
}