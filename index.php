<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        .imagesContainer {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(1, 200px);
        }
        .imagesContainer * {
            width: 100%;
            height: 100%;
            object-fit: scale-down;
        }
    </style>
</head>
<body>
<h1>Галерея</h1>

<?php
include './Gallery.php';
include './Logger.php';

$gallery = new Gallery('/upload');
$logger = new Logger('/logs');
$logger->log(date(DATE_ATOM));
?>

<form method="post" enctype="multipart/form-data" action="<?php on_image_uploaded()?>">
    <input type="file" name="gallery_image" accept=".jpeg,.png,.jpg">
    <input type="submit" value="Загрузить">
</form>
<div class="imagesContainer">
<?php
foreach ($gallery->getPreviews() as $preview) {
    echo $preview;
}
?>
</div>
<?php
function on_image_uploaded(): void {
    if (!empty($_FILES)) {
        global $gallery;
        $data = $_FILES['gallery_image'];
        if (str_starts_with($data['type'], 'image')) {
            $gallery->addImage($data['tmp_name'], $data['name']);
        }
    }
}

// Задание 4 и 5
if (file_exists('logs/log.txt') && count(file('logs/log.txt')) == 10) {
    $numOfLogs = count(array_slice(scandir('logs/'), 2)) - 1;
    rename('logs/log.txt', 'logs/log' . $numOfLogs . '.txt');
    file_put_contents('logs/log.txt', date('H:i:s d-m-Y') . PHP_EOL);
} else {
    file_put_contents('logs/log.txt', date('H:i:s d-m-Y') . PHP_EOL, FILE_APPEND);
}

?>

</body>
</html>