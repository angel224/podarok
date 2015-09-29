<article>
	<?if (!empty($msg)){ ?>
	<section>
		<h2><?=$msg ?></h2>
	</section>
	<?} ?>
	<section id="ViborPliTabl">
		<h2>Настройка полей таблицы таблицы <input type='checkbox' value="Настройка" name="but_tabl" </input></p></h2>
		<p>Поле: Имя клиета
		<input type='checkbox' value="Имя клиета" name="but_klient" checked="checked"</input></p>
		<p>Поле: Телефон
		<input type='checkbox' value="Телефон" name="but_telephone" checked="checked"</input>
		</p>
		<p>Поле: Почта
		<input type='checkbox' value="Почта" name="but_email"</input>
		</p>
		<p>Поле: Дата
		<input type='checkbox' value="Дата" name="but_timex" checked="checked"</input>
		</p>
		<p>Поле: Дставка
		<input type='checkbox' value="Доставка" name="but_dostavka" checked="checked"</input>
		</p>
		<p>Поле: Почтальон
		<input type='checkbox' value="Почтальон" name="but_pochta" </input>
		</p>
		<p>Поле:Адресс доставки
		<input type='checkbox' value="Адресс доставки" name="but_adress"</input>
		</p>
		<p>Поле: Название товара
		<input type='checkbox' value="Название товара" name="but_name" checked="checked"</input>
		</p>
		<p>Поле: Количество товара
		<input type='checkbox' value="Количество товара" name="but_quantity" checked="checked"</input>
		</p>
		<p>Поле: Цена
		<input type='checkbox' value="Цена" name="but_price"</input>
		</p>
		<p>Поле: Примечания
		<input type='checkbox' value="Примечания" name="but_prim" checked="checked"</input>
		</p>
		<p>Поле: Редактировать прим.
		<input type='checkbox' value="Редактировать прим." name="but_red" checked="checked"</input>
		</p>
		<p>Поле: Показать историю
		<input type='checkbox' value="История" name="but_red" checked="checked"</input>
		</p>
		<p>Поле: Удалить заказ
		<input type='checkbox' value="Удалить заказ" name="but_del" checked="checked"</input>
		</p>
	</section>
	<section>
		<h2>У вас есть следующие заказы:</h2>
			<table id="orderTab">
				<tr class="order" >
					<th class="order" >Имя клиета</th>
					<th class="order" >Телефон</th>
					<th class="order" >Почта</th>
					<th class="order">Дата</th>
					<th class="order">Доставка</th>
					<th class="order">Почтальон</th>
					<th class="order">Адресс доставки</th>
					<th class="order">Название товара</th>
					<th class="order">Количество товара</th>
					<th class="order">Цена</th>
					<th class="order">Примечания</th>
					<th class="order">Редактировать прим.</th>
					<th class="order"> История</th>
					<th class="order">Удалить заказ</th>
				</tr>
			<?php foreach ($order as $str=>$val){ ?>
				<tr><?if(isset($val["klient"])){//если нет в массиве имени клиета, значит это массив товаров.
						$name=$val["klient"]; //Переменная $name -это название массива с товарами для этого клиента ?>
					<td class="order" data="Имя клиета"><?= $val["klient"];?></td>
					<td class="order" data="Телефон"><?= $val["telephone"]; ?></td>
					<td class="order" data="Почта"><?= $val["email"]; ?></td>
					<td class="order" data="Дата"><?= date("d.m.y",$val["timex"]); ?></td>
					<td class="order" data="Доставка"><?= $val["dostavka"]; ?></td>
					<td class="order" data="Почтальон"><?= $val["pochta"]; ?></td>
					<td class="order" data="Адресс доставки" ><?="Город-".$val["citi"]." Улица- ".$val["strit"]." Дом -".$val["dom"]." квартира -".$val["kv"]." индекс-".$val["indeks"]. " склад-".$val["depot"];?></td>
					
			<? 	if(count($order["$name"])>2){ //если в массиве c товарами больше двух записей, то товаров заказанно несколько 
				$i=1;//переменна для вывода товаров если их несколько в одом ордере ?>
				<td class="order" data="Название товара">
						<? foreach (array_reverse($order["$name"]) as $num=>$value){
						if($num!=="id_good".$i){ continue; }else{?>
						<p><?= $value; ?></p>
						<? $i++; } ?>
					<? } ?>
				</td>
				<td class="order" data="Количество товара">
					<?$a=1; foreach (array_reverse($order["$name"]) as $num=>$value){ 
					  if($num!=="quantity".$a){ continue; }else{?>
					  <p><?=$value; ?></p>
					  <?$a++; } ?>
					<? } 
					}else{ ?>
					<td class="order" data="Название товара"><?= $order["$name"]["id_good1"]; ?></td>
					<td class="order" data="Количество товара"><?= $order["$name"]["quantity1"]; ?></td>
					<? } ?>
					<td class="order" data="Цена"><?= $val["cena"]; ?></td>
				<form method="post">

					<td class="order" data="Примечания"><input type='text'   name="prim"></input></td>
					<td class="order" data="Редактировать прим." ><input type='submit' value="Редактировать" name="regprim" formaction='./../edit_order/<?=$val['id_sessions'] ?>'></input></td>
					<td class="order" data="История" ><input type='button' id="btn<?=$str?>" value="История" name="reg_histori" data='<?=$val['id_sessions']?>'></input></td>
					<td class="order" data="Удалить заказ" ><input type='submit' value="Удалить" name="del_order" formaction='./../del_order/<?=$val['id_sessions'] ?>'></input>
				</td
					<input type='hidden' value="<?=$val['id_sessions'] ?>"  name="id_sessions"></input>
				</form>
				</tr>
				<? } // Конец проверки if(isset($val["klient"]))?>
			<?php }// Конец основного цикла ?>
			</table>
	
	</section>
</article>
<article>
 <h2>История общения:</h2>
 <section id="stori">
 </section>
</article>