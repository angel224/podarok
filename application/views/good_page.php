<article id="art">
	<div>
	<h2>У Вас в корзине:<?=$basket ?> товаров. <h2>
	</div>
	<div>
    	<h1><?=$name; ?></h1>
    </div>
	<div id="content">
    <?=$text;?>
    </div>
    <div>
    	<h3>Цена: <?=$cena; ?></h3>
    </div>
	 <div>
	 <? if(!empty($erorr_kapcha)){ ?>
			<span><?=$erorr_kapcha; ?> </span>
				<? } ?>
		<form action=<?= base_url()."baskets/addbasket" ?> method="post">
			<input type='number' value="Количество" pattern="\d [0-9]" name="quantity"></input>
			
			<img src='<?= base_url()."vievs/get_captcha" ?>' />
			<input type='text' value="Впишите буквы на картинке" pattern="[A-Za-z]{5,3}" name="answer"></input>
			<input type='hidden' value="<?=$id_good ?>"  name="id_good"></input>
			<input type='hidden' value="<?=$cena ?>"  name="cena"></input>
			<input type='hidden' value="<?=$link2 ?>"  name="link2"></input>
			<input type='hidden' value="<?=$name ?>"  name="name"></input>
			<input type='submit' value="Положить в корзину" ></input>
		</form>
    </div>
    
</article>