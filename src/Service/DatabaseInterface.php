<?php


namespace App\Service;

use PDO;

use App\Entity\Lego;

class DatabaseInterface
{
    public function getAllLegos(): array
    {
    
        $pdo = new \PDO("mysql:host=tp-symfony-mysql;dbname=lego_store", "root", "root");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $data = $pdo->query("SELECT * FROM lego")->fetchAll(PDO::FETCH_ASSOC);
    
        
        $result = $this->generateLego($data);
        return $result;
    }

    public function generateLego($data): array
    {
        $legos = [];

        foreach ($data as $lego) {
            $legoModel = new Lego($lego['id'], $lego['name'], $lego['collection']);
            $legoModel->setDescription($lego['description']);
            $legoModel->setPrice($lego['price']);
            $legoModel->setPieces($lego['pieces']);
            
            $legoModel->setImageBox($lego['imagebox']);
            $legoModel->setImageLego($lego['imagebg']);
    
            array_push($legos, $legoModel);
        }

        return $legos;
    }
    

    public function getLegosByCollection($collection): array
    {
        $pdo = new \PDO("mysql:host=tp-symfony-mysql;dbname=lego_store", "root", "root");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo = $pdo->prepare("SELECT * FROM lego WHERE collection = :collection");
        $pdo->bindParam(':collection', $collection);
        $pdo->execute();
        
        $data = $pdo->fetchAll(PDO::FETCH_ASSOC);

        $result = $this->generateLego($data);
        return $result;
    }

    public function getCollections(): array
    {
        $pdo = new \PDO("mysql:host=tp-symfony-mysql;dbname=lego_store", "root", "root");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $pdo->query("SELECT collections FROM lego")->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}