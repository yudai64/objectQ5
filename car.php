<?php
  class Car {
    protected $name = "";
    protected $price = "";
    protected $capacity = "";
    protected $acceleration = "";
    protected $defective_acceleration = "";
    protected $crew = "";
    protected $max_speed = "";
    protected $brake_distance = ""; //ブレーキも踏んでる距離
    protected $standard_speed = ""; //ブレーキを踏み始めるまでの基準の速度

    //アクセルを踏んでる間は最高速度に到達しない範囲で加速する。
    function StepOnAccelerator () {
      if ($this->defective_acceleration == "") {
        //欠陥がないとき
        return $this->acceleration;
      } else {
        //欠陥があるとき
        return $this->defective_acceleration;
      }
    }

    //乗車人数から加速度を計算して表示する。
    function CalculateAcceleration() {

      //定員数と元の加速度を表示する
      if ($this->defective_acceleration == "") {
        //欠落がないとき
        //トヨタの車の場合、値段から加速度が決まることを表示
        if ($this->name == "トヨタ") {
          echo $this->name . "の定員数は" . $this->capacity . "人です。</br>" .$this->name . "は価格に比例して加速度が決まります。(1人乗車時)</br>
          今回の" . $this->name . "の価格は" . $this->price . "万円です。そのため加速度は" . $this->acceleration . "m/s²です。</br>";
        } else {
          //それ以外の車の場合
          echo $this->name . "の定員数は" . $this->capacity . "人です。</br>1人で乗車した時の加速度は" . $this->acceleration . "m/s²です。</br>";
        }
        
      } else {
        //欠落があるとき
        if ($this->name == "トヨタ") {
          echo $this->name . "は価格に比例して加速度が決まります。(1人乗車時)</br>
          今回の" . $this->name . "の価格は" . $this->price . "万円です。そのときの加速度は" . $this->acceleration . "m/s²です。</br>
          しかし今回トヨタの車は生産時に欠落が発見されたので加速度が本来の60%しかでません。加速度は" . $this->defective_acceleration . "m/s²です。";
        } else {
          echo $this->name . "の定員数は" . $this->capacity . "人です。</br>
        1人で乗車した時の加速度は" . $this->defective_acceleration . "m/s²です。(" . $this->name ."の車は生産時に欠陥が発見されました。そのため本来の60%しか加速度がでません。)</br>";
        }
      }


      //乗車人数とそれに応じた加速度を計算して表示する
      if ($this->defective_acceleration == "") {
        //欠落がないとき
        $this->acceleration *= (100-5 * ($this->crew-1)) / 100;
        echo "今回の" . $this->name . "の乗車数は" . $this->crew . "人なので、加速度は" . $this->acceleration . "m/s²です。</br>";
      } else {
        //欠落があるとき
        $this->defective_acceleration *= (100-5 * ($this->crew-1)) / 100;
        echo "今回の" . $this->name . "の乗車数は" . $this->crew . "人なので、加速度は" . $this->defective_acceleration . "m/s²です。</br>";
      }
    }


    //リフトアップするかどうかを判断して、する場合はリフトアップ関数を呼ぶ
    function ChooseLiftUP() {
      //フェラーリのみ仕様可能
      if ($this->name == "フェラーリ") {
        $random = mt_rand(0, 1);
        if ($random == "0") {
        $this->LiftUp();
        } else {
          echo "今回、フェラーリはリフトアップを行いませんでした。</br>";
        }
      }
    }

    function ReturnName() {
      return $this->name;
    }

    function ReturnPrice() {
      return $this->price;
    }

    function ReturnCapacity() {
      return $this->capacity;
    }

    function ReturnAcceleration() {
      return $this->acceleration;
    }

    function ReturnMaxSpeed() {
      return $this->max_speed;
    }

    function ReturnDistance() {
      return $this->brake_distance;
    }

    function DisplayMaxSpeed() {
      echo $this->name . "の最高速度は時速" . $this->max_speed . "kmです。</br></br>";
    }

    function CalculateTime($race_distance) {

      //速度をm/sに変更
      $max_speed = ($this->max_speed) * 10 * 10 * 10 /(60 * 60);
      $standard_speed = round(($this->standard_speed) * 10 * 10 * 10 / (60 * 60));

      //基準速度に達するまでの時間を計算
      $time1 = round($standard_speed / $this->StepOnAccelerator ());
      //基準速度に達するまでに進んだ距離を計算
      $distance1 = round($this->StepOnAccelerator () * $time1 * $time1 / 2);

      if ($race_distance <= $distance1) {
        //基準速度に達するまでにゴールしたとき
        $result_time = round(sqrt(2 * $race_distance / $this->StepOnAccelerator ()));
        echo $this->name . "は加速中に" . $result_time . "秒で" . $race_distance ."m進んでゴールしました。</br>";
      } else {
        $distance2 = $this->brake_distance;
        if ($race_distance <= $distance1 + $distance2) {
          //速度一定中にゴールした場合
          $time2 = round(($race_distance - $distance1) / $standard_speed);
          $result_time = $time1 + $time2;
          $distance = $race_distance - $distance1;
          echo $this->name . "は加速中に" . $time1 . "秒で" . $distance1 . "m進み、ブレーキによる等速中に" . $time2 . "秒で" . $distance . "m進んでゴールしました。</br>";
        } else {
          //一定速度期間にかかった時間
          $time2 = round($distance2 / $standard_speed);
          //再加速してから最高速度に到達するまでの時間
          $time3 = round(($max_speed - $standard_speed) / $this->StepOnAccelerator());
          //再加速してから最高速度に到達するまでの距離
          $distance3 = round($standard_speed * $time3 + $this->StepOnAccelerator() * $time3 * $time3);
          if ($race_distance <= $distance1 + $distance2 + $distance3) {
            //再加速中にゴールした場合
            $time4 = round((-$standard_speed + sqrt($standard_speed * $standard_speed + 2 * $this->StepOnAccelerator() * ($race_distance - $distance1 - $distance2))) / $this->StepOnAccelerator());
            $result_time = $time1 + $time2 + $time4;
            $distance = $race_distance - $distance1 - $distance2;
            echo $this->name . "は加速中に" . $time1 . "秒で" . $distance1 . "m進み、ブレーキによる等速中に" . $time2 . "秒で" . $distance2 . 
            "m進み、再加速中に" . $time4 . "秒で" . $distance . "m進んでゴールしました。</br>";
          } else {
            //最高速度になってからゴールした場合
            $time5 = round(($race_distance - $distance1 - $distance2 - $distance3) / $max_speed);
            $result_time = $time1 + $time2 + $time3 + $time5;
            $distance = $race_distance - $distance1 - $distance2 - $distance3;
            echo $this->name . "は加速中に" . $time1 . "秒で" . $distance1 . "m進み、ブレーキによる等速中に" . $time2 . "秒で" . $distance2 . 
            "m進み、再加速中に" . $time3 . "秒で" . $distance3 . "mだけ進み、最高速度中に" . $time5 . "秒で" . $distance . "m進んでゴールしました。</br>";
          }
        }
      }
      return $result_time;
    }
  }

?>