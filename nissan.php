<?php
  require_once("car.php");

  class Nissan extends Car {

    function __construct() {
      $this->name = "日産";
      $this->price = mt_rand(300, 500);
      $this->capacity = 4;
      $this->acceleration = 4.0;
      $this->defective_acceleration = $this->acceleration*0.6;
      $this->crew = mt_rand(1, $this->capacity);
      $this->max_speed = 300; // km/h
      $this->brake_distance = mt_rand(1000, 3000);
      $this->standard_speed = $this->max_speed * round(6 + mt_rand() / mt_getrandmax() * (8 - 6), 1) / 10;
    }

    //日産の車をランダム数生成して合計金額と平均金額を計算して表示する。
    //戻り値として生成した台数と合計金額を配列にいれたものを返す。
    function CalculateNissan() {

      $amount = mt_rand(1,5);
      $total = 0;

      echo "日産の車を" . $amount . "台生産しました。</br>";
      for ($i=1; $i<=$amount; $i++) {
        $$i = new Nissan;
      $price = $$i->ReturnPrice();
      echo $i . "台目: " . $price . "万円</br>";
      $total += $price;
      }

      $average = round($total / $amount, 1);
  
      echo "日産の合計金額は" . $total . "万円です。</br>平均金額は約" . $average . "万円です。</br>";
      $info = [$amount, $total];
      return $info;
    }

  }
?>