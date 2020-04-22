<?php
  require_once("honda.php");
  require_once("nissan.php");
  require_once("ferrari.php");
  require_once("toyota.php");
  require_once("calculator.php");

  echo "-----------------------------------Q1-----------------------------------</br>";

  echo round(6 + mt_rand() / mt_getrandmax() * (8 - 6), 1) / 10;

  $honda1 = new Honda;
  $nissan1 = new Nissan;
  $ferrari1 = new Ferrari;

  $cars1 = array($honda1, $nissan1, $ferrari1);
  foreach ($cars1 as $value) {
    $name = $value->ReturnName();
    $price = $value->ReturnPrice();
    $capacity = $value->ReturnCapacity();
    $acceleration = $value->ReturnAcceleration();
    echo $name . "の価格は" . $price . "万円で定員は" . $capacity . "人で加速度は" . $acceleration . "m/s²です</br>";
  }




  echo "-----------------------------------Q2-----------------------------------</br>";

  $ferrari2 = new Ferrari;
  //フェラーリの通常時(リフトアップ前)の加速度、車高を表示
  $ferrari2->DisplayStatus();
  //フェラーリをリフトアップさせる
  $ferrari2->LiftUp();
  //フェラーリをリフトダウンさせる
  $ferrari2->LiftDown();




  echo "-----------------------------------Q3-----------------------------------</br>";

  $honda3 = new Honda;
  $nissan3 = new Nissan;
  $ferrari3 = new Ferrari;
  $h3_info = $honda3->CalculateHonda();
  $n3_info = $nissan3->CalculateNissan();
  $f3_info = $ferrari3->CalculateFerrari();
  $array_price = array($h3_info[1], $n3_info[1], $f3_info[1]);
  $amount = $h3_info[0] + $n3_info[0] + $f3_info[0];
  $calculator3 = new Calculator;
  $total_price = $calculator3->CalculateTotalPrice($array_price);
  $calculator3->CalculateAveragePrice($total_price, $amount);




  echo "-----------------------------------Q4-----------------------------------</br>";

  $honda4 = new Honda;
  $nissan4 = new Nissan;
  $ferrari4 = new Ferrari;
  $cars4 =array($honda4, $nissan4, $ferrari4);
  foreach ($cars4 as $car) {
    $car->CalculateAcceleration();
  }




  echo "-----------------------------------Q5-----------------------------------</br>";

  $honda5 = new Honda;
  $nissan5 = new Nissan;
  $ferrari5 = new Ferrari;
  $toyota5 = new Toyota;

  $cars = array($honda5, $nissan5, $ferrari5, $toyota5);

  foreach ($cars as $value) {
    //人数から加速度を計算する
    $value->CalculateAcceleration();
    //リフトアップするかどうか決める
    $value->ChooseLiftUP();
    //最高速度を表示する
    $value->DisplayMaxSpeed();
  } 

  $calculator5 = new Calculator;
  //レースの距離を決定する
  $distance = $calculator5->DesideDistance();

  foreach($cars as $value) {
    echo $value->Returnname() . "の速度一定期間→" . $value->ReturnDistance() . "m</br>";
  }
  echo "</br>";

  $times = array();
  foreach($cars as $value) {
    $times[] = $value->CalculateTime($distance);
  }
  echo "</br>";
  $calculator5->DemandRank($times);
  ?>