<a class="pull-right btn btn-success" href="/administrator/products/add">Добавить</a>
<h3>Продукты</h3>
    <div class="accordion" id="accordion2" style="background: white;">
        <div class="accordion-group">
            <div class="accordion-heading">
                <a style="text-align: center;" class="accordion-toggle collapsed btn" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                Фильтр
                </a>
            </div>
            <div id="collapseOne" class="accordion-body collapse" style="height: 0px;">
                <div class="accordion-inner">
                    <form class="form" style="background: white;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Категория</th>
                                    <th>Название</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="cat" class="span4">
                                        <option value="">-Выбрать категорию-</option>
                                        <?foreach($category as $row){?>
                                            <option <?=($row->id==$cat?'selected="selected"':'');?> value="<?=$row->id?>"><?=$row->name?></option>
                                        <?}?>
                                        </select>
                                    </td>
                                    <td>
                                        <input class="span4" name="name" type="text" value="<?=$name?>" placeholder="Введите название" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="submit" class="btn pull-right" value="Фильтр" />
                                        <a href="/administrator/products" class="btn btn-info pull-right">Сбросить фильтр</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Категория</th>
            <th>Модель</th>
            <th>Действие</th>
        </tr>
    </thead>
    <tbody>
        <?foreach($products as $k => $row){
            $models = $this->db->get_where('models', array('pid' => $row->id))->result();?>
        <tr>
            <td><?=$row->id;?></td>
            <td><a href="/product/<?=$row->id;?>.html"><?=$row->name;?></a></td>
            <td><?=$row->text;?></td>
            <td style="text-align: center;font-weight: 600;"><?$ca = $this->db->get_where('category', array('id' => $row->cid))->result(); echo $ca[0]->name?></td>
            <td style="text-align: center;">
                <a href="/administrator/products/add_model/<?=$row->id?>" class="btn btn-mini btn-warning">
                    <i class="icon icon-plus icon-white"></i>
                </a>
            </td>
            <td style="text-align: center;">
                <a href="/administrator/products/edite/<?=$row->id?>" class="btn btn-mini btn-info">
                    <i class="icon icon-edit icon-white"></i>
                </a>
                <a href="/administrator/products/delete/<?=$row->id?>" class="btn btn-mini btn-danger">
                    <i class="icon icon-remove icon-white"></i>
                </a>
            </td>
        </tr>
        <?if(!empty($models)){foreach($models as $rows){?>
        <tr style="background: #FFFFC2;">
            <td colspan="2" style="text-align: center;"><?=$row->name;?></td>
            <td><strong><?=$rows->name?></strong></td>
            <td colspan="2"></td>
            <td style="text-align: center;">
                <a href="/administrator/products/model_edite/<?=$rows->id?>" class="btn btn-mini btn-info">
                    <i class="icon icon-edit icon-white"></i>
                </a>
                <a href="/administrator/products/model_delete/<?=$rows->id?>" class="btn btn-mini btn-danger">
                    <i class="icon icon-remove icon-white"></i>
                </a>
            </td>
        </tr>
        <?}}?>
        <?}?>
    </tbody>
</table>