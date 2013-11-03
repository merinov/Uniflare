<a class="btn btn-primary pull-right" href="/administrator/mCategory/add_feature/<?=$category[0]->id;?>">Добавить</a>
<h3>Характеристики</h3>
<h5>Категория: <?=$category[0]->name;?></h5>
<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 75%;">Характиристика</th>
            <th>Ед. измерения</th>
            <th>Удалить</th>
        </tr>
    </thead>
    <tbody>
        <?foreach($features as $row){?>
        <tr>
            <td><?=$row->name?></td>
            <td><?=$row->unit?></td>
            <td style="text-align: center;">
                <a href="/administrator/mCategory/del_feature/<?=$row->id?>" class="btn btn-mini btn-danger">
                    <i class="icon icon-remove icon-white"></i>
                </a>
            </td>
        </tr>
        <?}?>
    </tbody>
</table>