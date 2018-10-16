<?php
namespace App\Repository;

use \PDO;
use App\Helper;
use App\Helper\MyHelper;
use App\Model\BookingCalendar;

class BookingCalendarRepository
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
            SELECT "BookingCalendar", BookingCalendar.* 
             FROM BookingCalendar 
             WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, BookingCalendar::class);
        return $stmt->fetch();
    }
    public function findAll()
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM BookingCalendar
        ');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, BookingCalendar::class);
        
        return $stmt->fetchAll();
    }
    public function save(BookingCaldendar $bookingCalender)
    {
        if (isset($bookingCalender->id)) {
            return $this->update($bookingCalender);
        }
        $stmt = $this->connection->prepare('
            INSERT INTO BookingCalendar 
                (booking_id, service_date, service_time) 
            VALUES 
                (booking_id, service_date, service_time)
        ');
        $stmt->bindParam(':booking_id', $bookingCalender->booking_id);
        $stmt->bindParam(':service_date', $bookingCalender->service_date);
        $stmt->bindParam(':service_time', $bookingCalender->service_time);
        return $stmt->execute();
    }
    public function update(BookingCalendar $bookingCalender)
    {
        if (!isset($bookingCalender->id)) {
            // We can't update a record unless it exists...
            throw new \LogicException(
                'Cannot update booking that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            UPDATE BookingCalendar
            SET     booking_id = :booking_id,
                    service_date = :service_date,
                    service_time = :service_time,
            WHERE id = :id
        ');
        $stmt->bindParam(':booking_id', $bookingCalender->booking_id);
        $stmt->bindParam(':service_date', $bookingCalender->service_date);
        $stmt->bindParam(':service_time', $bookingCalender->service_time);
        $stmt->bindParam(':id', $bookingCalender->id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        if (!isset($id)) {
            // We can't update a record unless it exists...
            throw new \LogicException(
                'Cannot delete booking calendar that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            DELETE FROM BookingCalendar
            WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>