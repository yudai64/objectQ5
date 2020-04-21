<?php
  require_once("car.php");

  class Ferrari extends Car {

    private $height = "";
    private $liftup = "off";

    function __construct() {
      $this->name = "フェラーリ";
      $this->price = mt_rand(2000, 3000);
      $this->capacity = 2;
      $this->acceleration = 10.0; // m/s²
      $this->crew = mt_rand(1, $this->capacity);
      $this->height = 94;
      $this->max_speed = 400; // km/h
      $this->brake_distance = mt_rand(3000, 5000);
      $this->standard_speed = $this->max_speed * 3 / 5;
    }

    //現在の加速度と車高を表示する
    function DisplayStatus() {
      echo "フェラーリの通常時(リフトダウン時)の加速度は" . $this->acceleration . "m/s²で車高は" . $this->height . "mmです</br>";
    }

    //リフトアップさせて、加速度と車高を計算して表示する
    function LiftUp() {
      if ($this->liftup == "off") {
        $this->acceleration *= 0.8;
        $this->height += 40;
        $this->liftup = "on";
        echo "リフトアップしました。</br>
        フェラーリのリフトアップ後の加速度は" . $this->acceleration . "m/s²で車高は" . $this->height . "mmです</br>";
      } else {
        echo "リフトアップはこれ以上できません。。。</br>";
      }
    }

    //リフトダウンさせて、加速度と車高を計算して表示する
    function LiftDown() {
      if ($this->liftup == "on") {
        $this->acceleration = 10;
        $this->height -= 40;
        $this->liftup = "off";
        echo "リフトダウンしました！</br>
        フェラーリのリフトダウン後の加速度は" . $this->acceleration . "m/s²で車高は" . $this->height . "mmです</br>";
      } else {
        echo "リフトダウンはこれ以上できません。。。</br>";
      }
    }


    //フェラーリの車をランダム数生成して合計金額と平均金額を計算して表示する。
    //戻り値として生成した台数と合計金額を配列にいれたものを返す。
    function CalculateFerrari() {

      $amount = mt_rand(1,5);
      $total = 0;

      echo "フェラーリの車を" . $amount . "台生産しました。</br>";
      for ($i=1; $i<=$amount; $i++) {
        $$i = new Ferrari;
      $price = $$i->ReturnPrice();
      echo $i . "台目: " . $price . "万円</br>";
      $total += $price;
      }

      $average = round($total / $amount, 1);
  

      if (strlen($total)<=4) {
        //億未満の場合そのまま表示
        echo "フェラーリの合計金額は" . $total . "万円です。</br>平均金額は" . $average . "万円です。</br>";
      }else {
        //億以上の時は○億○万円の表記で表示
        $bil = substr($total, 0, 1);
        $thou = substr($total, 1, 1);
        if ($thou != 0) {
          $mil = substr($total, 1, 4);
          echo "フェラーリの合計金額は" . $bil . "億" . $mil . "万円です。</br>平均金額は" . $average . "万円です。</br>";
        } else {
          $hun = substr($total, 2, 1);
          if ($hun != 0) {
            $mil = substr($total, 2, 3);
            echo "フェラーリの合計金額は" . $bil . "億" . $mil . "万円です。</br>平均金額は" . $average . "万円です。</br>";
          } else {
            $ten = substr($total, 3, 1);
            if ($ten != 0) {
              $mil = substr($total, 3, 2);
              echo "フェラーリの合計金額は" . $bil . "億" . $mil . "万円です。</br>平均金額は" . $average . "万円です。</br>";
            } else {
              $mil = substr($total, 4,1);
              echo "フェラーリの合計金額は" . $bil . "億" . $mil . "万円です。</br>平均金額は" . $average . "万円です。</br>";
            }
          }
        }
      }
      $info = [$amount, $total];
      return $info;
    }

  }
?>