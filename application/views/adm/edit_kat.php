<div id='edit'>
	<aside class="hidden">
		<ul id="menu">
			<?php  foreach ($razdel as $id_raz=>$raz){?>
				<li class="razdel"><?php echo anchor("adm/edits/list_raz/$id_raz",$raz);?></li>
					<ul>
						<?php foreach ($kategori[$raz] as $id_kategor=>$kat){ ?>
							<li class="kategor"><?php echo anchor("adm/edits/list_raz/$id_raz/$id_kategor",$kat);?></li>
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
		<form method="post">
			<p><?php if ($edit["public"]==1){
				echo ('<h2>Страница опубликована!</h2>'),'<h2>',anchor("adm/edits/status_padge/0/".$edit['id_razdel']."/".$edit['id_kategori'],"Не публиковать  страницу"),'</h2>';
				}else{
				echo ('<h2>Страница НЕ опубликована!</h2>'),'<h2>',anchor("adm/edits/status_padge/1/".$edit['id_razdel']."/".$edit['id_kategori'],"Опубликовать страницу"),'</h2>';;
				}						
			?>
			</p>
			<p>Название категории:
				<input type="hidden" name="id_razdel" value="<?= $edit['id_razdel']?>">
				<input type="hidden" name="id_kategori" value="<?= $edit['id_kategori']?>">
				<input type="text" name="kategori" value="<?= $edit['kategori']?>">
			</p>			
			<p>Титле категории:
				<input type="text" name="title_kategori" value="<?= $edit['title_kategori']?>">
			</p>
			<p>Ключевые слова в категории (через запятую):
				<input type="text" name="key_kategori" value="<?= $edit['key_kategori']?>">
			</p>
			<?=show_tinymce ('text');?>
			<textarea id="text" name="description_kategori"><?=$edit['content'] ?> </textarea>
			<input type="submit" name="edit" value="Редактировать Категорию" formaction="../../edit_padge">
			Удалить???<input type="checkbox" name="del" value="Удалить????"> <input type="submit" name="delete" disabled value="Удалить!!!" formaction="../../edit_padge"
 >
		</form>
	</article>
</div>