<?php
date_default_timezone_set('Asia/Yekaterinburg');
$label = 'Hello world';
$title = 'PHP';
$pluralForms = array(
    'h' => ['час', 'часа', 'часов'],
    'm' => ['минута', 'минуты', 'минут'],
);

function getCurrentTime(): string {
    $hour = intval(date('H'));
    $minutes = intval(date('i'));
    $hourStr = pluralize($hour, 'h');
    $minutesStr = pluralize($hour, 'm');
    return "$hour $hourStr $minutes $minutesStr";
}

function pluralize($number, $word): string {
    global $pluralForms;
    $absNumber = abs($number) % 100;
    $lastDigit = $absNumber % 10;
    if ($lastDigit === 1 && $absNumber !== 11) {
        return $pluralForms[$word][0];
    } else if ($lastDigit > 1 && $lastDigit < 5 && ($absNumber < 10 || $absNumber >= 20)) {
        return $pluralForms[$word][1];
    } else {
        return $pluralForms[$word][2];
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
</head>
<body>
<h1><?= $label ?></h1>
<p>Текущее время: <?= getCurrentTime() ?></p>
</body>
</html>
