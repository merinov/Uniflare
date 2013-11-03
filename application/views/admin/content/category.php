<a class="pull-right btn btn-success" href="/administrator/category/add">Добавить</a>
<h3>Категории</h3>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Изображение</th>
            <th>Категория</th>
            <th>Действие</th>
        </tr>
    </thead>
    <tbody>
        <?foreach($category as $k => $row){
            $ca = $this->db->get_where('main_category', array('id' => $row->mcid))->result();?>
        <tr>
            <td><?=$k+1;?></td>
            <th><a target="_blank" href="/products/<?=$ca[0]->link?>/<?=$row->link?>.html"><strong><?=$row->name?></strong></a></th>
            <td><?=$row->text;?></td>
            <td><a href="javascript:winOpen('<?=$row->img?>', 'Файловый менеджер', 800, 640, false, false, false, false, false, false)">посмотреть</a></td>
            <td style="text-align: center;"><?=$ca[0]->name;?></td>
            <td style="text-align: center;">
                <a href="/administrator/category/edite/<?=$row->id?>" class="btn btn-mini btn-info">
                    <i class="icon icon-edit icon-white"></i>
                </a>
                <a href="/administrator/category/delete/<?=$row->id?>" class="btn btn-mini btn-danger">
                    <i class="icon icon-remove icon-white"></i>
                </a>
            </td>
        </tr>
        <?}?>
    </tbody>
</table>