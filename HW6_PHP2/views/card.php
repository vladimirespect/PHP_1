<h2>Карточка товара</h2>
<div>
    <h3><?=$good->name?></h3>          <!-- в item будет приходить из бд объект где имена полей будут совпадать с именами столбцов в бд. -->
    <img src="/image/big/<?= $good->image?>" alt="goods"/><br>
    <p> <?=$good->description?></p>
    <p>Стоимость: <?=$good->price?> руб.</p>
    <button>Купить</button>
</div>
<!-- для подзагрузки всего идём в метод actionCard productController'а -->