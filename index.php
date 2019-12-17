<?php   

require_once "QueryBuilder.php";

// Создаём объект базы данных
$qr = QueryBuilder::getInstance("dz1h"); 

//выбор одной ячейки
//$query = "SELECT `login` FROM `users` WHERE `password` = -b-";
//$login = $qr->selectCell($query, array(1));

//вставка
//$query1 = "INSERT INTO `users` (login, password, reg_data) VALUE (-b-, -b-, -b-)";
//$qr->UpdateInsertDelete($query1, array("mam1", 11, 23));

//вывожу всю таблицу
//$query2 = "SELECT * FROM `users`";
//print_r($qr->selectAll($query2));

//вывод 1 строки, где логин = fe
//$query3 = "SELECT * FROM users WHERE login = -b-";
//print_r($qr->selectRow($query3, array("fe")));

//обновленеие
//$query4 = "UPDATE `users` SET `login` = -b-, `password` = -b- WHERE `id` = -b-";
//$qr->UpdateInsertDelete($query4, array("nik", 9, 10));

//удаление
//$query5 = "DELETE FROM `users` WHERE `id` > -b-";
//$qr->UpdateInsertDelete($query5, array(12));