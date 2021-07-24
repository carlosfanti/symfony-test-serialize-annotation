<?php

namespace App\DTO;

use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\Groups;

class UserDTO
{
    private $email;
    private $password;

    /**
     * 
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @Group("group1")
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @Ignore()
     */
    public function getPassword()
    {
        return $this->password;
    }
}
