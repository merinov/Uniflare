<script type="text/javascript" src="/js/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<style type="text/css">
	 .nicEdit-main{
	   background-color: white;
	 }
</style>
<h4>История компании</h4>
<form method="post">
    <textarea name="text" style="width: 100%;height:350px;">
	   <?=$history?>
    </textarea><br /><br />
    <input type="submit" class="btn btn-success pull-right" value="Сохранить" />
</form>