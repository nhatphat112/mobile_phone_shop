<?php include_once ("ConnectionModel.php");
class CompanyModel
{
	public function showComanyLink()
	{
		$connect = new ConnectionModel();
		$conn = $connect->getConnect();
		if($conn)
		{
			$sql ="Select * from congty";
				$result = $conn->query($sql);
				if($result->num_rows>0)
				{
					while($row = $result->fetch_assoc())
					{
						echo '<li><a href="index.php?id='.$row['idcty'].'">'.$row['tencty'].'</a></li>';
					}	
				}
		}	
	}
	public function showCompanySelection($f_congty)
	{
		$connect = new ConnectionModel();
		$conn = $connect->getConnect();
		if($conn)
		{
			$sql ="Select * from congty";
				$result = $conn->query($sql);
				if($result->num_rows>0)
				{
					if(isset($f_congty))
					{
						
						while($row = $result->fetch_assoc())
						{
							if($row['idcty']==$f_congty)
							{
								echo '<option value="'.$row['idcty'].'" selected>'.$row['tencty'].'</option>';
							}else{
								echo '<option value="'.$row['idcty'].'">'.$row['tencty'].'</option>';
							}
						}	
					}else{
						
						while($row = $result->fetch_assoc())
						{
							echo '<option value="'.$row['idcty'].'">'.$row['tencty'].'</option>';
						}	
					}
				}
		}	
	}
}

?>