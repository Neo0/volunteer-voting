<?php
	require_once __ROOT__."/handler/text_handler/text_handler.php";
	require_once 'student_info.php';
	require_once 'student_password.php';
	require_once 'aes.php';

	class Exam_Handler extends TextHandler
	{
		function handle()
		{
			$open_id=$this->user_id;
			$mapper=new Student_infoMapper();
			$rs=$mapper->select(new Student_infoDomain(array("open_id"=>$open_id)));
			if(!empty($rs))
			{
				$aes = new aes();
				$aes->setKey('yiW7BPNI8ax0O39opkKCCFQS');
				$student_id = $aes->decode($rs->get("student_id"));
				$student_name = $aes->decode($rs->get("name"));
				$class = substr($student_id,0,strlen($student_id)-2); 

				//数据库连接常量，修改此处
			    $dbname='afwdb';
			    $host='55bcb9ddc1a3f.sh.cdb.myqcloud.com';
			    $port='6055';

			    $dsn="mysql:dbname=$dbname;host=$host;port=$port";
			    $user='cdb_outerroot';
			    $password='aifuwu2014';

			    $pdo=new PDO($dsn,$user,$password); 
			    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    $pdo->exec("set names utf8"); 

			    $response="【期末考试自助查询】\n";
			    $response.="姓名：".$student_name."\n";
			    $response.="班级：".$class."\n";
			    $response.="-----------------\n";

			    $stmt=$pdo->query("SELECT * FROM `examination_arrangement` WHERE `class`='".$class."'");
			    foreach($stmt as $row)
			    {
			        $response.="课程名称：".$row['course_name']."\n";
			        $response.="任课教师：".$row['teacher_name']."\n";
			        $response.="考试时间：".$row['time']."\n";
			        $response.="考试地点：".$row['class_room']."\n";
			        $response.="-----------------\n";
			    }

			    $response.="©njuptservice";
				
				$this->response=new WechatTextResponse($response);

			}
			else
			{
				$this->response=new WechatTextResponse("【绑定信息】\n您尚未绑定请点击“i查询”菜单进入进行任意一功能绑定。");
			}
		}
	}
?>