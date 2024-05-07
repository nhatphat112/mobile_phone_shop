<?php include_once ("model/ProductModel.php");?>
<?php include_once ("model/Tmdt.php");?>
<?php include_once ("model/Customer.php");?>
<?php include_once ("model/CompanyModel.php");
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Chi Tiết Sản Phẩm</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-5.0.2-dist/css/bootstrap.css">
		<script src="bootstrap-5.0.2-dist/js/jquery-3.7.1.min.js"></script>
	<script src="bootstrap-5.0.2-dist/js/bootstrap.js"></script>
	
	<style>
		#banner h1{
			text-align: center;
			text-transform: uppercase;
			padding-top: 28px;
			color: #fdfdfd;
		}
		.category-title {
			    margin: 25px;
				font-size: 20px;
				font-weight: 800;
				color: black;
		}
		ul a {
			padding: 8px 0px;
			color: black;
			font-size: 18px;
			font-weight: 700;
		}
		ul li:hover a{
			    color: yellow;
		}
	</style>

</head>

<body>
	

<div id="container">
	<div id="banner"><h1>Cửa Hành Điện thoại Trực Tuyến</h1></div>
    <div id="main-content">
    	<div id="left-content">
			<div class="category-title">Danh Sách Thương Hiệu</div>
			<ul>
				<li><a href="./">Tất Cả Sản Phẩm</a></li>
				

        	<?php 
			
				$p = new ProductModel();
				$tmdt = new Tmdt();
				$customer = new Customer();
				if(isset($_REQUEST['idsp'])&&$_REQUEST['idsp']!='')
				{
					$idsp = $_REQUEST['idsp'];
					$product = $p->showProductDetail("select * from sanpham where idsp =$idsp ");
					$idcty = $product['idcty'];
						if($product['idsp']!=null&&$product['idsp']!='')
						{
							$tencty = $tmdt->getValueColumn("select tencty from congty where idcty=$idcty");
						}
						else
					{
						header('location:./');
					}
				
				
				}else{
					header('location:./');
				}
			
			$c = new CompanyModel();
				$c->showComanyLink();
			?>
		</ul>
        		
    	</div>
        <div id ="right-content">
			<form id="form1" name="form1" method="post">
					<table width="560" border="1">
          <tbody>
            <tr>
              <td colspan="2" align="center"><h2>Chi tiết sản phẩm</h2></td>
            </tr>
            <tr>
              <td width="225" rowspan="6"><img src="img/<?php echo $product['hinh'] ?>" height="225" alt=""/></td>
              <td width="319" height="34"><label for="tensp">Tên sản phẩm
                :</label>
				     <input readonly name="idsp" type="hidden" id="tensp" value="<?php echo $product['idsp'] ?>">
              <input readonly name="tensp" type="text" id="tensp" value="<?php echo $product['tensp'] ?>"></td>
            </tr>
            <tr>
              <td height="25"><label for="tencty">Tên công ty:</label>
              <input readonly name="tencty" type="text" id="tencty" value="<?php echo $tencty ?>"></td>
            </tr>
            <tr>
              <td height="62" align="left" valign="top"><p>
                <label for="mota">Mô tả:</label>
              </p>
                <p>
                  <textarea disabled name="mota" cols="40" rows="6" class="alert-warning" id="mota"><?php echo $product['mota'] ?></textarea>
              </p></td>
            </tr>
            <tr>
              <td height="42"><label for="gia">Giá:</label>
              <input readonly name="dongia" type="text" id="dongia" value="<?php echo $product['gia'] ?>"></td>
            </tr>
            <tr>
              <td height="56"><label for="soluong">Số lượng:</label>
              <input type="number" name="soluong" id="soluong"></td>
            </tr>
            <tr>
              <td height="23"><input type="submit" name="btn" id="btn" value="Thêm sản phẩm"></td>
            </tr>
            <tr>
              <td height="59" colspan="2" align="center"><a href="index.php">Quay lại danh sách</a></td>
            </tr>
          </tbody>
        </table>
      		  </form>
<!--        <div class="sanpham">
        	<div class ="tensanpham">
            		Iphone 15
            </div>
            <img class ="hinhanh" src="img/images1.jpeg" width="200px" height="200px" alt=""/>
            <div class ="giasanpham">
            	15000
            </div>
        </div> -->
			<?php 
	
		switch($_REQUEST['btn']){
				
			case 'Thêm sản phẩm':
				$customer->checkLogin();
				$idsp = $_REQUEST['idsp'];
				$tensp = $_REQUEST['tensp'];
				$gia = $_REQUEST['dongia'];
				$soluong = $_REQUEST['soluong'];
				$idkh = $_SESSION['idkh'];
				if($soluong<=0){
					$tmdt->showAlert("Số lượng phải lớn hơn 0.");
				}
				else {
						// create dathang if not exists and find iddh
					$iddh = $tmdt->getValueColumn("select iddh from dathang where idkh = $idkh");
					if($iddh==null||$iddh==''){
						if($tmdt->xoasua("insert into dathang(idkh)values($idkh);")!=0){
							$iddh = $tmdt->getValueColumn("select iddh from dathang where idkh = $idkh");
						}
					}

					// create dathang_chitiet if not exists
					$addSuccess = false;
					$isSuccess = false;
					
					$idsp_db = $tmdt->getValueColumn("select idsp from dathang_chitiet where idsp = $idsp and iddh = $iddh");
					
					if($idsp_db==null||$idsp_db==""){
						
						if($tmdt->xoasua("insert into dathang_chitiet(iddh,idsp,dongia,soluong)values($iddh,$idsp,$gia,$soluong);")!=0){
							$addSuccess = true;
							$isSuccess = true;
							
						}else{
					
						}
					}
					if(!$addSuccess)
					{
						$souong_db = $tmdt->getValueColumn("select soluong from dathang_chitiet where idsp = $idsp and iddh = $iddh" );
						$soluong = ($soluong+$souong_db);
						if($tmdt->xoasua("update dathang_chitiet set soluong =$soluong where iddh = $iddh and idsp = $idsp" )!=0){
							$isSuccess = true;
						}else{
							$isSuccess = false;
						}
					}
						if($isSuccess){
							$tmdt->showAlert("Thêm sản phẩm thành công.");
						}else{
							$tmdt->showAlert("Thêm sản phẩm thất bại.");
						}
	
					}

				break;
		}	 
	?>
        <?php 
		
		?>
        <a href="customer/cart.php">Giỏ hàng</a>
        </div>
		
    </div>
    <div id="footer"></div>
</div>
	<div class="modal" id='announce' tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thông báo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="announce-message">Modal body text goes here.</p>
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

	
	
</body>
</html>