
<div>
    <?=$product['name']?><br>
    <img src="/img/<?=$product['image']?>" alt="" width="100"><br>

    <strong>Описание:</strong><br>
    <?=$product['description_full']?><br><br>

    Цена: <?=$product['price']?><br>
    <button>Купить</button>
    <hr>
    <?php require('productFeedback.php') ?>
</div>