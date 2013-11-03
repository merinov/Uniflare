<a class="btn btn-primary pull-right" href="/administrator/technology">Вернуться</a>
<h3>Добавить / редактировать технологию</h3>
<form method="post" enctype="multipart/form-data">
        <h5>Название*:</h5>
        <input class="span6" name="name" type="text" value="<?=$catalog[0]->name?>" placeholder="Введите название технологии…">
        <br /><br />
        <?if($catalog[0]->path == ''){?>
        <h5>Добавить файл*:</h5>
        <em>( docx | doc | xls | pdf | xlsx | word )</em><br />
        <input type="file" name="userfile" /><br /><br />
        <?}else{?>
        <h5>Заменить <a target="_blank" href="<?=$catalog[0]->path?>">файл</a>*:</h5>
        <em>( docx | doc | xls | pdf | xlsx | word )</em><br />
        <input type="file" name="userfile" /><br /><br />
        <?}?>
        <button type="submit" class="btn">Отправить</button>
</form>