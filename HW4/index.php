<?php
include "classSimpleImage.php";
define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('BIG', DIR_ROOT . '/gallery_img/big/');
define('SMALL', DIR_ROOT . '/gallery_img/small/');

$messages = [
    'ok' => 'Файл загружен',
    'error' => 'Ошибка загрузки'
];
if (!empty($_FILES)) {
    if (isset($_POST['load'])) { //ловим нажатие кнопки load
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
            header("Location: index.php?message=ok");
        } else {
            header("Location: index.php?message=error");
        }
    }
}
function createGallery($folder)
{
    return array_splice(scandir($folder), 2);
//таким образом из директории я беру массив имен файлов, и так как в small и big они совпадают всё работает.
}

//include dirname(__DIR__) . "/now/index.php";
//include $_SERVER['DOCUMENT_ROOT'] . "/index.php";
//include __DIR__ . "/index.php";
//include realpath("index.php");
$images = createGallery(BIG);
$message = $messages[$_GET['message']];
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Моя галерея</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script type="text/javascript" src="./scripts/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="./scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="./scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="./scripts/fancybox/jquery.fancybox-1.3.4.css" media="screen"/>
    <script type="text/javascript">
        $(document).ready(function () {
            $("a.photo").fancybox({
                transitionIn: 'elastic',
                transitionOut: 'elastic',
                speedIn: 500,
                speedOut: 500,
                hideOnOverlayClick: false,
                titlePosition: 'over'
            });
        }); </script>

</head>

<body>
<div id="main">
    <input type="submit" value="Назад" name="<?= $_SERVER['HTTP_REFERER']; ?>">
    <!--  попытался реализовать но не особо получилось -->
    <div class="post_title"><h2>Моя галерея</h2></div>
    <div class="gallery">
        <? foreach ($images as $name) : ?>
            <a rel="gallery" class="photo" href="gallery_img/big/<?= $name ?>"><img src="gallery_img/small/<?= $name ?>"
                                                                                    width="150"/></a>
        <? endforeach; ?>
    </div>
    <?= $message ?>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" value="Загрузить" name="load">
    </form>
</div>

</body>
</html>