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
</head>
    <body>  
            <div class="row-fluid">
                <div class="span12">       
                    <div class="well">
                        <h3>Добавить файл</h3>
                    </div>
                    <form action="/administrator/FileManager/add/up" method="post" style="margin-left: 25px;" enctype="multipart/form-data">
                       <h5>Добавьте файл</h5>
                       <input type="file" name="userfile" /> <br /><br />
                       <em>( docx | doc | xls | pdf | xlsx | jpg | png | gif )</em><br /><br />
                       <input type="submit" class="btn" value="Добавить" />
                    </form>
                </div>
            </div>
    </body>
</html>