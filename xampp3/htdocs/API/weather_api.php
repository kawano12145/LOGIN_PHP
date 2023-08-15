<?php
$api_key = '1e4b8a2b4f9b4cd9a0d63016232507';
$city = 'Tokyo';
$api_url = "http://api.weatherapi.com/v1/history.json?key={$api_key}&q={$city}&dt=";

function convertWeatherToJapanese($description)
{
    $weather_map = array(
        'Sunny' => '晴れ',
        'Partly cloudy' => '晴れ時々曇り',
        'Cloudy' => '曇り',
        'Overcast' => 'くもり',
    );
    return isset($weather_map[$description]) ? $weather_map[$description] : $description;
}

echo "東京の５日間の気象情報：<br><br>";

// ５日前から今日までの天気と気温を表示
for ($i = 0; $i < 5; $i++) {
    $date = new DateTime();                   //今日の日付を取得
    $date->modify("-{$i} days");              //現在の日時から $i 日前の日付を計算
    $weather_date = $date->format('Y-m-d');   //計算された日時を "年-月-日" の形式で文字列として取得し格納

    // APIからデータを取得
    $response = file_get_contents($api_url . $weather_date);
    $data = json_decode($response, true);



    if ($data && isset($data['forecast']['forecastday'][0]['day'])) {                            //与えられたデータ $data の中に、天気予報情報が含まれているかどうかをチェック
        $weather_description = $data['forecast']['forecastday'][0]['day']['condition']['text'];  //もしデータが存在し、かつ指定された場所に予報情報があれば、格納
        $max_temp = $data['forecast']['forecastday'][0]['day']['maxtemp_c'];
        $min_temp = $data['forecast']['forecastday'][0]['day']['mintemp_c'];

        // 天気の日本語表現に変換
        $weather_description_jp = convertWeatherToJapanese($weather_description);

        echo "日付: {$weather_date}<br>";
        echo "天気: {$weather_description_jp}<br>";
        echo "最高気温: {$max_temp}℃<br>";
        echo "最低気温: {$min_temp}℃<br><br>";
    } else {
        echo "日付: {$weather_date}<br>";
        echo "データが取得できませんでした<br><br>";
    }
}
?>
