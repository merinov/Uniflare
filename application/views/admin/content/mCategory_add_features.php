<h3>Добавить характеристику</h3>
<h5>Категори: <?=$category[0]->name?></h5>
<form method="post">
    <p>
        Характеристика:&nbsp; &nbsp; &nbsp; &nbsp; 
        <input type="text" name="name" class="span4" />
    </p>
    <p>
        Единица измерения: 
        <input type="text" name="unit" class="span2" />
    </p>
    <p>
        <input type="submit" class="btn" />
    </p>
</form>