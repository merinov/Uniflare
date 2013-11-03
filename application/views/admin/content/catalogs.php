<a class="btn btn-success pull-right" href="/administrator/catalogs/add">Добавить новый</a>
<h3>Каталоги</h3>
<table class="table table-bordered table-stripped">
    <thead>
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Файл</th>
            <th>Дата добавления</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?foreach($catalogs as $k => $row){?>
        <tr>
            <th><?=$k+1?></th>
            <th><?=$row->name?></th>
            <th><a target="_blank" href="<?=$row->path?>">посмотреть</a></th>
            <th><?=$row->date?></th>
            <td style="text-align: center;">
                <a href="/administrator/catalogs/edite/<?=$row->id?>" class="btn btn-mini btn-info">
                    <i class="icon icon-edit icon-white"></i>
                </a>
                <a href="/administrator/catalogs/delete/<?=$row->id?>" class="btn btn-mini btn-danger">
                    <i class="icon icon-remove icon-white"></i>
                </a>
            </td>
        </tr>
        <?}?>
    </tbody>
</table>
