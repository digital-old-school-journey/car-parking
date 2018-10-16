<?php
namespace App\Repository;

use \PDO;
use App\Helper;
use App\Helper\MyHelper;
use App\Model\Configuration;

class ConfigurationRepository
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
            SELECT "Configuration", Configuration.* 
             FROM Configuration 
             WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, Configuration::class);
        return $stmt->fetch();
    }
    public function findAll()
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM Configuration
        ');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Configuration::class);
    
        return $stmt->fetchAll();
    }
    public function save(Configuration $config)
    {
        if (isset($config->id)) {
            return $this->update($config);
        }
        $stmt = $this->connection->prepare('
            INSERT INTO Configuration 
                (no_of_car_in_zone_monthly, no_of_car_out_zone_monthly) 
            VALUES 
                (:no_of_car_in_zone_monthly, :no_of_car_out_zone_monthly)
        ');
        $stmt->bindParam(':no_of_car_in_zone_monthly', $config->no_of_car_in_zone_monthly);
        $stmt->bindParam(':no_of_car_out_zone_monthly', $config->no_of_car_out_zone_monthly);
        return $stmt->execute();
    }
    public function update(Configuration $config)
    {
        if (!isset($config->id)) {
            // We can't update a record unless it exists...
            throw new \LogicException(
                'Cannot update configuration that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            UPDATE Configuration
            SET     no_of_car_in_zone_monthly = :no_of_car_in_zone_monthly,
            no_of_car_in_zone_monthly = :no_of_car_in_zone_monthly
            WHERE id = :id
        ');
        $stmt->bindParam(':no_of_car_in_zone_monthly', $config->no_of_car_in_zone_monthly);
        $stmt->bindParam(':no_of_car_out_zone_monthly', $config->no_of_car_out_zone_monthly);
        $stmt->bindParam(':id', $config->id);
        return $stmt->execute();
    }
    public function delete($id)
    {
        if (!isset($id)) {
            // We can't update a record unless it exists...
            throw new \LogicException(
                'Cannot delete configuration that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            DELETE FROM Configuration
            WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>