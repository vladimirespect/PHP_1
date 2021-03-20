<h2>Карточка товара</h2>
<div>
    <h3><?=$good->name?></h3>
    <img src="/image/big/<?= $good->image?>" alt="goods"/><br>
    <p> <?=$good->description?></p>
    <p>Стоимость: <?=$good->price?> руб.</p>
    <button>Купить</button>
</div>
