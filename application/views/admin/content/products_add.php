<a class="btn btn-primary pull-right" href="/administrator/catalogs">Вернуться</a>
<h3>Добавить / редактировать продукт</h3>
<form method="post" enctype="multipart/form-data">
        <h5>Название*:</h5>
        <input class="span6" name="name" type="text" value="<?=$product[0]->name?>" placeholder="Введите название продукта…">
        <br /><br />
        <h5>Описание*:</h5>
        <textarea class="span6" name="text" rows="5"><?=$product[0]->text?></textarea><br /><br />
        <h5>Особенности*:</h5>
        <textarea class="span6" name="peculiarity" rows="5"><?=$product[0]->peculiarity?></textarea><br />
        <p><em>Каждая с новой строки</em></p><br />
        <h5>Опции*:</h5>
        <textarea class="span6" name="options" rows="5"><?=$product[0]->options?></textarea><br />
        <p><em>Каждая с новой строки</em></p><br />
        <h5>Ссылка:*</h5>
        /<input type="text" class="span3" name="link" value="<?=$product[0]->link?>" />.html<br /><br />
        <?if($product[0]->img == ''){?>
        <h5>Добавить изображение*:</h5>
        <em>( jpg | png | gif )</em><br />
        <input type="file" name="userfile" /><br /><br />
        <?}else{?>
        <h5>Заменить <a target="_blank" href="<?=$category[0]->img?>">изображение</a>*:</h5>
        <em>( jpg | png | gif )</em><br />
        <input type="file" name="userfile" /><br /><br />
        <?}?>
        <?if($product[0]->img_shem == ''){?>
        <h5>Добавить схему*:</h5>
        <em>( jpg | png | gif )</em><br />
        <input type="file" name="userfile2" /><br /><br />
        <?}else{?>
        <h5>Заменить <a target="_blank" href="<?=$category[0]->img_shem?>">схему</a>*:</h5>
        <em>( jpg | png | gif )</em><br />
        <input type="file" name="userfile2" /><br /><br />
        <?}?>
        <h5>Направление раздачи*:</h5>
        <select name="direction">
            <option value="">- Выбрать напревление -</option>
            <option <?if($product[0]->direction=='Верхнее'){echo 'selected';}?>>Верхнее</option>
            <option <?if($product[0]->direction=='Нижнее'){echo 'selected';}?>>Нижнее</option>
        </select><br /><br />
        <h5>Диапозон мощностей*:</h5>
        <select name="power_from">
            <option value="">- От -</option>
            <?for($i=6;$i<150;$i++){?>
            <option <?if($product[0]->power_from==$i){echo 'selected';}?>><?=$i?></option>
            <?}?>
        </select>
        <select name="power_up">
            <option value="">- До -</option>
            <?for($i=7;$i<150;$i++){?>
            <option <?if($product[0]->power_up==$i){echo 'selected';}?>><?=$i?></option>
            <?}?>
        </select><br /><br />
        <h5>Категория*:</h5>
        <select name="cid">
            <option value="">- Выбрать категорию -</option>
            <?foreach($category as $row){?>
            <option <?if($product[0]->cid==$row->id){echo 'selected';}?> value="<?=$row->id?>"><?=$row->name?></option>
            <?}?>
        </select><br /><br />
        <button type="submit" class="btn">Отправить</button>
</form>