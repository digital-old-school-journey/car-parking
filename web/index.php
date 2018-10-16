<?php
    include_once("autoload.php");
    use App\Helper\MyHelper;
    use App\Repository\BookingRepository;
    use App\Model\Booking;

    $booking_repo = new App\Repository\BookingRepository();

    // $booking = new Booking();
    // $booking->customer_id = 1;
    // $booking->service_date = '2018-10-20';
    // $booking->service_time = '10:19';
    // $booking->place = 'CM-Parking';
    // $booking->flight_no = 'FD3475';
    // $booking->no_of_passenger = 5;
    // $booking->no_of_luggage = 5;
    // $booking->id = 1;
    
    // $result = $booking_repo->save($booking);

    // $result = $booking_repo->find(1);
    // echo '<pre>';
    // print_r($result);
?>