<br /><br />
<div> 
<P style="font-size: 3em">Фото успешно загруженно на сервер</P>
<ul >
<?php foreach($upload_data['upload_data'] as $item => $value):?>
<li ><span style="color: red"><?php echo $item;?></span>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul> </div> 
<p style="font-size: 3em"><?php echo anchor('/admin/img', 'Загрузить еще?'); ?></p>
