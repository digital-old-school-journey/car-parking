<?php

namespace App\Model;

class Booking{
    public $id;
    public $customer_id;
    public $service_date;
    public $service_time;
    public $place;
    public $flight_no;
    public $no_of_passenger;
    public $no_of_luggage;
    public $last_updated;

    public function __construct($data = null)
    {
        if(is_array($data)){
            if(!empty($data['id'])){
                $this->id = $data['id'];
            }
            $this->customer_id = $data['customer_id'];
            $this->name = $data['name'];
            $this->service_date = $data['service_date'];
            $this->service_time = $data['service_time'];
            $this->place = $data['place'];
            $this->flight_no = $data['flight_no'];
            $this->no_of_passenger = $data['no_of_passenger'];
            $this->no_of_luggage = $data['no_of_luggage'];
            $this->last_updated = $data['last_updated'];
        }
    }
}

?>