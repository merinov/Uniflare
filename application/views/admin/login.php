
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
        <div class="container">
            <div class="row">
            <div class="navbar">
            <div class="navbar-inner">
               <div class="container"> 
                    <a class="brand" href="/">
                       Uniflair (вернуться на сайт)
                    </a>
               </div>
            </div>
            </div>
            <?  if($this->session->flashdata('message')) { ?>
              <div class="alert alert-success">
                <button class="close" data-dismiss="alert">&times;</button>
                <?=$this->session->flashdata('message'); ?>
              </div>
            <? } ?>
            <?  if($this->session->flashdata('warning')) { ?>
              <div class="alert alert-warning">
                <button class="close" data-dismiss="alert">&times;</button>
                <?=$this->session->flashdata('warning'); ?>
              </div>
            <? } ?>
            <?  if($this->session->flashdata('error')) { ?>
              <div class="alert alert-error">
                <button class="close" data-dismiss="alert">&times;</button>
                <?=$this->session->flashdata('error'); ?>
              </div>
            <? } ?>
            <form method="post" accept-charset="utf-8" class="well form-inline" style="text-align:center;">        
                <h1><small>Вход</small></h1>
                    <input type="text" name="login" value="" class="identity" placeholder="Логин">        
                    <input type="password" name="password" value="" class="input-small" placeholder="Пароль">      
                    <input type="submit" name="" value="Войти" class="btn">     
            </form>
            </div>
        </div>
    </body>
</html>