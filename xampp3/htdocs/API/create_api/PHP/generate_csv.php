// CSV出力スクリプト (generate_csv.php)
<?php
// JSONデータを再度取得
$api_url = "http://localhost:8080/API/create_api/PHP/testAPI.php";
$response = file_get_contents($api_url);
$data = json_decode($response, true);

// ヘッダーを設定してCSVファイルをダウンロードさせる
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="temple_data.csv"');

// CSVデータを出力
echo "name,location,url\n";
foreach ($data["data"] as $temple) {
    echo "{$temple['name']},{$temple['location']},{$temple['url']}\n";
}
?>
