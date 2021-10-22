<?php

function getToken($url, $token, array $params) {
    $query_content = http_build_query($params);
    $fp = fopen($url, 'r', FALSE, // do not use_include_path
      stream_context_create([
      'http' => [
        'header'  => [ // header array does not need '\r\n'
          "Authorization: Token {$token}",
          'Content-Type: application/json'
        ],
        'method'  => 'POST',
        'content' => $query_content
      ]
    ]));
    if ($fp === FALSE) {
      return json_encode(['error' => 'Failed to get contents...']);
    }
    $result = stream_get_contents($fp); // no maxlength/offset
    fclose($fp);
    $jsonGetToken = json_decode($result, TRUE);
    $token = $jsonGetToken["token"];
    return $token;
}

function getItemsbyBarcodeฺ($url, $token, array $params) {
    $ch = curl_init();
    $headers = [
        "Authorization: Token {$token}",
        'Content-Type: application/json'
    ];
    $postData = $params;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));           
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result     = curl_exec ($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    return $result;
}


$url = "https://trackapi.thailandpost.co.th/post/api/v1/authenticate/token";
$token = "DYSrPfIHQ?DpJDF5H4R=GLIaOaUsA#QoSKYBHaIpAtU0PfWNHjG~I6FMQ7YyXfB#K9SuGRR7HCMHXzI.O#ZNS1CJO;A9VyVlNOLG";
$token = getToken($url, $token, array());

$url = "https://trackapi.thailandpost.co.th/post/api/v1/track";
$params = array('status' => 'all', 'language' => 'TH', 'barcode' => ["EB523637797TH"]);
$result = getItemsbyBarcodeฺ($url, $token, $params);
$result = json_decode($result, TRUE);
$track = $result["response"]["items"]["EB523637797TH"];
foreach($track as $key => $val) {
    echo "สถานะของวันที่ : {$val["status_date"]}<br>";
    echo "สถานะ : {$val["status_description"]}<br>";
    echo "สถานที่ตั้ง : {$val["location"]}<br>";
    echo "รหัสไปรษณีย์ : {$val["postcode"]}<br><br>";
    if($val["status"] == 501) {
        echo "วันที่จัดส่ง : {$val["delivery_datetime"]}<br>";
        echo "สถานะการจัดส่ง : {$val["delivery_status"]}<br>";
        echo "ชื่อผู้รับ : {$val["receiver_name"]}<br>";
        echo "ลายเซ็น : {$val["signature"]}<br><br>";
    }
}

?>