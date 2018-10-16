<?php

namespace App\Model;

class Customer{
    public $id;
    public $email;
    public $name;
    public $nickname;
    public $phone;
    public $last_updated;

    public function __construct($data = null)
    {
        if(is_array($data)){
            if(!empty($data['id'])){
                $this->id = $data['id'];
            }
            $this->email = $data['email'];
            $this->name = $data['name'];
            $this->nickname = $data['nickname'];
            $this->phone = $data['phone'];
        }
    }
}

?>