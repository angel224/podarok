<article><div>
<?=show_tinymce ('text');?>
<?=form_open ('adm/adds/add'); ?><br/><br/>
	<table border="1" width="1000" align="left" cellspacing="4">
		<tr id="vibor1">
			<td align="right">
			<b>Добавить:</b>
			</td>
			<td align="left">
				<select id="s1" name="select1" >
  					<option value="0" >{Выбирите}</option>
                    <option value="1" >Раздел</option>
                    <option value="2" >Категорию</option>
                    <option value="3">Страницу</option>
                </select>
			</td>
        </tr>
		<tr id="vibor2">
			<td align="right">
				<b>В раздел:</b>
			</td>
			<td align="left">
				<select id="s2" name="select2"  >
    				<option>{Выбирите}</option>
   					 <?php foreach ($razdel as $id_razdel=>$raz):?>
  					<?='<option '.'id='.'"'.$id_razdel.'">'.$raz.'</option>'?>
  					<?php endforeach; ?>
   				</select>
			</td>
		</tr>
		<tr id="vibor3">
		</tr>
		<tr id="vibor4" >
			<td align="right">
			<b>Название для ссылки:</b>
			</td>
			<td align="left">
				<select>
  					<option>{Выбирите}</option>
  					<option>Пункт 2</option>
  				</select>
			</td>
		</tr>
		<tr>
			<td align="right">
			<b id="namePage">Введите имя товара:</b>
            <b class='error' ><?php echo form_error('name'); ?></b>
			</td>
            <td align="left">
            <input id="nameAdd" type="text" name="name" value="<?=set_value ('name','введите имя')?> ">
			</td>
        </tr>
        <tr id="vibor5" >
	      	<td>
			<b>Выбирите маленькую картинку обозначающию товар:</b>
           </td>
           <td>
           		<select name="link2">
  					<option>{Выбирите}</option>
  					 <?php foreach ($img as $path):?>
  					<?='<option>'.$path.'</option>'?>
  					<?php endforeach; ?>
  				</select>
			</td>
        </tr>
        <tr>
	      	<td>
			<b>Введите Title страницы</b>
           </td>
           <td>
           		<input id="titleAdd" type="text" name="title_good" value="Title <?php echo form_error('title_good'); ?>">
			</td>
        </tr>
        <tr>        	
  	      <td>
			<b>Введите краткое описание страницы</b>
           </td>
           <td>
           
				<input id="descriptionAdd"  type="text" name="description_good" value="description <?php echo form_error('description_good'); ?>">
			</td>
        </tr>
		<tr>        	
  	      <td>
			<b>Введите ключевые слова страницы через запятую</b>
           </td>
           <td>
           
				<input id="keyAdd" type="text" name="key" value="введите, ключевые, слова <?php echo form_error('key_good'); ?>">
			</td>
        </tr>
        <tr id="cena">        	
  	      <td>
			<b>Введите цену:</b>
           </td>
           <td>
           		<input type="text" name="cena" value="100.00">
			</td>
        </tr>
        <tr id="dostavka">        	
  	      <td>
			<b>Доставка</b>
           </td>
           <td>
				<input type="checkbox" name="dostavka" checked >
			</td>
        </tr>
		
		<tr>
			<td align="right">&nbsp;
			</td>
			<td align="left">
			</td>
		</tr>
        <tr >        	
  	      <td>
			<b>Публиковать?</b>
           </td>
           <td>
				<input type="checkbox" name="public" checked >
			</td>
        </tr>
		<tr>
			<td align="right">&nbsp;
			</td>
			<td align="left">
			</td>
		</tr>
	</table>
	<div id='tinymce'><?=show_tinymce ('text');?></div>
	<textarea id="text" name="text"> </textarea>
    <input type="submit" value="Добавить">
</form>
</div>
</article>