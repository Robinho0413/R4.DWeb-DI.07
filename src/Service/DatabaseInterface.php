<?php


namespace App\Service;

use PDO;

class DatabaseInterface
{
    public function getAllLegos(): array
    {
        $pdo = new \PDO("mysql:host=tp-symfony-mysql;dbname=lego_store", "root", "root");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $pdo->query("SELECT * FROM lego")->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}