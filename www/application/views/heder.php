<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="cp1251">
<meta name="language" content="ru">
<meta name='description' content="<?= $description ?>"/>
<meta name='keywords' content="<?=$key ?>"/>
<title><?= $title ?></title>
<meta content="text/html; charset=windows-1251" http-equiv="Content-Type">
<link href="/css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<header>
           <div id="heder">
               <div id="logo">
                   <h1></h1> 
                   <h1></h1>
                   <h1></h1>
               </div>
               <nav id="menu">
                   <ul>
                      <li><?=anchor('/vievs/index/1','�������')?></li>
                      <li><?=anchor('/vievs/index/2','�������� � ������')?></li>
                      <li><?=anchor('/vievs/index/3','���������� ������')?></li>
                      <li><?=anchor('/vievs/index/4','��������')?></li>
                   </ul>
                </nav>
           </div>
       </header>