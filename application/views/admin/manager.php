<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
    <link href="//yandex.st/bootstrap/2.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="http://top-pr.ru/css/style.css" rel="stylesheet" />
    <script type="text/javascript" src="//yandex.st/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="//yandex.st/bootstrap/2.3.0/js/bootstrap.min.js"></script>
    <script src="http://promo001.ru/js/jquery.tablesorter.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="//malsup.github.io/jquery.blockUI.js"></script>
    <script type="text/javascript">
	   function openRed(link)
        {
            $('.modal-body').html('<h3>'+link+'</h3>');
            $('#red').modal({
              keyboard: true
            })
        }
    </script>
</head>
    <body>  
            <div class="row-fluid">
                <div class="span12">       
                    <div class="well">
                        <h3>Файловый менеджер</h3>
                    </div>
                    <div style="padding: 5px;20px">
                        <div style="text-align: center;">
                            <a href="/administrator/FileManager/add" class="btn btn-small"><i class="icon-file"></i>Добавить файл</a>
                        </div><br /><br />
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 50%;">Название</th>
                                    <th>Тип файла</th>
                                    <th>Копировать ссылку</th>
                                    <th>Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?foreach($directory as $k => $row){?>
                                <tr>
                                    <td><?=$k+1?></td>
                                    <td><strong><?=$row?></strong></td>
                                    <td style="text-align: center;"><?=get_mime_by_extension($row)?></td>
                                    <td style="text-align: center;">
                                        <a href="#" class="btn btn-mini btn-info" title="Ссылка скопирована в буфер обмена" onclick="openRed('<?=base_url().'uploads/files/'.$row;?>')" >
                 							<i class="icon-white icon-share"></i> Скопировать
                  						</a>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="/administrator/FileManager/delete/<?=urlencode(str_replace('=','',base64_encode($row)));?>" class="btn btn-mini btn-danger">
                                            <i class="icon icon-remove icon-white"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?}?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<div id="red" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="#" style="margin: 0px;" method="post" onsubmit="load(0)">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5>Скопируйте ссылку ниже</h5>
        </div>
        <div class="modal-body" style="text-align: center;">
            
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal">Закрыть</button>
        </div>
    </form>
</div>

    </body>
</html>