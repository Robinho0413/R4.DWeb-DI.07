<?php

namespace App\Entity;

class Lego
{
    private int $id;
    private string $name;
    private string $collection;
    private string $description;
    private float $price;
    private int $pieces;
    private string $imageBox;
    private string $imageLego;


    public function __construct(int $id, string $name, string $collection)
    {
        $this->id = $id;
        $this->name = $name;
        $this->collection = $collection;
    }


    /**
     * Get the value of id
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of collection
     */ 
    public function getCollection(): string
    {
        return $this->collection;
    }

    /**
     * Set the value of collection
     *
     * @return  self
     */ 
    public function setCollection(string $collection): self
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of pieces
     */ 
    public function getPieces(): int
    {
        return $this->pieces;
    }

    /**
     * Set the value of pieces
     *
     * @return  self
     */ 
    public function setPieces($pieces): self
    {
        $this->pieces = $pieces;

        return $this;
    }

    /**
     * Get the value of boximages
     */ 
    public function getImageBox(): string
    {
        return $this->imageBox;
    }

    /**
     * Set the value of boximages
     *
     * @return  self
     */ 
    public function setImageBox($imageBox): self
    {
        $this->imageBox = $imageBox;

        return $this;
    }

    /**
     * Get the value of bgimages
     */ 
    public function getImageLego(): string
    {
        return $this->imageLego;
    }

    /**
     * Set the value of bgimages
     *
     * @return  self
     */ 
    public function setImageLego($imageLego): self
    {
        $this->imageLego = $imageLego;

        return $this;
    }
}



?>