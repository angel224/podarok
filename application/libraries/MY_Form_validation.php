<?php

/**
 * Описание файла: Расширение класса валидации форм
 *
 * @изменён 13.4.2009
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_form_validation {
	
	/**
 	* Вызов родительского класса 
 	*/
    function __construct(){
		$CI = &get_instance ();
        parent::__construct();
	
	//Загружаем новый языковый файл
        $CI->lang->load ('validation_new');

    }

    /**
    * Функция проверки на наличие маленьких букв и цифр
    */ 
    function az_numeric($str) {
        return ( ! preg_match("/^([a-z0-9])+$/i", $str)) ? FALSE : TRUE;
    }  
	
    /**
    * Функция проверки на наличие telephona
    */
	 function tel($str) {
        return ( ! preg_match("/^(\+?\d+)?\s*(\(\d+\))?[\s-]*([\d-]*)$/", $str)) ? FALSE : TRUE;
    } 
	
	 /**
    * Функция проверки на наличие букв с пробелами кирилицей и латинскими.
    */
	 function mystring($str) {
        return ( ! preg_match("/^[A-Za-zА-Яа-яЁё\s]+$/", $str)) ? FALSE : TRUE;
    }  		
	
    /**
    * Валидация url
    function valid_url ($str) {
        return (!preg_match('/^(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:;.?+=&%@!\-\/]))?$/',$str)) ? FALSE : TRUE;
    }
        */ 

	/**
	 * Валидное название
	 */ 
    function valid_title ($str)
    {
     return (!preg_match ('/^[А-Яа-яЁё\w\d\s\.\,\+\-\_\!\?\#\%\@\№\/\(\)\[\]\:\&\$\*]{1,250}$/'
                    ,$str)) ? FALSE : TRUE;
    }       
	
	/**
	 * Проверка на уникальность
	 */
    function uniq ($str, $param) {
        //Объект CI
        $CI = & get_instance ();
        //Имя таблицы
        $tname = str_replace ('_id','s',$param);
        
        $CI->db->where ($param,$str);                     
        return ($CI->db->count_all_results($tname)==0);
    }           	  	
	
}
