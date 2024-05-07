<?php 
include_once('../model/CompanyModel.php');
include_once('../model/ProductModel.php');
include_once('../model/Tmdt.php');

error_reporting(1);
$companyModel = new CompanyModel();
$productModel = new ProductModel();
$t = new Tmdt();
$t->checkLogin();
$idSelect = $_REQUEST['idselecting'];
$f_name = $t->getValueColumn("select tensp from sanpham where idsp =$idSelect limit 1");
$f_price = $t->getValueColumn("select gia from sanpham where idsp =$idSelect limit 1");
$f_desc = $t->getValueColumn("select mota from sanpham where idsp =$idSelect limit 1");
$f_image_name = $t->getValueColumn("select hinh from sanpham where idsp =$idSelect limit 1");
$f_discount = $t->getValueColumn("select giamgia from sanpham where idsp =$idSelect limit 1");
$f_company = $t->getValueColumn("select idcty from sanpham where idsp =$idSelect limit 1");


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Thêm Sản Phẩm</title>
</head>

<body>
	<style>
		td
		{
			padding-right:10px;
			
		}
		
	</style>
<form method="post" enctype="multipart/form-data" name="form1" id="form1">
  <h1 style="text-align: center">Thêm sản phẩm<span style="text-align: justify"></span><span style="text-align: left"></span><span style="text-align: center"></span></h1>
  <table width="410" border="1" align="center">
    <tbody>
      <tr>
		  <input name="id" type="hidden" id="name" value="<?php echo $idSelect ?>">
        <td width="152" align="right">Tên sản phẩm</td>
        <td width="242"><input name="name" type="text" id="name" value="<?php echo $f_name;?>"></td>
      </tr>
      <tr>
        <td align="right">Giá</td>
        <td><input type="number" name="price" id="price"  value="<?php echo $f_price;?>"></td>
      </tr>
      <tr>
        <td align="right">Mô tả</td>
        <td><input type="text" name="desc" id="desc"  value="<?php echo $f_desc;?>"></td>
      </tr>
      <tr>
        <td align="right">Hình</td>
        <td><input type="file" name="image" id="image" >
		 	<input readonly id="image-name" name="image-name" value="<?php echo $f_image_name;?>" ></input>
		  </td>
      </tr>
      <tr>
        <td align="right">Giảm giá</td>
        <td><input type="number" name="discount" id="discount" value="<?php echo $f_discount;?>"></td>
      </tr>
      <tr>
        <td align="right">Công ty</td>
        <td><select name="company" id="company">
          <option value="">Vui lòng chọn công ty</option>
          <?php
				$companyModel->showCompanySelection($f_company);
			?>
        </select></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
			<input type="submit" name="btn" id="btn" value="Lưu">
		  <input type="submit" name="btn" id="btn" value="Cập nhật">
			<input type="submit" name="btn" id="btn" value="Xoá">
	    </td>
      </tr>
    </tbody>
	  <?php
		switch($_POST['btn']){
			case "Lưu":
			$name = $_POST['name'];
			$price = $_POST['price'];
			$desc = $_POST['desc'];
			$image = $_FILES['image'];
			$discount = $_POST['discount'];
			$company = $_POST['company'];
			
			// check
			
			$isSuccess = false;
		
			if($image['name']!=''){
				$newname = $productModel->saveFile($image['tmp_name'],'../img', $image['name']);
			if($newname!='0'){
				if($productModel->addProduct($name, $price, $desc, $discount, $newname, $company))
				{
					$isSuccess = true;
				}
				}
			}
				if($isSuccess)
				{
					echo '<script>
						alert("Thêm sản phẩm thành công")
						</script>' ;
				}else
				{
					echo '<script>
						alert("Thêm sản phẩm thất bại! Vui lòng kiểm tra thông tin đầu vào.")
						</script>' ;
				}
				break;
			case "Cập nhật":
				$idsp = $_POST['id'];
				$name = $_POST['name'];
				$price = $_POST['price'];
				$desc = $_POST['desc'];
				$image = $_FILES['image'];
				$discount = $_POST['discount'];
				$company = $_POST['company'];
				$image_name = $image['name']; 
				
				
				$newfile = 1;
				if($idsp!=''){
					if($image_name=='')
					{
						$image_name = $_REQUEST['image-name'];
						$newfile =0;
					}
					
					if($image_name!=''){
						$sql = "update sanpham set tensp='$name',gia = $price, mota = '$desc', hinh = '$image_name', giamgia =$discount, idcty=$company where idsp = $idsp ";
						
						if($newfile){
							$image_name = $productModel->saveFile($image['tmp_name'],'img',$image_name);
							
						}
						if($image_name!="0"){
							if($t->xoasua($sql)){
									echo '<script>
									alert("Sửa thành công.")
									</script>' ;
							}else{
									echo '<script>
									alert("Sửa thất bại.")
									</script>' ;
									}
						}else{
								echo '<script>
								alert("Thêm file thất bại.")
								</script>' ;
						}
					}else
					{
							echo '<script>
						alert("Vui lòng chọn ảnh.")
						</script>' ;
					}
				}else{
					echo '<script>
						alert("Vui lòng chọn sản phẩm.")
						</script>' ;
				}
				
				break;
			case "Xoá":
					$idsp = $_REQUEST['id'];
					if($idsp!=''){
						$sql = "delete from sanpham where idsp =$idsp";
						$image_name = $_REQUEST['image_name'];
						if($t->removeFile('../img',$f_image_name)){
							if($t->xoasua($sql)){
								echo '<script>
									alert("Xóa sản phẩm thành công.")
									</script>' ;
							}else{
								echo '<script>
										alert("Xóa sản phẩm thất bại")
										</script>' ;
							}
						}else{
							echo '<script>
								alert("Xóa file thất bại.");
								</script>' ;
						}
					}else{
						echo '<script>
						alert("Vui lòng chọn sản phẩm.")
						</script>' ;
					}
					
				break;
		}
	?>

</form>
	</table>
  <p>&nbsp;</p>
<h1 style="text-align: center">Bảng sản phẩm</h1>
  <table width="781" border="1" align="center">
    <tbody>
      <tr>
        <td width="36" align="center">ID</td>
        <td width="127" align="center">Tên sản phẩm</td>
        <td width="76" align="center">Giá</td>
        <td width="85" align="center">Mô tả</td>
        <td width="41" align="center">Hình</td>
        <td width="88" align="center">Giảm giá</td>
        <td width="138" align="center">ID Công ty</td>
      </tr>
		<?php 
		$productModel->showAllProductManager();
		?>
<!--
      <tr>
        <td align="center">1</td>
        <td align="center">Sản phẩm</td>
        <td align="center">1</td>
        <td align="center">Mô tả</td>
        <td align="center"><img src="img/images3.jpeg" width="50" height="50" alt=""/></td>
        <td align="center">1</td>
        <td align="center">1</td>
        <td align="center"><p>&nbsp;</p></td>
      </tr>
-->
    </tbody>
  </table>
</body>
</html>