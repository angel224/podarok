<aside id="asi">
	<ul>
     	<?php foreach ($razdel as $id_razdel=>$raz){?>  
		<li><?php echo anchor("/vievs/levo/$id_razdel","<h2>$raz</h2>");?>
        	<ul>
				<?php foreach ($kategori[$raz] as $id_kategori=>$kat){
    			echo ('<li>'.anchor("/vievs/levo/$id_razdel/$id_kategori","<h3>$kat</h3>").'</li>'); 
	 				}?>   
			</ul>
        
        
        </li>
		   
		  <?php }?>                              
     </ul>
</aside>