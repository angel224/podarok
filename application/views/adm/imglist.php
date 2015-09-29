<br /><br />
<h1>Работа с фото</h1>
<h3>Загрузить новое фото на сервер:</h3>
<?php if(!empty ($error))echo($error);?>
<?php echo form_open_multipart('adm/imgs/imgnew');?>

<input type="file" id="files"  name="userfile" size="30"  />
<p>Напишите краткое описание картинки:</p>
<input class="img-text" type="text" name="title_img" value="title"  />
<p>Текст для озвучивания:</p>
<input class="img-text" type="text"  name="alt_img"  value="alt" />
<input class="submit" type="submit"  name="submit"  value="Load" />
</form>
<div class="output"> <output id="list"></output></div>
<br>
<h3>Список доступных изображений:</h3>
<table border="2" width="100%" align="left">
<tr>
<td align="right"width="15% border="2" >Название файла:</td>
<td align="right width="20%">Описание</td>
<td align="right" width="20%">Альты</td>
<td align="centr" width="20%" >Картинка</td>
<td align="right" width="13%" >Редактирование</td>
<td align="right" width="7%">Удаление</td>
</tr>
<tr>
<?php 
$caunt=0;
$res='img'.$caunt;
for($caunt;is_array(${$res});$caunt++){
$res='img'.$caunt;
if (empty(${$res}['name']))break; 
$name_img=${$res}['name']
 ?>
<?php echo form_open("adm/imgs/imgedit/".${$res}['name']);?>
<? if(!empty ($img0)){ ?>
<td>
<?php echo ${$res}['name']; ?>
</td>
<td><input type="text" name="title_img" value="<?=${$res}['title_img']?>"  /></td>
<td><input type="text" name="alt_img" value="<?=${$res}['alt_img']?>"  /></td>
<td><?="<img".' src="'.${$res}['url_img'].'"/>' ?></td>
<!--<td></td>-->
<td>
<input type="submit" value="Редактировать"> 
</td>
<td>
<?= anchor("adm/imgs/imgdel/".${$res}['name'],'Удалить');?> 
</td>
</tr>
</form>
<?php 
}else{ echo ("<h1>Картинок на сайте не обнаруженно</h1>");}} ?>
