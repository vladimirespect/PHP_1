<?php
$path = BIG . $_FILES["image"]["name"]; //$_FILES глобальная переменная хранящая загр.файлы
$small = SMALL . $_FILES["image"]["name"];
if (file_exists($path)) {
    echo "Файл $path существует. Выберите другое имя файла!";
    exit;
}
if ($_FILES['image']['size'] > 1024 * 1 * 1024) {
    echo "Размер файла не более 5 мб!";
    exit;
}
$blackList = [
    ".php",
    ".phtml",
    ".php3",
    ".php4"
];
foreach ($blackList as $item) {
    if (preg_match("/$item\$/i", $_FILES['image']['name'])) {
        echo "Загрузка PHP-файлов запрещена!";
        exit;
    }
}
if (move_uploaded_file($_FILES["image"]["tmp_name"], $path)) {
    $image = new SimpleImage();
    $image->load($path);
    $image->resizeToWidth(150);
    $image->save($small);
    //$filename = mysqli_real_escape_string($db, $_FILES['image']['name']); так должна была быть реализована защита от иньекций
    $insert = "INSERT INTO `goods`(`name`) VALUES ('" . $_FILES['image']['name'] . "')";
    mysqli_query($db, $insert);
    header("Location: index.php?message=ok");
    die;
} else {
    header("Location: index.php?message=error");
    die;
}