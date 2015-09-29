<div id='edit'>
	<aside class="hidden">
		<ul id="menu">
			<?php  foreach ($razdel as $id_raz=>$raz){?>
				<li class="razdel"><?php echo anchor("adm/edits/list_raz/$id_raz",$raz);?></li>
					<ul>
						<?php foreach ($kategori[$raz] as $id_kategor=>$kat){ ?>
							<li  class="kategor"><?php echo anchor("adm/edits/list_raz/$id_raz/$id_kategor",$kat);?></li>
								<ul>
									<?php  foreach ($goods[$raz][$kat]['goods'] as $goods_id=>$good){ ?>
										<li><? echo anchor("adm/edits/list_raz/$id_raz/$id_kategor/$goods_id",$good['name']); ?></li>
									<?php }?>
								</ul>
						<?php } ?>
					</ul>                          
			<?php } ?>
		</ul>  
  </aside>
	<article>
	<span id="radio">Показать меню </span>
		<form method="post" action="">
			<p><?php if ($edit["public"]==1){
				echo ('<h2>Страница опубликована!</h2>'),'<h2>',anchor("adm/edits/status_padge/0/".$edit['id_razdel']."/".$edit['id_kategori']."/".$edit['id_good'],"Не публиковать  страницу"),'</h2>';
				}else{
				echo ('<h2>Страница НЕ опубликована!</h2>'),'<h2>',anchor("adm/edits/status_padge/1/".$edit['id_razdel']."/".$edit['id_kategori']."/".$edit['id_good'],"Опубликовать страницу"),'</h2>';;
				}						
			?>
			</p>
			<p>Имя товара:
				<input type="hidden" name="id_razdel" value="<?= $edit['id_razdel']?>">
				<input type="hidden" name="id_kategori" value="<?= $edit['id_kategori']?>">
				<input type="hidden" name="id_good" value="<?= $edit['id_good']?>">
				<input type="text" name="name" value="<?= $edit['name']?>">
			</p>			
			<p>Титле товара:
				<input type="text" name="title_good" value="<?= $edit['title_good']?>">
			</p>
			<p>Маленькое фото товара:
				<input type="text" name="link2" value="<?= $edit['link2']?>">
			</p>
			<p>Краткое описание товара:
				<input type="text" name="description_good" value="<?=$edit['description_good'] ?>">
			</p>
			<p>Цена товара:
				<input type="text" name="cena" value="<?=$edit['cena'] ?>">
			</p>
			<?=show_tinymce ('text');?>
			<textarea id="text" name="text"><?=$edit['content'] ?> </textarea>
			<input type="submit" name="edit" value="Редактировать Товар" formaction="../../../edit_padge">
			Удалить???<input type="checkbox" name="del" value="Удалить????"> <input type="submit" name="delete" disabled value="Удалить!!!" formaction="../../../edit_padge"
 >
		</form>
	</article>
</div>