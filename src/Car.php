<?php
  class Car
  {
      private $make_model;
      private $price;
      private $miles;
      private $image;
      function worthBuying($max_price, $max_mileage)
      {
          if (($this->price < ($max_price + 100)) &&
              ($this->miles < $max_mileage)) {
              return $this;
          }
      }
      function __construct($make_model, $price, $miles, $image)
      {
          $this->make_model = $make_model;
          $this->price = $price;
          $this->miles = $miles;
          $this->image = $image;
      }
      function setMakeModel($new_make)
      {
          $this->make_model = $new_make;
      }
      function getMakeModel()
      {
          return $this->make_model;
      }
      function setPrice($new_price)
      {
          $float_price = (float) $new_price;
          if ($float_price != 0) {
              $formatted_price = number_format($float_price, 2);
              $this->price = $formatted_price;
          }
      }
      function getPrice()
      {
          return $this->price;
      }
      function setMileage($new_mileage)
      {
          $this->miles = $new_mileage;
      }
      function getMileage()
      {
          return $this->miles;
      }
      function setImage()
      {
          $this->image = $new_image;
      }
      function getImage()
      {
          return $this->image;
      }

      function saveCar(){
          array_push($_SESSION['list_of_cars'], $this);
      }

      static function getAll(){
          return $_SESSION['list_of_cars'];
      }

      static function deleteAll(){
          $_SESSION['list_of_cars']= array();
      }
  }
