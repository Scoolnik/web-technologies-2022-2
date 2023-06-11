<h2>Отзывы</h2>
<?=$message??''?>
<form action="<?='/feedback/add/?src='.$_SERVER['REQUEST_URI']?>" method="post">
    Оставьте отзыв: <br>
    <input type="text" name="name" placeholder="Ваше имя"><br>
    <input type="text" name="message" placeholder="Ваш отзыв"><br>
    <input type="text" style="display: none" name="productId" class="hidden" value="<?= $product['id'] ?>">
    <input type="submit" value="Добавить">
</form>

<?php foreach ($feedback as $value): ?>
<div>
    <strong><?=$value['name']?></strong>: <?=$value['feedback']?>
    <a href=<?="/editfeedback/?id=".$value['id'].'&src='.$_SERVER['REQUEST_URI']?>><button>Изменить</button></a>
</div>
<?php endforeach;?>
