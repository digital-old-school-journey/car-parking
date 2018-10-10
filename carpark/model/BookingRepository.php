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
                (customer_id, service_date, service_time, place, flight_no, no_of_passenger, no_of_luggage) 
            VALUES 
                (:customer_id, :service_date, :service_time, :place, :flight_no, :no_of_passenger, :no_of_luggage)
        ');
        $stmt->bindParam(':customer_id', $booking->customer_id);
        $stmt->bindParam(':service_date', $booking->service_date);
        $stmt->bindParam(':service_time', $booking->service_time);
        $stmt->bindParam(':place', $booking->place);
        $stmt->bindParam(':flight_no', $booking->flight_no);
        $stmt->bindParam(':no_of_passenger', $booking->no_of_passenger);
        $stmt->bindParam(':no_of_luggage', $booking->no_of_luggage);
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
            SET     customer_id = :customer_id,
                    service_date = :service_date,
                    service_time = :service_time,
                    place = :place,
                    flight_no = :flight_no,
                    no_of_passenger = :no_of_passenger,
                    no_of_luggage = :no_of_luggage
            WHERE id = :id
        ');
        $stmt->bindParam(':customer_id', $booking->customer_id);
        $stmt->bindParam(':service_date', $booking->service_date);
        $stmt->bindParam(':service_time', $booking->service_time);
        $stmt->bindParam(':place', $booking->place);
        $stmt->bindParam(':flight_no', $booking->flight_no);
        $stmt->bindParam(':no_of_passenger', $booking->no_of_passenger);
        $stmt->bindParam(':no_of_luggage', $booking->no_of_luggage);
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