<?php if ($auth): ?>
    <h4>Приветствую Вас, <?= $name ?>! <a class="exit"  href="/?logout">[Выход]</a></h4>
<?php else: ?><br><br>
    <form action="" method="post">
        Логин: <input type="text" name="login"><br>
        Пароль:<input type="password" name="pass"><br>
        Сохранить? <input type="checkbox" name="save"><br>
        <input type="submit" value="Войти">
    </form>
<?php endif; ?>
