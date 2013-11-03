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
    <style type="text/css">
        #rtab{
            display: block;
            font-size: 13px;
            color:white;
            background-color: #719D1E !important;
            line-height: 0;
            cursor: pointer;
            z-index: 100001;
            right: 0;
            margin-top: -117.5px;
            position: fixed;
            top: 50%;
            border: 1px solid #FFF;
            padding: 10px 3px 10px 5px;
            border-right: 0;
            background: #719D1E url(http://media.reformal.ru/widgets/v3/gr.png) 100% 0 repeat-y;
            -webkit-border-radius: 5px 0 0 5px;
            -moz-border-radius: 5px 0 0 5px;
            border-radius: 5px 0 0 5px;
            -moz-box-shadow: -1px 0 2px #888;
            -webkit-box-shadow: -1px 0 2px #888;
            box-shadow: -1px 0 2px #888;
        }
    </style>
    <script language="JavaScript">
    function winOpen(URL, windowName, width, height, resizable, location, menubar, scrollbars, status, toolbar){
    	var windowFeatures;
    	windowFeatures = '';
    	if (width != '' && width != null){
    		windowFeatures = windowFeatures+'width='+width+',';
    	}
    	if (height != '' && height != null){
    		windowFeatures = windowFeatures+'height='+height+',';
    	}
    	window.open(URL, windowName, windowFeatures);
    }
    </script>
</head>
    <body>  
    <a id="rtab" href="javascript:winOpen('/administrator/FileManager', 'Файловый менеджер', 800, 640, false, false, false, false, false, false)">Менеджер</a>
        <div class="container">
            <div class="row">
            <div class="navbar">
            <div class="navbar-inner">
               <div class="container"> 
                    <a class="brand" href="/">
                       Uniflair (вернуться на сайт)
                    </a>
                    <ul class="nav">
                         <li class="divider-vertical"></li>
                         <li><a href="/administrator">Статистика</a></li>
                         <li class="dropdown">
        					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
        						Продукты и системы				
        						<b class="caret"></b>
        					</a>
        					<ul class="dropdown-menu pull-right">
                                <li><a href="/administrator/mCategory">Главные категории</a></li>
        						<li><a href="/administrator/category">Категории продуктов</a></li>
                                <li><a href="/administrator/products">Продукты</a></li>
        					</ul> 
        				</li>
                        <li class="dropdown">
        					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
        						Поддержка	
        						<b class="caret"></b>
        					</a>
        					<ul class="dropdown-menu pull-right">
        						<li><a href="/administrator/catalogs">Каталоги</a></li>
                                <li><a href="/administrator/technology">Технологии и инновации</a></li>
        					</ul> 
        				</li>
                        <li class="dropdown">
        					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
        						О нас
        						<b class="caret"></b>
        					</a>
        					<ul class="dropdown-menu pull-right">
        						<li><a href="/administrator/history">История</a></li>
                                <li><a href="/administrator/technology">Референс-лист</a></li>
                                <li><a href="/administrator/news">Новости</a></li>
        					</ul> 
        				</li>
                        <li class="dropdown">
        					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
        						Контакты
        						<b class="caret"></b>
        					</a>
        					<ul class="dropdown-menu pull-right">
        						<li><a href="/administrator/catalogs">Офисы</a></li>
                                <li><a href="/administrator/technology">Дистрибьютеры</a></li>
        					</ul> 
        				</li>
                    </ul>
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
            <?  if(function_exists('validation_errors')) {if(validation_errors() !=''){ ?>
              <div class="alert alert-error">
                <button class="close" data-dismiss="alert">&times;</button>
                <?=validation_errors(); ?>
              </div>
            <? }} ?>
            <div class="well form-inline">        
                <?$this->load->view('admin/content/'.$_cb);?>
            </div>
            </div>
        </div>
    </body>
</html>