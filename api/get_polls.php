<?php
/**
 * 查询票数
 * @param int $contestant_number
 */
function get_polls($contestant_number)
{

	$pdo = new PDO("mysql:host=localhost;dbname=voting","root","4ac52b3935"); 
	$pdo->query("set names 'utf8'");

	$st = $pdo->prepare("SELECT * FROM `count_voting` WHERE `SelectName`= :SelectName");
	$st->execute(array(':SelectName'=>$contestant_number));
	$result=$st->fetchAll();
	return $result[0]['CountVotes'];
}