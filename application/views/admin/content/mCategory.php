<h3>Главные категории</h3>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Изображение</th>
            <th style="width: 1px;">Редактировать</th>
            <th style="width: 1px;">Характиристики</th>
        </tr>
    </thead>
    <tbody>
        <?foreach($category as $k => $row){?>
        <tr>
            <td><?=$k+1;?></td>
            <th><a target="_blank" href="/products/<?=$row->link?>.html"><strong><?=$row->name?></strong></a></th>
            <td><?=$row->text;?></td>
            <td><a href="javascript:winOpen('<?=$row->img?>', 'Файловый менеджер', 800, 640, false, false, false, false, false, false)">посмотреть</a></td>
            <td style="text-align: center;">
                <a href="/administrator/mCategory/edite/<?=$row->id?>" class="btn btn-mini btn-info">
                    <i class="icon icon-edit icon-white"></i>
                </a>
            </td>
            <td style="text-align: center;">
                <a href="/administrator/mCategory/feature/<?=$row->id?>" class="btn btn-mini btn-warning">
                    <i class="icon icon-cog icon-white"></i>
                </a>
            </td>
        </tr>
        <?}?>
    </tbody>
</table>