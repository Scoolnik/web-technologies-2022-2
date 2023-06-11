<h2>Каталог</h2>

<div>
    <?php foreach ($catalog as $item): ?>
        <div>
            <?=$item['name']?><br>
            <a href="/product/?id=<?=$item['id']?>"><img src="/img/<?=$item['image']?>" alt="" width="100"></a><br>
            <?=$item['description']?><br>
            Цена: <?=$item['price']?><br>
            <button>Купить</button>
            <hr>
        </div>
    <?php endforeach; ?>

</div>
