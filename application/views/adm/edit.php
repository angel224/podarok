<div id='edit'>
	<aside>
		<ul id="menu">
			<?php  foreach ($razdel as $id_raz=>$raz){?>
				<li class="razdel" ><?php echo anchor("adm/edits/list_raz/$id_raz",$raz);?></li>
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
		<?php if(isset($edit)){ echo '<h1>',$edit,'<h1>';} ?>
		<h2>Выбирите в меню с лева страницу, над которой будем проводить ужастные магические манипуляции.Не забывайте , что каждые 15 минут необходимо отрываться от монитора и думать о Вечном.Также каждый час необходимо выходить на перрекур для разминки ног и глаз.Разомните руки ибо пасы над клавиатурой реально напрягают. :)</h2>
	</article>
</div>