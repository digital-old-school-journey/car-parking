<?php

namespace App\Model;

class Booking{
    public $id;
    public $code;
    public $customer_id;
    public $date_from;
    public $time_from;
    public $date_to;
    public $time_to;
    public $place;
    public $flight_no;
    public $no_of_passenger;
    public $no_of_luggage;
    public $price;
    public $real_date_from;
    public $real_time_from;
    public $real_date_to;
    public $real_time_to;
    public $last_updated;

    public function __construct($data = null)
    {
        if(is_array($data)){
            if(!empty($data['id'])){
                $this->id = $data['id'];
            }
            $this->customer_id = $data['customer_id'];
            $this->code = $data['code'];
            $this->date_from = $data['date_from'];
            $this->time_from = $data['time_from'];
            $this->date_to = $data['date_to'];
            $this->time_to = $data['time_to'];
            $this->place = $data['place'];
            $this->flight_no = $data['flight_no'];
            $this->no_of_passenger = $data['no_of_passenger'];
            $this->no_of_luggage = $data['no_of_luggage'];
            $this->price = $data['price'];
            $this->real_date_from = $data['real_date_from'];
            $this->real_time_from = $data['real_time_from'];
            $this->real_date_to = $data['real_date_to'];
            $this->real_time_to = $data['real_time_to'];
            $this->last_updated = $data['last_updated'];
        }
    }
}

?>