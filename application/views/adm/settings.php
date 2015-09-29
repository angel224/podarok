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
