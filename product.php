<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author ofembe
 */
class Product {
    //put your code here
    private $id;
    private $description;
    private $price;
    private $image;
    
    public function __construct($id) {
        $this->id = $id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    public function setPrice($price)
    {
        $this->price = $price;
    }
    
    public function setImage($image)
    {
        $this->image = $image; 
    }
    
     public function getDescription()
    {
         return $this->description;
    }
    
    public function getPrice()
    {
        return $this->price;
    }
    
    public function getImage()
    {
        return $this->image;
    }
    
    public function getId()
    {
        return $this->id;
    }
}
