var open_form = 0;
var open_form2 = 0;
var open_form3 = 0;
$(document).ready(function(){
	//Авторизация
	$('#auth').click(function(){
		open_form = 1;
		if($('.form_reg').css('right') == "15px"){
			$('.form_reg').animate({
				right: "-320px",
			}, 500);
			open_form2 = 0;
		}
		if($('.form_backup').css('right') == "15px"){
			$('.form_backup').animate({
				right: "-320px",
			}, 500);
			open_form3 = 0;
		}
		if(!open_form2 && !open_form3 && $('.form_auth').css('right') == '-320px'){
			$('.form_auth').animate({
				right: "15px",
			}, 500);
		}
	});
	//Регистрация
	$('#reg').click(function(){
		open_form2 = 1;
		if($('.form_auth').css('right') == "15px"){
			$('.form_auth').animate({
				right: "-320px",
			}, 500);
			open_form = 0;
		}
		if($('.form_backup').css('right') == "15px"){
			$('.form_backup').animate({
				right: "-320px",
			}, 500);
			open_form3 = 0;
		}
		if(!open_form && !open_form3 && $('.form_reg').css('right') == '-320px'){
			$('.form_reg').animate({
				right: "15px",
			}, 500);
		}
	});
	//Восстановление пароля
	$('#backup_psw').click(function(){
		$('.form_auth').animate({
			right: "-320px",
		}, 500, function(){
			open_form = 0;
			open_form2 = 0;
		});
	});
	//Закрытие форм
	$('.form_close').click(function(){
		open_form = 0;
		open_form2 = 0;
		open_form3 = 0;
		$('.form_auth, .form_reg, .form_backup').animate({
			right: "-320px",
		}, 500);
	});
});