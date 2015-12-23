<meta http-equiv="Refresh" content="3; url=index.php"> 
<?php
// $selectName = $_POST["vote"];
// var_dump($selectName);
/**
 * 处理投票提交的信息
 */
require_once ('./api/func.php');
require_once ('./api/OperatorVotingDB.php');
require ("./header.html");
$ovdb = new OperatorVotingDB();
$ip = getClientIP();
$loc = getIpfrom123cha($ip);
// $ovdb->vote($ip, $loc, $selectName);
$users = $_POST['vote'];
$ovdb->vote($ip, $loc, $users);

// if(isset($_POST['vote'])){
// $users = $_POST['vote'];
// foreach($users as $key=>$val){
//    echo 'user ',$key,' = ',$val,'<br />';
//    $ovdb->vote($ip, $loc, $val);
//    echo "投票成功！";
// }
// }
// echo "投票成功！";
echo "<br>3秒后自动返回...";
// goToPgae('./index.php');
?>
