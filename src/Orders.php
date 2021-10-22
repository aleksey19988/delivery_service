<?php

namespace Aleksey\DeliveryService\Orders;

use PDO;

class Orders
{
    private PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function get()
    {
        $statement = $this->connection->prepare('SELECT * FROM subscriptions_history ORDER BY order_creation_date ASC');
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getOneOrder($order_id)
    {
        $statement = $this->connection->prepare("SELECT * FROM subscriptions_history WHERE id = '$order_id'");
        $statement->execute();
        return $statement->fetchAll();
    }
}