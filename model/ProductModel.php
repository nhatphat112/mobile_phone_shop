<?php include_once ("ConnectionModel.php");?>
<?php 
	class ProductModel
	{
		function showAllProductManager()
		{ 
			$connect = new ConnectionModel();
			$conn = $connect->getConnect();
			if($conn)
			{
				$sql ="Select * from sanpham";
				$result = $conn->query($sql);
				if($result->num_rows>0)
				
				
				{
					while($row = $result->fetch_assoc())
					{
						echo ' <tr>
						<td align="center"><a href="index.php?idselecting='.$row['idsp'].'">'.$row['idsp'].'</a></td>
						<td align="center"><a href="index.php?idselecting='.$row['idsp'].'">'.$row['tensp'].'</a></td>
						<td align="center"><a href="index.php?idselecting='.$row['idsp'].'">'.$row['gia'].'</a></td>
						<td align="center"><a href="index.php?idselecting='.$row['idsp'].'">'.$row['mota'].'</a></td>
						<td align="center"><a href="index.php?idselecting='.$row['idsp'].'"><img src="../img/'.$row['hinh'].'" width="50" height="50" alt=""/></a></td>
						<td align="center"><a href="index.php?idselecting='.$row['idsp'].'">'.$row['giamgia'].'</a></td>
						<td align="center"><a href="index.php?idselecting='.$row['idsp'].'">'.$row['idcty'].'</a></td>
							  </tr>';
					}	
				}	
			}	
		}	
		function showProductDetail($sql)
		{ 
			$connect = new ConnectionModel();
			$conn = $connect->getConnect();
			if($conn)
			{
				$result = $conn->query($sql);
				if($result->num_rows>0)
				{
					while($row = $result->fetch_assoc())
					{
						return $row;
					}	
				}
				return 0;
			}	
		}	
		function showAllProductView()
		{ 
			$connect = new ConnectionModel();
			$conn = $connect->getConnect();
			if($conn)
			{
				$sql ="Select * from sanpham";
				$result = $conn->query($sql);
				if($result->num_rows>0)
				
				
				{
					while($row = $result->fetch_assoc())
					{
						echo ' <div class="sanpham">
						<div class ="tensanpham">
            		'.$row['tensp'].'
            </div>
           <a href="detail.php?idsp='.$row['idsp'].'"><img class ="hinhanh" src="img/'.$row['hinh'].'" width="200px" height="200px" alt=""/></a>
            <div class ="giasanpham">
            	'.$row['gia'].' $
            </div>
			</div/>';
					}	
				}	
			}	
		}	
		function addProduct($name, $price, $desc, $discount, $image, $companyId)
		{
			$connect = new ConnectionModel();
			$conn = $connect->getConnect();
			if($conn)
			{
				//	idsp	tensp	gia	mota	hinh	giamgia	idcty
				$sql ="insert into     sanpham(tensp,gia,mota,hinh,giamgia,idcty)values('$name', $price,'$desc','$image',$discount,$companyId)";
				$result = $conn->query($sql);
				if($result){
					return true;
				}else{
					return false;
				}
				
			
				}
				
		}
		function saveFile($tmp_name,$folder, $name)
		{
			if($tmp_name!=''&&$name!=''&&$folder!='')
			{
				$newname = time().'_'.$name;
				$path = $folder.'/'.$newname;
				if(move_uploaded_file($tmp_name,$path)){
					return $newname;
				}else
				{
					return 0;
				}
			}	
		}
		function showAllProductViewByCompanyId($id)
		{
			$connect = new ConnectionModel();
			$conn = $connect->getConnect();
			if($conn)
			{
				$sql ="Select * from sanpham where idcty = $id";
				$result = $conn->query($sql);
				if($result->num_rows>0)
				
				
				{
					while($row = $result->fetch_assoc())
					{
						echo ' <div class="sanpham">
						<div class ="tensanpham">
            		'.$row['tensp'].'
            </div>
			<a href="detail.php?idsp='.$row['idsp'].'"><img class ="hinhanh" src="img/'.$row['hinh'].'" width="200px" height="200px" alt=""/></a>
            
            <div class ="giasanpham">
            	'.$row['gia'].' $
            </div>
			</div/>';
					}	
				}	
			}	
		}
	}
	
?>