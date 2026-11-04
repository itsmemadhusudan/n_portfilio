<?php

$files = [
    'public/assets/planet/earth-day.jpg' => [1280, 78],
    'public/assets/planet/earth-night.jpg' => [1024, 75],
];

foreach ($files as $path => [$maxW, $q]) {
    $info = getimagesize($path);
    if (! $info) {
        echo "fail {$path}\n";
        continue;
    }

    [$w, $h] = $info;
    $src = imagecreatefromstring(file_get_contents($path));
    $nw = min($w, $maxW);
    $nh = (int) round($h * ($nw / $w));
    $dst = imagecreatetruecolor($nw, $nh);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $nw, $nh, $w, $h);
    imagejpeg($dst, $path, $q);
    imagedestroy($src);
    imagedestroy($dst);
    echo basename($path).' '.round(filesize($path) / 1024)."KB {$nw}x{$nh}\n";
}

$path = 'public/assets/planet/earth-clouds.png';
$info = getimagesize($path);
$src = imagecreatefrompng($path);
$w = $info[0];
$h = $info[1];
$nw = min($w, 768);
$nh = (int) round($h * ($nw / $w));
$dst = imagecreatetruecolor($nw, $nh);
imagealphablending($dst, false);
imagesavealpha($dst, true);
$transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
imagefilledrectangle($dst, 0, 0, $nw, $nh, $transparent);
imagealphablending($dst, true);
imagecopyresampled($dst, $src, 0, 0, 0, 0, $nw, $nh, $w, $h);
imagepng($dst, $path, 7);
echo 'earth-clouds.png '.round(filesize($path) / 1024)."KB {$nw}x{$nh}\n";
