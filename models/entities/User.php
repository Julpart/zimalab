<?php

namespace app\models\entities;

use app\models\Model;

class User extends Model
{
    protected $id;
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $companyName;
    protected $position;
    protected $phoneNumber1;
    protected $phoneNumber2;
    protected $phoneNumber3;
    public $props = [
        'firstName' => false,
        'lastName' => false,
        'email' => false,
        'companyName' => false,
        'position' => false,
        'phoneNumber1' => false,
        'phoneNumber2' => false,
        'phoneNumber3' => false,
    ];

    public function __construct($firstName = null, $lastName = null, $email = null,
                                $companyName = null,$position = null,$phoneNumber1 = null,
                                $phoneNumber2 = null,$phoneNumber3 = null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->companyName = $companyName;
        $this->position = $position;
        $this->phoneNumber1 = $phoneNumber1;
        $this->phoneNumber2 = $phoneNumber2;
        $this->phoneNumber3 = $phoneNumber3;
    }
}
