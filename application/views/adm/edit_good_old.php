<div id='edit'>
	<aside class="hidden">
		<ul>
			<?php  foreach ($razdel as $id_raz=>$raz){?>
				<li><?=$raz ?></li>
					<ul>
						<?php foreach ($kategori[$raz] as $id_kategor=>$kat){ ?>
							<li><?= $kat ?></li>
								<ul>
									<?php  foreach ($goods[$raz][$kat]['goods'] as $goods_id=>$good){ ?>
										<li><?= $good['name'] ?></li>
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
				echo ('<h2>Страница опубликована!</h2>'),'<h2>',anchor("","Не публиковать  страницу"),'</h2>';
				}else{
				echo ('<h2>Страница НЕ опубликована!</h2>'),'<h2>',anchor("","Опубликовать страницу"),'</h2>';;
				}						
			?>
			</p>
			<p>Имя товара:
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
			<input type="submit" name="edit" value="Редактировать" formaction="">
			Удалить???<input type="checkbox" name="del" value="Удалить????"> <input type="submit" name="delete" disabled value="Удалить!!!" formaction=""
 >
		</form>
	</article>
</div>