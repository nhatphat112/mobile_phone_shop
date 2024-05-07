<?php 
include_once("ConnectionModel.php");
	class Customer extends ConnectionModel{
		public function login($name, $pass)
	{	
		$sql ="select * from khachhang where email ='$name'";
		$account = $this->getAccount($sql);
		
		
		$pass = md5($pass);
		if($account){
			$name_db = $account['email'];
			$pass_db = $account['password'];
			if($name == $name_db&&$pass==$pass_db)
			{
				session_start();
				$_SESSION['name_customer'] = $name_db;
				$_SESSION['pass_customer'] = $pass_db;
				$_SESSION['idkh'] = $account['idkh'];
				header("location:../");
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
		
		$iduser = $_SESSION['idkh'];
		$name = $_SESSION['name_customer'];
		$pass = $_SESSION['pass_customer'];
		
		if(isset($iduser)&&isset($name)&&isset($iduser))
		{	
			$sql = "select * from khachhang where idkh ='$iduser' and email ='$name' and password ='$pass'";
			if($this->getAccount($sql)!=0){
				return;
			}
			
			
		}
			header("location:customer");
	}
	public function checkPageLogin(){
		session_start();
		$iduser = $_SESSION['idkh'];
		$name = $_SESSION['name_customer'];
		$pass = $_SESSION['pass_customer'];
		
		if(isset($iduser)&&isset($name)&&isset($iduser))
		{	
			$sql = "select * from khachhang where idkh ='$iduser' and email ='$name' and password ='$pass'";
			if($this->getAccount($sql)!=0){
				header("location:../");
			}
			
			
		}
	}
	public function checkLoginCart(){
		session_start();
		$iduser = $_SESSION['idkh'];
		$name = $_SESSION['name_customer'];
		$pass = $_SESSION['pass_customer'];
		
		if(isset($iduser)&&isset($name)&&isset($iduser))
		{	
			$sql = "select * from khachhang where idkh ='$iduser' and email ='$name' and password ='$pass'";
			if($this->getAccount($sql)!=0){
				return;
			}
			
			
		}
			header("location:./");
	}	
		public function showCartList(){
			$connect = new ConnectionModel();
			$conn = $connect->getConnect();
			if($conn)
			{
				$sql ="SELECT dt.iddh, dt.idsp, dt.soluong, dt.dongia, s.tensp
						FROM dathang_chitiet dt
						INNER JOIN sanpham s ON dt.idsp = s.idsp";
				$result = $conn->query($sql);
				if($result->num_rows>0)
				
				
				{	$count = 1;
					while($row = $result->fetch_assoc())
					{
						echo ' <tr><td colspan="5" >
				<div class="row-item">
					<form id="form'.$count.'" name="form'.$count.'" method="post">
						<input type="hidden" name="idsp" id="idsp" value="'.$row['idsp'].'">
						<input type="hidden" name="iddh" id="iddh" value="'.$row['iddh'].'">
						
						<div>'.$count.'</div>
						<div class="product-name">'. $row['tensp'].'</div>
						<div>'.$row['dongia'].'</div>
						<div><input style="width: 40px" type="number" name="soluong" id="soluong" value="'.$row['soluong'].'"></div>

						<div><input type="submit" name="btn" id="btn" value="Cập nhật">
						<input type="submit" name="btn" id="btn" value="Xóa"></div>
					</form>
					</div>
					</td>
                </tr>';
						$count++;
					}	
				}	
			}	
		}
}
?>