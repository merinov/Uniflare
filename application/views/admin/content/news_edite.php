<script type="text/javascript" src="/js/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<style type="text/css">
	 .nicEdit-main{
	   background-color: white;
	 }
</style>
<a class="btn btn-primary pull-right" href="/administrator/news">Вернуться</a>
<h3>Добавить / редактировать новость</h3>
<form method="post">
    <h5>Название новости:</h5>
    <input name="name" type="text" class="span10" value="<?=$catalog[0]->name?>" /><br />
    <h5>Содержание:</h5>
    <textarea name="text" style="width: 100%;height:350px;"><?=$catalog[0]->text?></textarea><br /><br />
    <input type="submit" class="btn btn-success pull-right" value="Сохранить" />
</form>