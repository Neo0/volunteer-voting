<?php
	require_once "mapper_password.php";
	class Student_passwdDomain extends Domain_passwdObject{
		function __construct($array){
			$this->scheme=array("open_id","student_id","zhxy_psw","jwxt_psw","tsg_psw","aolan_psw");
			parent::__construct($array);
		}
	}


	class Student_passwdDomainFactory extends Domain_passwdFactory{
		function createObject(array $array){
			$obj=new Student_passwdDomain($array);
			return $obj;
		}
	}
	class Student_passwdMapper extends passwd_Mapper{
		protected $selectAllStmt;
		protected $selectByDateStmt;
		protected $toselect;
		function __construct(){
			parent::__construct();
			$this->factory=new Student_passwdDomainFactory();
			$this->selectStmt=self::$pdo->prepare("SELECT * FROM student_password WHERE open_id=?");
			$this->insertStmt=self::$pdo->prepare("INSERT INTO student_password (open_id,student_id,zhxy_psw,jwxt_psw,tsg_psw,aolan_psw) VALUES(?,?,?,?,?,?)");
			$this->deleteStmt=self::$pdo->prepare("DELETE FROM student_password WHERE open_id=?");
			$this->updateStmt=self::$pdo->prepare("UPDATE student_password set zhxy_psw=?,jwxt_psw=?,tsg_psw=?,aolan_psw=? WHERE open_id=?");
			$this->updateAllStmt=self::$pdo->prepare("UPDATE student_password set student_id=?,zhxy_psw=?,jwxt_psw=?,tsg_psw=?,aolan_psw=? WHERE open_id=?");
		}
		function override ($parm) {
			$result=array(trim($parm[4]));
			$this->selectStmt->execute($result);
			$rs=$this->selectStmt->fetch();
			$this->selectStmt->closeCursor();
//			if(!is_array($rs)) {
//				return null;
//			}
			if ($parm[0]=="nothing" && isset($rs["zhxy_psw"])) {$parm[0]=$rs["zhxy_psw"];}
			if ($parm[1]=="nothing" && isset($rs["jwxt_psw"])) {$parm[1]=$rs["jwxt_psw"];}
			if ($parm[2]=="nothing" && isset($rs["tsg_psw"])) {$parm[2]=$rs["tsg_psw"];}
			if ($parm[3]=="nothing" && isset($rs["aolan_psw"])) {$parm[3]=$rs["aolan_psw"];}
			return $parm;
//			$host = "sqld.duapp.com:4050";
// 			$user = "b28f088f6e844c67ada5038eb86c0d16";
// 			$psw = "78d25813e7f9436c8b84bc6f998a71be";
// 			$conn = mysql_connect($host,$user,$psw) or die ("connect error");
// 			mysql_select_db("ziVQpCOEScSxvUQpriht", $conn) or die ("open mysql error");
//			$open_id=trim($parm[3]);
// 			$sql="select * from student where open_id=$open_id";
// 			$rs=mysql_query($sql, $conn);
		}
		function insert(Domain_passwdObject $obj){
			$parm=array($obj->get("open_id"),$obj->get("student_id"),$obj->get("zhxy_psw"),$obj->get("jwxt_psw"),$obj->get("tsg_psw"),$obj->get("aolan_psw"));
// 			print_r($parm);
			$this->insertStmt->execute($parm);
			$this->insertStmt->closeCursor();
			return true;
		}
		function update(Domain_passwdObject $obj){    //解除绑定时  把密码置为空
			$parm=array($obj->get("zhxy_psw"),$obj->get("jwxt_psw"),$obj->get("tsg_psw"),$obj->get("aolan_psw"),$obj->get("open_id"));
			if ($parm[0] == "nothing" || $parm[1] =="nothing" || $parm[2] == "nothing" || $parm[3] == "nothing") {
				$result=$this->override ($parm);
			}
			$this->updateStmt->execute($result);
			$this->updateStmt->closeCursor();
			return true;
		}
		function updateAll(Domain_passwdObject $obj){    //解除绑定后 重新绑定
			$parm=array($obj->get("open_id"),$obj->get("student_id"),$obj->get("zhxy_psw"),$obj->get("jwxt_psw"),$obj->get("tsg_psw"),$obj->get("aolan_psw"));
			$this->updateAllStmt->execute($parm);
			$this->updateAllStmt->closeCursor();
			return true;
		}
		function delete(Domain_passwdObject $obj){
			$parm=array($obj->get("open_id"));
			$this->deleteStmt->execute($parm);
			$this->deleteStmt->closeCursor();
			return true;
		}
		function select(Domain_passwdObject $obj){
			$result=array($obj->get("open_id"));
			$this->selectStmt->execute($result);
			$array=$this->selectStmt->fetch();
			$this->selectStmt->closeCursor();
			if(!is_array($array))
				{return null;}
			$object=$this->factory->createObject($array);
			return $object;
		}

	}
?>