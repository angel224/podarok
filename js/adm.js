// JavaScript Document
$(document).ready(function() { 
 //________	Скрипты для страницы добавления страниц___________________		   
// Скрипт для селектов в страничке добавления траниц						   
$('#vibor2,#vibor3,#vibor4,#vibor5').hide();

var myselect;
/*alert(myselect);*/
$('#s1').change(function () { 
	var myselect = $('#s1 option:selected').val();
	if(myselect==3){
	$('#vibor2,#vibor5,textarea').show();
	}else if(myselect==2){
		$('#vibor2').show();
		$('#vibor3,#cena,#dostavka,#text,textarea').hide();
		$('#namePage').text('Введите имя категории');
		$('#nameAdd').attr('name','kategori');
		$('#titleAdd').attr('name','title_kategori');
		$('#descriptionAdd').attr('name','description_kategori');
		$('#keyAdd').attr('name','key_kategori');
		$("textarea").attr( "id",'text1');//не работает. Надо подумать как заделать
		}else if(myselect==1){
		$('#vibor2,#cena,#dostavka,#vibor3').hide();
		$('#namePage').text('Введите имя раздела');
		$('#nameAdd').attr('name','razdel');
		$('#titleAdd').attr('name','title');
		$('#descriptionAdd').attr('name','description');
		$('#keyAdd').attr('name','key');
	}
	});

$('#s2').change(function () { 
		if( $('#s1 option:selected').val()== 3){
			var id_razdel=$('#s2 option:selected').attr('id');
			var data1='id_razdel='+id_razdel;
			$.ajax({
			  type: "POST",
			  url: "http://test7.net.loc/adm/adds/ajax",
			  data: data1,
			  dataType: "html",
			  success: function(msg){
				  $('#vibor3').html(msg);
				  $('#vibor3').show();
					$('#s3').show();
				 }
		
			});
		} else {
			return;
		}
	});


/* $('#s1').change(function () { 
	if(myselect==3){
	$('#vibor5').show();
	}
	}); */

//$( "#menu" ).menu();
 //________	Конец скриптов для страницы добавления страниц___________________	


 //________	Скрипты для страницы редактирования и удаления страниц___________________	
 
//Скрипт выводит и убирает меню выбора страниц слева
$('span').click( function () {
	var span = $(this).text();
	if ( span =="Скрыть меню"){
		$(this).text('Показать меню');	
	}else{
		$(this).text('Скрыть меню');
		}
	$('aside').toggleClass('hidden');
	}); 



//Скрипт активации функции удаления страниц
$('[name= del]').change(function(){
	if(this.checked ){
		if(confirm("Вы включили удаление страницы.Убедитесь,если это раздел или категория, что они пустые.Может быть сперва просто убрать страницу с сайта для пользователей.Вы уверены что хотите удалить это??? Если передумаете удалять жмите кнопку отмены, если потом передумаете то снимите флажек ,который вы поставили перед тем как увидили это окошко")){
		$('[name= delete]').removeAttr("disabled");
		$('[name= edit]').attr('disabled',"disabled");
		}
		return;
	}else{
	alert('Фух,как страшно удалять.Пусть себе лежит...-оно каши не просит.');
	$('[name= delete]').attr('disabled',"disabled");
	$('[name= edit]').removeAttr('disabled');	
	}
});	

// ____________Скрипты для страницы статистики______________________
  
  var viborpoli = $('#ViborPliTabl p');
  $(viborpoli).hide();
  $('#stori').hide();
 
  $('[name= but_tabl]').change(function(){
	if(this.checked ){
	$(viborpoli).show();
	}else{
	$(viborpoli).hide();	
	}
  });	
   
 function viborTable() {
var viborTh =$("#orderTab th,#orderTab td");
  $(viborTh).hide();
  var poliInput =$('article section p input:checked');
   jQuery.each (poliInput, function() {
	var Thebaible="th:contains('"+  $(this).val() + "')";
	var Tdebaible="td[data='"+  $(this).val() + "']";
	   $(Thebaible).show();
		$(Tdebaible).show();
  });
 }
 viborTable(); 
 $('article section p input').change(function (){ 
 viborTable();
 });	

 
 $('[id  ^=btn]').click( function() {
		var id = $(this).attr('data');
		$.ajax({
			  type: "Get",
			  url: "http://test7.net.loc/adm/orders/get_stori/"+id,
			  data: id,
			  dataType: "html",
			  success: function(msg1){
				  $('#stori').html(msg1);
				  $('#stori').show();
				}
		
			});
		
	 });

  
  




// ____________Скрипты для страницы загрузки файлов______________________
// —крипт дл¤ библитотеки картинок (cfv yt gbcfk)

function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img style=" height: 80px;border: 1px solid #000;margin: 10px 5px 0 0;" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
  
  

});