<?php

// USBカメラで撮影し、ファイルに保存する
$output = null;
$retval = null;
$filepath = "image.jpg";
$device = "/dev/video0";

$cmd = 'ffmpeg -ss 10 -f video4linux2 -s 1280x960 -i ' . $device . ' -vframes 1 ' . $filepath;
exec($cmd, $output, $retval);

// 画像ファイルをbase64エンコード
$base64 = base64_encode(file_get_contents($filepath));

// ファイルを削除する
unlink($filepath);

// コマンド結果をjsonでレスポンスする
echo json_encode([
    "code" => $retval,
    "out" => $output,
    "filepath" => $filepath,
    "base64" => $base64,
]);
