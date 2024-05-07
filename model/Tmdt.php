<?php 
	include_once("ConnectionModel.php");
class Tmdt extends ConnectionModel 
{
	public function login($name, $pass)
	{	
		$sql ="select * from taikhoan where username ='$name'";
		$account = $this->getAccount($sql);
		
		
		$pass = md5($pass);
		if($account){
			$name_db = $account['username'];
			$pass_db = $account['password'];
			if($name == $name_db&&$pass==$pass_db)
			{
				session_start();
				$_SESSION['name'] = $name_db;
				$_SESSION['pass'] = $pass_db;
				$_SESSION['iduser'] = $account['iduser'];
				header("location:../admin");
			}else{
				
			}
		}
		return 0;
	}
	public function getAccount($sql)
	{
		
		$connect = $this->getConnect();
		if($connect)
		{
			$result = $connect ->query($sql);
			if($result->num_rows>0)
			{
				while($row= $result->fetch_assoc()){
					return $row;
				}
			}else{
				
				return 0;
			}
		}
	}
	public function checkLogin(){
		session_start();
		$iduser = $_SESSION['iduser'];
		$name = $_SESSION['name'];
		$pass = $_SESSION['pass'];
		
		if(isset($iduser)&&isset($name)&&isset($iduser))
		{	
			$sql = "select * from taikhoan where iduser ='$iduser' and username ='$name' and password ='$pass'";
			if($this->getAccount($sql)!=0){
				return;
			}
			
			
		}
			header("location:login.php");
	}
	
	public function checkPageLogin(){
		session_start();
		$iduser = $_SESSION['iduser'];
		$name = $_SESSION['name'];
		$pass = $_SESSION['pass'];
		
		if(isset($iduser)&&isset($name)&&isset($iduser))
		{	
			$sql = "select * from taikhoan where iduser ='$iduser' and username ='$name' and password ='$pass'";
			if($this->getAccount($sql)!=0){
				header("location:../");
			}
			
			
		}
			
	}
	public function removeFile($folder,$filename)
	{	$path = $folder.'/'.$filename;
	 	
		if(unlink($path)){
			return 1;
		}else return 0;
	}
	public function getValueColumn($sql)
	{
		
		$connect = $this->getConnect();
		if($connect)
		{
			$result = $connect ->query($sql);
			if($result->num_rows>0)
			{
				while($row= $result->fetch_array()){
					return $row[0];
				}
			}else{
				
				return null;
			}
		}
	}
	public function xoasua($sql)
	{
			$connect = $this->getConnect();
			if($connect)
			{
				
				if($connect ->query($sql))
				{
					return 1;
				}else{

					return 0;
				}
			}
		}
	public function showAlert($message)
	{	echo '<script>';
	 		
		echo '$(document).ready(function(){
			$("#announce-message").text("'.$message.'");
			$("#announce").modal("show");
		})';
	 	echo '</script>';
	}
}

?>