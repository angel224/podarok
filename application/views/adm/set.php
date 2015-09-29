<?=form_open ('adm/settings')?>

<table id ="tab_settings" border="0" width="650" align="left">

<tr>
<td align="right">Логин:</td>
<td>
<input type="text" name="admin_login" value="<?=set_value('admin_login',$this->config->item ('cms_admin_login'))?>">
</td>
</tr>

<tr>
<td align="right">Пароль:</td>
<td>
<input type="text" name="admin_pass" value="<?=set_value('admin_pass', $this->config->item ('cms_admin_pass'))?>">
</td>
</tr>

<tr>
<td align="right">Путь к фото:</td>
<td>
<input type="text" name="upload_path" value="<?=set_value('upload_path', $this->config->item ('upload_path'))?>">
</td>
</tr>

<tr>
<td align="right">Типы файлов разрешенные для загрузки:</td>
<td>
<input type="text" name="allowed_types" value="<?=set_value('allowed_types', $this->config->item ('allowed_types'))?>">
</td>
</tr>

<tr>
<td align="right">Максимальный размер фото в килобайтах:</td>
<td>
<input type="text" name="max_size" value="<?=set_value('max_size', $this->config->item('max_size'))?>">
</td>
</tr>

<tr>
<td align="right">Максимальныя ширина фото (пиксели):</td>
<td>
<input type="text" name="max_width" value="<?=set_value('max_width', $this->config->item ('max_width'))?>">
</td>
</tr>

<tr>
<td align="right">Максимальная высота фото в аикселях:</td>
<td>
<input type="text" name="max_height" value="<?=set_value('max_height', $this->config->item ('max_height'))?>">
</td>
</tr>

<tr>
<td align="right">Делать ли минимизацию (TRUE или FALSE):</td>
<td>
<input type="text" name="create_thumb" value="<?=set_value('create_thumb', $this->config->item ('create_thumb'))?>">
</td>
</tr>

<tr>
<td align="right">Сохранять ли пропорции фото (TRUE или FALSE):</td>
<td>
<input type="text" name="maintain_ratio" value="<?=set_value('maintain_ratio', $this->config->item ('maintain_ratio'))?>">
</td>
</tr>

<tr>
<td align="right">Ширина миниатюры:</td>
<td>
<input type="text" name="width" value="<?=set_value('width', $this->config->item ('width'))?>">
</td>
</tr>

<tr>
<td align="right">Высота миниатюры:</td>
<td>
<input type="text" name="height" value="<?=set_value('height', $this->config->item ('height'))?>">
</td>
</tr>

<tr>
<td align="right">Записей на страницу:</td>
<td>
<input type="text" name="per_page" size=6 value="<?=set_value('per_page',$this->config->item ('cms_per_page'))?>">
</td>
</tr>


<tr>
<td>&nbsp;</td>
<td>
<input type="submit" value="Сохранить">
</td>
</tr>

</table>

</form>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
