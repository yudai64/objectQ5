<?php
require_once("car.php");

  class Toyota extends Car {


    function __construct() {
      $this->name = "トヨタ";
      $this->price = mt_rand(600, 1200);
      $this->capacity = 4;
      $this->acceleration = round(4.5 * $this ->price / 600, 1);
      $this->crew = mt_rand(1, $this->capacity);
      $this->max_speed = 360; // km/h
      $this->brake_distance = mt_rand(3000, 7000);
      $this->standard_speed = $this->max_speed * round(6 + mt_rand() / mt_getrandmax() * (8 - 6), 1) / 10;
    }

  }
?>