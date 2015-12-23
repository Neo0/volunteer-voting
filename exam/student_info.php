<?php
	require_once "mapper_student_info.php";
	class Student_infoDomain extends Domain_infoObject{
		function __construct($array){
			$this->scheme=array("open_id", "student_id", "name","idcard_num","educard_id","school","major","class","entrance_time");
			parent::__construct($array);
		}
	}


	class Student_infoDomainFactory extends Domain_infoFactory{
		function createObject(array $array){
			$obj=new Student_infoDomain($array);
			return $obj;
		}
	}
	class Student_infoMapper extends info_Mapper{
		protected $selectAllStmt;
		protected $selectByDateStmt;
		protected $toselect;
		function __construct(){
			parent::__construct();
			$this->factory=new Student_infoDomainFactory();
			$this->selectStmt=self::$pdo->prepare("SELECT * FROM student_basic_information WHERE open_id=?");
			$this->insertStmt=self::$pdo->prepare("INSERT INTO student_basic_information (open_id,student_id,name,idcard_num,educard_id,school,major,class,entrance_time) VALUES(?,?,?,?,?,?,?,?,?)");
			$this->deleteStmt=self::$pdo->prepare("DELETE FROM student_basic_information WHERE open_id=?");
			$this->updateStmt=self::$pdo->prepare("UPDATE student_basic_information set student_id=?,name=?,idcard_num=?,educard_id=?,school=?,major=?,class=?,entrance_time=? WHERE open_id=?");
			$this->updateAllStmt=self::$pdo->prepare("UPDATE student_basic_information set student_id=?,name=?,idcard_num=?,educard_id=?,school=?,major=?,class=?,entrance_time=? WHERE open_id=?");
		}
		function override ($parm) {
			$result=array(trim($parm[8]));
			$this->selectStmt->execute($result);
			$rs=$this->selectStmt->fetch();
			$this->selectStmt->closeCursor();
//			if(!is_array($rs)) {
//				return null;
//			}
			if ($parm[0]=="nothing" && isset($rs["student_id"])) {$parm[0]=$rs["student_id"];}
			if ($parm[1]=="nothing" && isset($rs["name"])) {$parm[1]=$rs["name"];}
			if ($parm[2]=="nothing" && isset($rs["idcard_num"])) {$parm[2]=$rs["idcard_num"];}
			if ($parm[3]=="nothing" && isset($rs["educard_id"])) {$parm[3]=$rs["educard_id"];}
			if ($parm[4]=="nothing" && isset($rs["school"])) {$parm[4]=$rs["school"];}
			if ($parm[5]=="nothing" && isset($rs["major"])) {$parm[4]=$rs["major"];}
			if ($parm[6]=="nothing" && isset($rs["class"])) {$parm[4]=$rs["class"];}
			if ($parm[7]=="nothing" && isset($rs["entrance_time"])) {$parm[4]=$rs["entrance_time"];}
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
		function insert(Domain_infoObject $obj){
			$parm=array($obj->get("open_id"),$obj->get("student_id"),$obj->get("name"),$obj->get("idcard_num"),$obj->get("educard_id"),$obj->get("school"),$obj->get("major"),$obj->get("class"),$obj->get("entrance_time"));
			$this->insertStmt->execute($parm);
			$this->insertStmt->closeCursor();
			return true;
		}
		function update(Domain_infoObject $obj){    //解除绑定时  把密码置为空
			$parm=array($obj->get("student_id"),$obj->get("name"),$obj->get("idcard_num"),$obj->get("educard_id"),$obj->get("school"),$obj->get("major"),$obj->get("class"),$obj->get("entrance_time"),$obj->get("open_id"));
			if ($parm[0] == "nothing" || $parm[1] =="nothing" || $parm[2] == "nothing" || $parm[3] == "nothing" || $parm[4] == "nothing" || $parm[5] == "nothing" || $parm[6] == "nothing" || $parm[7] == "nothing") {
				$result=$this->override ($parm);
			}
			$this->updateStmt->execute($result);
			$this->updateStmt->closeCursor();
			return true;
		}
		function updateAll(Domain_infoObject $obj){    //解除绑定后 重新绑定
		    $parm=array($obj->get("student_id"),$obj->get("name"),$obj->get("idcard_num"),$obj->get("educard_id"),$obj->get("school"),$obj->get("major"),$obj->get("class"),$obj->get("entrance_time"),$obj->get("open_id"));
			$this->updateAllStmt->execute($parm);
			$this->updateAllStmt->closeCursor();
			return true;
		}
		function delete(Domain_infoObject $obj){
			$parm=array($obj->get("open_id"));
			$this->deleteStmt->execute($parm);
			$this->deleteStmt->closeCursor();
			return true;
		}
		function select(Domain_infoObject $obj){
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