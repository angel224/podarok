<article id="art">
	<div>
    	<h1>Внимание!!! Внимание!!</h1>
        <p>Все представленные работы индивидуальны и соответственно цены весьма приблизительны.Цены во многом зависят от цены материала для изготовления подарка. Цены даны для того чтоб приблизительно понимать цену подарка.И может существенно отличаться. </p>
    </div>
	
    <div>
    	<h3><?php echo $description ?></h3>
    </div>
    
    <div id="content">
    <? foreach ($goods as $good){ 
	$img='<img src='. $good['img'].' alt="альтернативный текст" hspace="5px" vspace="5px">';
    echo anchor("vievs/show_good/".$good['id_good'],$img);?> 
        <h3><?= $good['name']?> </h3>
        <p><?=$good['description_good'] ?></p>
        <p>Тут цена</p>
        <?php }?>
   	</div>
</article>