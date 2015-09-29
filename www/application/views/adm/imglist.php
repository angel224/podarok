<br /><br />
<h1>Работа с фото</h1>
<h3>Загрузить новое фото на сервер:</h3>
<?php echo $error;?>
<?php echo form_open_multipart('adm/imgs/imgnew');?>

<input type="file" id="files"  name="userfile" size="30"  />
<p>Напишите краткое описание картинки:</p>
<input class="img-text" type="text" name="title_img" value="Title"  />
<p>Текст для озвучивания:</p>
<input class="img-text" type="text"  name="alt_img"  value="Alt" />
<input type="submit" value="Загрузить фото" size="30"/>
</form>
<div class="output"> <output id="list"></output></div>
<br>
<h3>Список доступных изображений:</h3>
<table border="2" width="100%" align="left">
<tr>
<td align="right"width="10% >Название файла:</td>
<td align="right width="15%">Описание</td>
<td align="right" width="15%">Альты</td>
<td align="centr" width="35%" >Картинка</td>
<td align="right" width="13%" >Редактирование</td>
<td align="right" width="7%">Удаление</td>
</tr>

<?php foreach ($list as $img):?>
<?php if ($img=="smoll" or $img=="thumb"): ?>
<br>
<?php else: ?>
<tr>
<td>
<?php echo $img;?>
</td>
<td><input type="text" name="title_img" value="Title"  /></td>
<td><input type="text" name="alt_img" value="Alt"  /></td>
<td><?="<img".' src="'."../img/photo/$img".'" width="50px">' ?></td>
<td>
<input type="submit" value="Редактировать">
</td>
<td>
<?= anchor("adm/imgs/imgdel/$img",'Удалить');?> 
</td>
</tr>
<?php endif; ?>
<?php endforeach;?>