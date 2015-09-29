$(document).ready(function() {
var adress = $('[disabled]');
$('[disabled], .hidden, .hidden1 ').hide();
var pochta = $( "select" );

// Выбор доставки и почты
$("input[type=checkbox]").change(function () {
	var s =$("input:checked").length;
	if (s>0){
		pochta.show().removeAttr("disabled");
	}else if(s==0){
		//alert(s);
		pochta.hide();
	}
});

// Выбор адресса доставки
$(pochta).change(function () {
	var my_select = $("select option:selected").html();
	if( my_select== "Укрпочтой"){
			$('.hidden1').show();
			$('.hidden').show();
			$("#depot").hide();
			$(adress).show().removeAttr("disabled");
			$('[name=depot]').hide();
	}else{
			$('.hidden1').hide();
			$(adress).hide().attr("disabled");
			$('.hidden').show();
			$('[name=depot],[name=citi]').show().removeAttr("disabled");
	}
});
 
 // Отчищает поле для введения ответа
 $("[name^=answe]").focus(function () {
	$(this).val("");
 });







});