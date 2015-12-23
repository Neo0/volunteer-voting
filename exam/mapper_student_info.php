<?php
	class Domain_infoObject{
		protected $data=array();
		protected $scheme;
		function __construct($data){
			foreach ($this->scheme as $name){
				if(isset($data[$name])) {
					$this->data[$name]=$data[$name];
//					echo $name;
				}
			}
		}
		function get($name){
			if(array_key_exists($name,$this->data) && $this->data[$name]!="") {
				return  $this->data[$name];
			}
			else return "nothing";
		}
		function set($name,$value){
			if(in_array($name,$this->scheme))
				$this->data[$name]=$value;
		}
	}

	abstract class Domain_infoFactory{
		protected $scheme;
		abstract function createObject(array $array);
	}

	abstract class info_Mapper{
		protected static $pdo;
		protected $selectStmt;
		protected $selectAllStmt;
		protected $insertStmt;
		protected $deleteStmt;
		protected $updateStmt;
		protected $factory;
		function __construct(){
			if(!isset(self::$pdo)){
				try {
// 					$dsn="mysql:dbname=afwdb;host=localhost;port=3306";
// 					$user="root";
// 					$password="";
					$dsn="mysql:dbname=afwdb;host=55bcb9ddc1a3f.sh.cdb.myqcloud.com;port=6055";
					$user="cdb_outerroot";
					$password="aifuwu2014";
					self::$pdo=new PDO($dsn,$user,$password);
					self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				}
				catch (PDOException $e) {
					print "Error!: " . $e->getMessage() . "<br/>";
					die();
				}
			}
		}

		function find($id){
			$this->selectStmt->execute(array($id));
			$array=$this->selectStmt->fetch();
			$this->selectStmt->closeCursor();
			if(!is_array($array)){return null;}
			$object=$this->factory->createObject($array);
			return $object;
		}

		public function findAll(){
			$this->selectAllStmt->execute();
			$array=$this->selectAllStmt->fetchAll();
			$this->selectAllStmt->closeCursor();
			if(!is_array($array)){return null;};
			$collection=new collection($array,$this->factory);
			return $collection;
		}

		function delete(Domain_infoObject $obj){
			$flg=$this->deleteStmt->execute(array($obj));
			$this->selectStmt->closeCursor();
			return $flg;
		}
		abstract function insert(Domain_infoObject $obj);
		abstract function update(Domain_infoObject $obj);
	}

	class info_collection implements Iterator{
		protected $raw=array();
		protected $objects=array();
		protected $factory;
		protected $pointer=0;
		protected $total=0;
		function __construct(array $raw,Domain_infoFactory $factory){
			$this->raw=$raw;
			$this->total=count($raw);
			$this->factory=$factory;
		}
		function getRow($num){
			if($num>=$this->total||$num<0){
				return null;
			}
			if(isset($this->objects[$num])){
				return $this->objects[$num];
			}
			if(isset($this->raw[$num])){
				$this->objects[$num]=$this->factory->createObject($this->raw[$num]);
				return $this->objects[$num];
			}
		}
		function rewind(){
			$this->pointer=0;
		}
		function current(){
			return $this->getRow($this->pointer);
		}
		function key(){
			return pointer;
		}
		function next(){
			$row=$this->getRow($this->pointer);
			if($row){$this->pointer++;}
			return $row;
		}
		function valid(){
			return (!is_null($this->current()));
		}
	}
?>