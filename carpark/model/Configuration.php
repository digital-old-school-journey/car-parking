<?php

namespace App\Model;

class Configuration{
    public $configuration_id;
    public $no_of_car_in_zone_monthly;
    public $no_of_car_out_zone_monthly;

    public function __construct($data = null)
    {
        if(is_array($data)){
            if(!empty($data['configuration_id'])){
                $this->configuration_id = $data['configuration_id'];
            }
            $this->no_of_car_in_zone_monthly = $data['no_of_car_in_zone_monthly'];
            $this->no_of_car_out_zone_monthly = $data['no_of_car_out_zone_monthly'];
        }
    }
}

?>