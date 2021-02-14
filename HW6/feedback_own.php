<?php

include "db.php";

//это делается с помощью сессий, в конфиге, но пока я этого не знаю так:
$messages = [
    'OK' => 'Сообщение добавлено',
    'DELETE' => 'Сообщение удалено',
    'EDIT' => 'Сообщение изменено',
    'ERROR' => 'Ошибка'
];

$action = "add";
$buttonText = "Добавить";
$row_edit = [];

if ($_GET['action'] == 'delete') {
    $id = (int)$_GET['id'];
    mysqli_query($db, "DELETE FROM feedback WHERE id = {$id}");
    header("Location: /feedback_own.php/?message=DELETE");
    die();
}



//принимаем данные от пользователя, ловим их глобальным пост, и обрабатываем для безопасной записи в переменные и дальнейшей передачи в бд
//заменили в if $_POST HA $_GET для того чтобы реализовать правку сообщения в той же форме где и добавление нового
if ($_GET['action'] == 'add') {
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['name'])));
    //обрезаем теги(вырезаем спецсимволы(добавляем кавычки не позволяя построить валидный запрос(требует подключение к БД)...
    $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['feedback'])));

    $sql = "INSERT INTO feedback(name, feedback) VALUES ('{$name}','{$feedback}')"; //имя таблицы, имя столбцов--значения для вставки строк

    mysqli_query($db, $sql); //непосредственно php запрос в БД

    header("Location: /feedback_own.php/?message=OK"); //чтобы очистить пост данные которые запомнил сервер, чтобы не произошло двойного добавления отзыва
    die();
}

if ($_GET['action'] == 'edit') {
    $id = (int)$_GET['id']; //поймали айди, значит можем стучаться в БД
    $result = mysqli_query($db, "SELECT * FROM feedback WHERE id = {$id}");
    if ($result) $row_edit = mysqli_fetch_assoc($result);//вытаскиваем имя и отзыв с БД по айди, для подстановки в форму и предост.возм. пользов. его редакт.
    $action = "save";
    $buttonText = "Редактировать";
}

if ($_GET['action'] == 'save') {
    $id = (int)$_POST['id']; //поймали айди (но уже из скрытого поля формы), значит можем стучаться в БД
    //проверяем новые введённые данные на безопасность
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['name'])));
    $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['feedback'])));
    $sql = "UPDATE feedback SET name='{$name}',feedback='{$feedback}' WHERE id ={$id}";
    mysqli_query($db, $sql);
    header("Location: /feedback_own.php/?message=EDIT");
    die();
}

$result = mysqli_query($db, "SELECT * FROM feedback WHERE 1 ORDER BY id DESC");

if (isset($_GET['message'])) {
    $message = $messages[$_GET['message']];
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Отзывы</title>
</head>
<body>
<?php include "menu.php" ?>
<h2>Отзывы</h2>
<?= $message ?><br>
<form action="/feedback_own.php/?action=<?= $action ?>" method="post">
    <!-- если запрос меняет состояние на сервере используем ПОСТ. но это не мешает нам через экшн задействовать ГЕТ-->
    <input hidden type="text" name="id" value="<?= $row_edit['id'] ?>"><br>
    <!-- скрытая информ. чтобы стучаться в БД для редактирования отзыва по айди -->
    <input type="text" name="name" value="<?= $row_edit['name'] ?>"><br>
    <input type="text" name="feedback" value="<?= $row_edit['feedback'] ?>"><br>
    <input type="submit" value="<?= $buttonText ?>">
</form>

<? if ($result): ?>
    <? while ($row = mysqli_fetch_assoc($result)) : ?>
        <p>
            <b><?= $row['name'] ?> глаголит: </b><i><?= $row['feedback'] ?></i><a
                    href="/feedback_own.php/?action=edit&id=<?= $row['id'] ?>"> [edit]</a>
            <a href="/feedback_own.php/?action=delete&id=<?= $row['id'] ?>">[x]</a>
        </p>
    <? endwhile; ?>
<? else: ?>
    Отзывов пока нет. Будь первым!
<? endif; ?>

</body>
<?php include "footer.php" ?>
</html>
