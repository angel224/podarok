
<?if(isset($good)){?>
<form action="<?=base_url()."baskets/addorder"?>" method="post">
	<fieldset>
		<legend>У вас в корзине следующие товары:</legend>
		<table id="basket">
			<tr>
				<th>Вид подарка</th>
				<th>Название подарка</th>
				<th>Колиество штук</th>
				<th>Цена за штуку(грн.)</th>
				<th>Всего грн.</th>
			</tr>
		<?
		$cena=0;
		foreach ($good as $key=>$val){
			
		?>
			<tr>
				<td><image src="<?=$val['link2']?>"></image></td>
				<td><?=$val['name'];?>
				<input type='hidden' value="<?=$val['id'];?>"  name="id_good<?=$key ?>"></input>
				</td>
				<td>
				<input type='number' value="<?=$val['quantity'];?>" pattern="\d [0-9]" name="quantity<?=$key ?>"></input>
				</td>
				<td><?=$val['cena']?></td>
				<td><?=$val['cena']*$val['quantity'];?></td>

			</tr>
		<? $cena+=$val['cena']*$val['quantity'];
		}?></table>
<p class="cena">Итого цена без доставки:<?=$cena ?></p>
<input type='hidden' value="<?=$caunt?>"  name="caunt"></input>
<input type='hidden' value="<?=$cena ?>"  name="cena"></input>
<? }?>
	</fieldset>
	<fieldset>
		<legend>Заполите форму для связи с Вами:</legend>
		<? if(!empty($klient)){ //если форму заполняли?>
		<table id="order">
			<tr> </tr>
			<tr>
				<td>Введите ваше имя:</td>
				<td style="width:70%"><input type='text' value="<?=$klient["klient"] ?>" pattern="^[A-Za-zА-Яа-яЁё\s]+$" required name="klient"></input></td>
			</tr>
			<tr>
				<td> телефон для связи:</td>
				<td><input type='tel' value="<?= $klient['telephone'];?>" name="telephone" required ></input></td>
			</tr>
			<tr>
				<td> email:</td>
				<td><input type='email' value="<?=$klient['email'];?>"  name="email" required ></input><td>
			</tr>
			<tr>
				<td> на когда Вам необходим подарок:</td>
				<td><input type='date' value="<?=$klient['timex'] ?>" name="timex" required ></input><td>
			</tr>
		</table>
	</fieldset>
	<?if(!empty($klient['dostavka']) ){ //Если была заполненна доставка ранее ?>
	<fieldset>
			<legend>Доставка</legend>
					<p>Нужна лли Вам <a href="">доставка</a>:
					<input type='checkbox' value="Доставка нужна"  name="dostavka"></input>
					<select name="pochta" disabled>
						<option>--||--</option>
						<option>Укрпочтой</option>
						<option>Новой Почтой</option>
						<option>Деливери</option>
					</select>
					<p class="hidden">Введите город:</p>
						<input type='text' value="<?=$klient['citi']; ?>"  name="citi" disabled></input>
						<p class="hidden1">Введите улицу:</p>
						<input type='text' value="<?=$klient['strit'];?>"  name="strit" disabled></input>
						<p class="hidden1">Введите номер дома:</p>
						<input type='text' value="<?=$klient['dom'];?>"  name="dom" disabled></input>
						<p class="hidden1">Введите номер квартиры:</p>
						<input type='text' value="<?=$klient['kv'];?>" pattern="[0-9]{1,4}" disabled name="kv" ></input>
						<p class="hidden1">Введите индекс:</p>
						<input type='text' value="<?=$klient['indeks'];?>" pattern="[0-9]{5,6}" disabled name="indeks" ></input>
						<p class="hidden" id="depot"> Введите склад:</p>
						<input type='text' value="<?=$klient['depot'];?>" pattern="[0-9]{0,3}" disabled name="depot" ></input>
			</p>
	</fieldset>
	
	
	<?}else{ //  Если была форма, но не было заполнена доставка?> 
	<fieldset>
		<legend>Доставка</legend>
			<p>Нужна лли Вам <a href="">доставка</a>:
					<input type='checkbox' value="Доставка нужна"  name="dostavka"></input>
					<select name="pochta" disabled>
						<option>--||--</option>
						<option>Укрпочтой</option>
						<option>Новой Почтой</option>
						<option>Деливери</option>
					</select>
					<p class="hidden">Введите город:</p>
						<input type='text' value="<?php echo set_value('citi')?>"  name="citi" disabled></input>
						<p class="hidden1">Введите улицу:</p>
						<input type='text' value="<?php echo set_value('strit');?>"  name="strit" disabled></input>
						<p class="hidden1">Введите номер дома:</p>
						<input type='text' value="<?php echo set_value('dom');?>"  name="dom" disabled></input>
						<p class="hidden1">Введите номер квартиры:</p>
						<input type='text' value="<?php echo set_value('kv');?>" pattern="[0-9]{1,4}" disabled name="kv" ></input>
						<p class="hidden1">Введите индекс:</p>
						<input type='text' value="<?php echo set_value('indeks');?>" pattern="[0-9]{5,6}" disabled name="indeks" ></input>
						<p class="hidden" id="depot"> Введите склад:</p>
						<input type='text' value="<?php echo set_value('depot');?>" pattern="[0-9]{0,3}" disabled name="depot" ></input>
			</p>
	</fieldset>
	<? } ?>
		<? if(!empty($erorr_kapcha)){
	echo ("<h1>$erorr_kapcha</h1>");
	}?>
	<img src='../get_captcha' />
	<input type='text' value="Впишите буквы на картинке" pattern="[A-Za-z]{5,3}" name="answer1"></input>
	<input class="submit" type='submit' value="Заказать" name="order"></input>
	
	
	
	
	
	<? }else{ // если форму не заполяли ?> 
	
	
	<table id="order">
			<tr> </tr>
			<tr>
				<td>Введите ваше имя:</td>
				<td style="width:70%"><input type='text' value="<?php echo  set_value('klient') ?>" pattern="^[A-Za-zА-Яа-яЁё\s]+$" required name="klient"></input></td>
			</tr>
			<tr>
				<td> телефон для связи:</td>
				<td><input type='tel' value="<?php echo set_value('telephone');?>" name="telephone" required ></input></td>
			</tr>
			<tr>
				<td> email:</td>
				<td><input type='email' value="<?php echo set_value('email');?>"  name="email" required ></input><td>
			</tr>
			<tr>
				<td> на когда Вам необходим подарок:</td>
				<td><input type='date' value="" name="timex" required ></input><td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Доставка</legend>
			<p>Нужна лли Вам <a href="">доставка</a>:
					<input type='checkbox' value="Доставка нужна"  name="dostavka"></input>
					<select name="pochta" disabled>
						<option>--||--</option>
						<option>Укрпочтой</option>
						<option>Новой Почтой</option>
						<option>Деливери</option>
					</select>
					<p class="hidden">Введите город:</p>
						<input type='text' value="<?php echo set_value('citi')?>"  name="citi" disabled></input>
						<p class="hidden1">Введите улицу:</p>
						<input type='text' value="<?php echo set_value('strit');?>"  name="strit" disabled></input>
						<p class="hidden1">Введите номер дома:</p>
						<input type='text' value="<?php echo set_value('dom');?>"  name="dom" disabled></input>
						<p class="hidden1">Введите номер квартиры:</p>
						<input type='text' value="<?php echo set_value('kv');?>" pattern="[0-9]{1,4}" disabled name="kv" ></input>
						<p class="hidden1">Введите индекс:</p>
						<input type='text' value="<?php echo set_value('indeks');?>" pattern="[0-9]{5,6}" disabled name="indeks" ></input>
						<p class="hidden" id="depot"> Введите склад:</p>
						<input type='text' value="<?php echo set_value('depot');?>" pattern="[0-9]{0,3}" disabled name="depot" ></input>
			</p>
	</fieldset>
	<? if(!empty($erorr_kapcha)){
	echo ("<h1>$erorr_kapcha</h1>");
	}?>
	<img src='../get_captcha' />
	<input type='text' value="Впишите буквы на картинке" pattern="[A-Za-z]{5,3}" name="answer1"></input>
	<input class="submit" type='submit' value="Заказать" name="order"></input>
	<?} ?>
</form>