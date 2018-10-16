<?php

namespace App\Model;

class BookingCalendar{
    public $id;
    public $booking_id;
    public $service_date;
    public $service_time;
    public $last_updated;

    public function __construct($data = null)
    {
        if(is_array($data)){
            if(!empty($data['id'])){
                $this->id = $data['id'];
            }
            $this->customer_id = $data['booking_id'];
            $this->service_date = $data['service_date'];
            $this->service_time = $data['service_time'];
            $this->last_updated = $data['last_updated'];
        }
    }
}

?>