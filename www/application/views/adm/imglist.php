<br /><br />
<h1>������ � ����</h1>
<h3>��������� ����� ���� �� ������:</h3>
<?php echo $error;?>
<?php echo form_open_multipart('adm/imgs/imgnew');?>

<input type="file" id="files"  name="userfile" size="30"  />
<p>�������� ������� �������� ��������:</p>
<input class="img-text" type="text" name="title_img" value="Title"  />
<p>����� ��� �����������:</p>
<input class="img-text" type="text"  name="alt_img"  value="Alt" />
<input type="submit" value="��������� ����" size="30"/>
</form>
<div class="output"> <output id="list"></output></div>
<br>
<h3>������ ��������� �����������:</h3>
<table border="2" width="100%" align="left">
<tr>
<td align="right"width="10% >�������� �����:</td>
<td align="right width="15%">��������</td>
<td align="right" width="15%">�����</td>
<td align="centr" width="35%" >��������</td>
<td align="right" width="13%" >��������������</td>
<td align="right" width="7%">��������</td>
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
<input type="submit" value="�������������">
</td>
<td>
<?= anchor("adm/imgs/imgdel/$img",'�������');?> 
</td>
</tr>
<?php endif; ?>
<?php endforeach;?>