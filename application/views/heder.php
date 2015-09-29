<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="language" content="ru">
<meta name='description' content="<?= $description ?>"/>
<meta name='keywords' content="<?=$key ?>"/>
<title><?= $title ?></title>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
<link href="/css/main.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/js/client.js"></script>
</head>
<body>
	<header>
    	<div id="heder">
                <nav id="menu1">
                 	<ul>
                    	<li><?=anchor('/vievs/index/1','Главная')?></li>
                      	<li><?=anchor('/vievs/index/2','Доставка и Оплата')?></li>
                      	<li><?=anchor('/vievs/index/3','Оформление заказа')?></li>
                      	<li><?=anchor('/vievs/index/4','Контакты')?></li>
                   </ul>
                </nav>
         </div>
     </header>
	 <div id="body">
	 