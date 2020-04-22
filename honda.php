<?php
  require_once("car.php");

  class Honda extends Car {

    function __construct() {
      $this->name = "ホンダ";
      $this->price = mt_rand(500, 800);
      $this->capacity = 5;
      $this->acceleration = 6.0;
      $this->crew = mt_rand(1, $this->capacity);
      $this->max_speed = 300; // km/h
      $this->brake_distance = mt_rand(2000, 3000);
      $this->standard_speed = $this->max_speed * round(6 + mt_rand() / mt_getrandmax() * (8 - 6), 1) / 10;
    }

    //本田の車をランダム数生成して合計金額と平均金額を計算して表示する。
    //戻り値として生成した台数と合計金額を配列にいれたものを返す。
    function CalculateHonda() {

      $amount = mt_rand(1,5);
      $total = 0;

      echo "ホンダの車を" . $amount . "台生産しました。</br>";
      for ($i=1; $i<=$amount; $i++) {
        $$i = new Honda;
      $price = $$i->ReturnPrice();
      echo $i . "台目: " . $price . "万円</br>";
      $total += $price;
      }

      $average = round($total / $amount, 1);
      
      echo "ホンダの合計金額は" . $total . "万円です。</br>平均金額は約" . $average . "万円です。</br>";
      $info = [$amount, $total];
      return $info;
    }

  }
?>