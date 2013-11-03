<a class="btn btn-success pull-right" href="/administrator/news/add">Добавить новость</a>
<h3>Новости</h3>
<table class="table table-bordered table-stripped" style="background: white;">
    <thead>
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Текст</th>
            <th style="width: 20%;text-align: center;">Дата добавления</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?foreach($news as $k => $row){?>
        <tr>
            <td><?=$k+1?></td>
            <td><?=$row->name?></td>
            <td><?=word_limiter($row->text, 15);?></td>
            <td style="text-align: center;"><?=$row->date?></td>
            <td style="text-align: center;">
                <a href="/administrator/news/edite/<?=$row->id?>" class="btn btn-mini btn-info">
                    <i class="icon icon-edit icon-white"></i>
                </a>
                <a href="/administrator/news/delete/<?=$row->id?>" class="btn btn-mini btn-danger">
                    <i class="icon icon-remove icon-white"></i>
                </a>
            </td>
        </tr>
        <?}?>
    </tbody>
</table>