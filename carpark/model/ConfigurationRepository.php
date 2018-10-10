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
    public function find($configuration_id)
    {
        $stmt = $this->connection->prepare('
            SELECT "Configuration", Configuration.* 
             FROM Configuration 
             WHERE ConfigurationId = :configuration_id
        ');
        $stmt->bindParam(':configuration_id', $configuration_id);
        $stmt->execute();
        
        // Set the fetchmode to populate an instance of 'User'
        // This enables us to use the following:
        //     $user = $repository->find(1234);
        //     echo $user->firstname;
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetch();
    }
    public function findAll()
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM Configuration
        ');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Configuration');
        
        // fetchAll() will do the same as above, but we'll have an array. ie:
        //    $users = $repository->findAll();
        //    echo $users[0]->firstname;
        return $stmt->fetchAll();
    }
    public function save(Configuration $config)
    {
        if (isset($config->configuration_id)) {
            return $this->update($config);
        }
        $stmt = $this->connection->prepare('
            INSERT INTO Configuration 
                (NoOfCarInZoneMonthly, NoOfCarOutZoneMonthly) 
            VALUES 
                (:no_of_car_in_zone_monthly, :no_of_car_out_zone_monthly)
        ');
        $stmt->bindParam(':no_of_car_in_zone_monthly', $config->no_of_car_in_zone_monthly);
        $stmt->bindParam(':no_of_car_out_zone_monthly', $config->no_of_car_out_zone_monthly);
        return $stmt->execute();
    }
    public function update(Configuration $config)
    {
        if (!isset($config->configuration_id)) {
            // We can't update a record unless it exists...
            throw new \LogicException(
                'Cannot update configuration that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            UPDATE Configuration
            SET     NoOfCarInZoneMonthly = :no_of_car_in_zone_monthly,
                    NoOfCarOutZoneMonthly = :no_of_car_out_zone_monthly
            WHERE Configurationid = :configuration_id
        ');
        $stmt->bindParam(':no_of_car_in_zone_monthly', $config->no_of_car_in_zone_monthly);
        $stmt->bindParam(':no_of_car_out_zone_monthly', $config->no_of_car_out_zone_monthly);
        $stmt->bindParam(':configuration_id', $config->configuration_id);
        return $stmt->execute();
    }
}

?>