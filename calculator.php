<?php
  class Calculator {

      //3種類の合計金額を計算して表示する
  function CalculateTotalPrice($totals) {
    $total = array_sum($totals);
    if (strlen($total)<=4) {
      //億未満の場合そのまま表示
      echo "全ての車の合計金額は" . $total . "万円です</br>";
    }else {
      //億以上の時は○億○万円の表記で表示
      $bil = substr($total, 0, 1);
      $thou = substr($total, 1, 1);
      if ($thou != 0) {
        $mil = substr($total, 1, 4);
        echo "全ての車の合計金額は" . $bil . "億" . $mil . "万円です</br>";
      } else {
        $hun = substr($total, 2, 1);
        if ($hun != 0) {
          $mil = substr($total, 2, 3);
          echo "全ての車の合計金額は" . $bil . "億" . $mil . "万円です</br>";
        } else {
          $ten = substr($total, 3, 1);
          if ($ten != 0) {
            $mil = substr($total, 3, 2);
            echo "全ての車の合計金額は" . $bil . "億" . $mil . "万円です</br>";
          } else {
            $mil = substr($total, 4,1);
            echo "全ての車の合計金額は" . $bil . "億" . $mil . "万円です</br>";
          }
        }
      }
    }
    return $total;
  }
  
  //平均金額を計算して表示する
  function CalculateAveragePrice($total, $amount) {
    echo "全ての車の平均金額は約" . round($total / $amount, 1) . "万円です</br>";
  }

  //レース距離を決定する
  function DesideDistance() {
    $distance = (floor(mt_rand(5000, 20000)/1000))*1000;
    echo "今回のレースの距離は" . $distance . "mです。</br></br>";
    return $distance;
  }


  //タイムを表示して、順位を決定する
  function DemandRank($times) {

    $array = array(
      "ホンダ" => round($times[0], 3),
      "日産"=> round($times[1], 3),
      "フェラーリ" =>round($times[2], 3),
      "トヨタ" => round($times[3], 3)
    );

    $total_time = array_sum($times);
    // 平均タイム計算
    $average_time = round($total_time) / count($times);


    foreach($array as $name => $time){
      $min = floor($time / 60);
      $sec = $time % 60;
      echo $name . "のタイムは" . $min . "分". $sec . "秒です。</br>";
    }

    echo "平均タイムは" . floor($average_time / 60) ."分". ($average_time % 60) . "秒です。</br></br>";


    //順番変更
    asort($array);

    $rank = array_keys($array);
    foreach ($rank as $key => $value) {
      echo $key + 1 . "位は" . $value . "です。";
    }


  }
  }
?>