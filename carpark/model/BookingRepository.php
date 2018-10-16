<?php
namespace App\Repository;

use \PDO;
use App\Helper;
use App\Helper\MyHelper;
use App\Model\Booking;

class BookingRepository
{
    private $connection;

    public function __construct(PDO $connection = null)
    {
        try{
            $this->connection = $connection;
            if ($this->connection === null) {
                $this->connection = MyHelper::createConnection();
            }
        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        } 
    }
    public function find($id)
    {
        $stmt = $this->connection->prepare('
            SELECT "Booking", Booking.* 
             FROM Booking 
             WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, Booking::class);
        return $stmt->fetch();
    }
    public function findAll()
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM Booking
        ');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Booking::class);
        
        return $stmt->fetchAll();
    }
    public function save(Booking $booking)
    {
        if (isset($booking->id)) {
            return $this->update($booking);
        }
        $stmt = $this->connection->prepare('
            INSERT INTO Booking 
                (code, customer_id, date_from, time_from, date_to, time_to, place, flight_no, no_of_passenger, no_of_luggage, price, real_date_from, real_time_from, real_date_to, real_time_to) 
            VALUES 
                (:code, :customer_id, :date_from, :time_from, :date_to, :time_to, :place, :flight_no, :no_of_passenger, :no_of_luggage, :price, :real_date_from, :real_time_from, :real_date_to, :real_time_to)
        ');
        $stmt->bindParam(':code', $booking->code);
        $stmt->bindParam(':customer_id', $booking->customer_id);
        $stmt->bindParam(':date_from', $booking->date_from);
        $stmt->bindParam(':time_from', $booking->time_from);
        $stmt->bindParam(':date_to', $booking->date_to);
        $stmt->bindParam(':time_to', $booking->time_to);
        $stmt->bindParam(':place', $booking->place);
        $stmt->bindParam(':flight_no', $booking->flight_no);
        $stmt->bindParam(':no_of_passenger', $booking->no_of_passenger);
        $stmt->bindParam(':no_of_luggage', $booking->no_of_luggage);
        $stmt->bindParam(':price', $booking->price);
        $stmt->bindParam(':real_date_from', $booking->real_date_from);
        $stmt->bindParam(':real_time_from', $booking->real_time_from);
        $stmt->bindParam(':real_date_to', $booking->real_date_to);
        $stmt->bindParam(':real_time_to', $booking->real_time_to);
        return $stmt->execute();
    }
    public function update(Booking $booking)
    {
        if (!isset($booking->id)) {
            // We can't update a record unless it exists...
            throw new \LogicException(
                'Cannot update booking that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            UPDATE Booking
            SET     code = :code,
                    customer_id = :customer_id,
                    date_from = :date_from,
                    time_from = :time_from,
                    date_to = :date_to,
                    time_to = :time_to,
                    place = :place,
                    flight_no = :flight_no,
                    no_of_passenger = :no_of_passenger,
                    no_of_luggage = :no_of_luggage
                    price = :price,
                    real_date_from = :real_date_from,
                    real_time_from = :real_time_from,
                    real_date_to = :real_date_to,
                    real_time_to = :real_time_to
            WHERE id = :id
        ');
        $stmt->bindParam(':code', $booking->code);
        $stmt->bindParam(':customer_id', $booking->customer_id);
        $stmt->bindParam(':date_from', $booking->date_from);
        $stmt->bindParam(':time_from', $booking->time_from);
        $stmt->bindParam(':date_to', $booking->date_to);
        $stmt->bindParam(':time_to', $booking->time_to);
        $stmt->bindParam(':place', $booking->place);
        $stmt->bindParam(':flight_no', $booking->flight_no);
        $stmt->bindParam(':no_of_passenger', $booking->no_of_passenger);
        $stmt->bindParam(':no_of_luggage', $booking->no_of_luggage);
        $stmt->bindParam(':price', $booking->price);
        $stmt->bindParam(':real_date_from', $booking->real_date_from);
        $stmt->bindParam(':real_time_from', $booking->real_time_from);
        $stmt->bindParam(':real_date_to', $booking->real_date_to);
        $stmt->bindParam(':real_time_to', $booking->real_time_to);
        $stmt->bindParam(':id', $booking->id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        if (!isset($id)) {
            // We can't update a record unless it exists...
            throw new \LogicException(
                'Cannot delete booking that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            DELETE FROM Booking
            WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>