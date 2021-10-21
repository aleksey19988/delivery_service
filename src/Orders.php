<?php

namespace Aleksey\DeliveryService;

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
        $statement = $this->connection->prepare('SELECT * FROM subscriptions_history ORDER BY order_creation_date DESC');
        $statement->execute();
        return $statement->fetchAll();
    }
}