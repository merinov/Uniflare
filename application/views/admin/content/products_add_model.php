<h3>Добавить / редактировать модель</h3>
<h5>Продукт: <?=$product[0]->name?></h5>
<form method="post">
    <h5>Название:</h5>
    <input type="text" name="name" value="<?=$model[0]->name?>" /><br /><br />
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Характеристика</th>
                <th>Значение</th>
            </tr>
        </thead>
        <tbody>
            <?foreach($features as $row){?>
            <tr>
                <td style="width:70%"><?=$row->name?> (<?=$row->unit?>)</td>
                <td>    
                    <input type="text" <?foreach($m_f as $m){if($m->fid==$row->id){echo 'value="'.$m->value.'"';}}?> name="feaut[<?=$row->id?>]" />
                </td>
            </tr>
            <?}?>
        </tbody>
    </table>
    <br /><br />
    <input type="submit" class="btn" />
</form>