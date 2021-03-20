<?php if ($isAuth): ?>
    <h4>Приветствую Вас, <?= $userName ?>! <a class="exit"  href="/auth/logout">[Выход]</a></h4>
<?php else: ?><br><br>
    <form action="/auth/login" method="post" >
          <input type="text" name="login" placeholder="Логин:">
         <input type="password" name="pass" placeholder="Пароль:">
        Сохранить? <input type="checkbox" name="save"> <input type="submit" value="Войти">
    </form>
<?php endif; ?><br>

<a href="/">Главная</a>
<a href="/product/catalog">Каталог</a>
<a href="/basket">Корзина (<span id="count"><?=$count?></span>)</a><br>
