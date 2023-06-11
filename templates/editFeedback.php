<h2>Отзыв:</h2>
<?=$message??''?>
<form action="<?='/feedback/edit/?src='.$_GET['src']?>" method="post">
    <input type="text" style="display: none" name="feedbackId" class="hidden" value="<?= $feedback['id'] ?>">
    <input type="text" name="name" placeholder="Ваше имя" value="<?=$feedback['name']?>"><br>
    <input type="text" name="message" placeholder="Ваш отзыв" value="<?=$feedback['feedback']?>"><br>
    <input type="submit" value="Изменить">
</form>
<a href=<?="/feedback/delete/?feedbackId=".$feedback['id'].'&src='.$_GET['src']?>><button>Удалить</button></a>
