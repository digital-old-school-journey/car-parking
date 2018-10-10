<?php
namespace App\Repository;

use \PDO;
use App\Helper;
use App\Helper\MyHelper;
use App\Model\Customer;

class CustomerRepository
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
            SELECT "Customer", Customer.* 
             FROM Customer 
             WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        // Set the fetchmode to populate an instance of 'User'
        // This enables us to use the following:
        //     $user = $repository->find(1234);
        //     echo $user->firstname;
        $stmt->setFetchMode(PDO::FETCH_CLASS, Customer::class);
        return $stmt->fetch();
    }
    public function findAll()
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM Customer
        ');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Customer::class);
        
        // fetchAll() will do the same as above, but we'll have an array. ie:
        //    $users = $repository->findAll();
        //    echo $users[0]->firstname;
        return $stmt->fetchAll();
    }
    public function save(Customer $customer)
    {
        if (isset($customer->id)) {
            return $this->update($customer);
        }
        $stmt = $this->connection->prepare('
            INSERT INTO Customer 
                (email, name, nickname, phone) 
            VALUES 
                (:email, :name, :nickname, :phone)
        ');
        $stmt->bindParam(':email', $customer->email);
        $stmt->bindParam(':name', $customer->name);
        $stmt->bindParam(':nickname', $customer->nickname);
        $stmt->bindParam(':phone', $customer->phone);
        return $stmt->execute();
    }
    public function update(Customer $customer)
    {
        if (!isset($customer->id)) {
            // We can't update a record unless it exists...
            throw new \LogicException(
                'Cannot update customer that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            UPDATE Configuration
            SET     email = :email,
                    name = :name,
                    nickname = :nickname,
                    phone = :phone
            WHERE id = :id
        ');
        $stmt->bindParam(':email', $customer->email);
        $stmt->bindParam(':name', $customer->name);
        $stmt->bindParam(':nickname', $customer->nickname);
        $stmt->bindParam(':phone', $customer->phone);
        $stmt->bindParam(':id', $customer->id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        if (!isset($id)) {
            // We can't update a record unless it exists...
            throw new \LogicException(
                'Cannot delete customer that does not yet exist in the database.'
            );
        }
        $stmt = $this->connection->prepare('
            DELETE FROM Customer
            WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>