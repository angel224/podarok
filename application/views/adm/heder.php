<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="language" content="ru">
<title><?= $title ?></title>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
 <link href="/css/admin.css" rel="stylesheet" type="text/css"/>
 
<!--<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="/css/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
<link href="/css/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>-->

<script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript" src="/js/adm.js"></script>

</head>
<body>
	<header>
           <div id="heder">
              <nav id="menu1">
                   <ul>
                      <li><?=anchor('/adm/lunit/index','Статистика')?></li>
                      <li><?=anchor('admin/img','Библиотека')?></li>
                      <li><?=anchor('/adm/edits/index','Редактировать/Удалить')?></li>
                      <li><?=anchor('/adm/adds/index','Создать')?></li>
                      <li><?=anchor('/adm/settings/','Настройки')?></li>
                      <li><?=anchor('/admin/logout','Выход')?></li>
                   </ul>
                </nav>
           </div>
       </header>