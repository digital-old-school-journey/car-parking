<?php

namespace App\Model;

class Configuration{
    public $configuration_id;
    public $car_daily;
    public $car_monthly;

    public function __construct($data = null)
    {
        if(is_array($data)){
            if(!empty($data['configuration_id'])){
                $this->configuration_id = $data['configuration_id'];
            }
            $this->car_daily = $data['car_daily'];
            $this->car_monthly = $data['car_monthly'];
        }
    }
}

?>