<a class="btn btn-primary pull-right" href="/administrator/category">Вернуться</a>
<h3>Добавить / редактировать категорию</h3>
<form method="post" enctype="multipart/form-data">
        <h5>Название*:</h5>
        <input class="span6" name="name" type="text" value="<?=$category[0]->name?>" placeholder="Введите название категории…">
        <h5>Описание:*</h5>
        <textarea rows="10" name="text" class="span6"><?=$category[0]->text?></textarea>
        <h5>Ссылка:*</h5>
        /<input type="text" class="span3" name="link" value="<?=$category[0]->link?>" />.html
        <br /><em style="font-size: 10px;">Если ссылка не задана, то она сформируется в транслите из названия</em>
        <br /><br />
        <?if($category[0]->img == ''){?>
        <h5>Добавить изображение*:</h5>
        <em>( jpg | png | gif )</em><br />
        <input type="file" name="userfile" /><br /><br />
        <?}else{?>
        <h5>Заменить <a target="_blank" href="<?=$category[0]->img?>">изображение</a>*:</h5>
        <em>( jpg | png | gif )</em><br />
        <input type="file" name="userfile" /><br /><br />
        <?}?>
        <h5>Главная категория:</h5>
        <select name="mcid" class="span4">
            <?foreach($mcats as $row){?>
            <option <?=($row->id==$category[0]->mcid?'secelted="selected"':'');?> value="<?=$row->id?>"><?=$row->name?></option>
            <?}?>
        </select><br /><br />
        <button type="submit" class="btn">Добавить</button>
</form>