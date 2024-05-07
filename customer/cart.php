<?php include_once ("../model/ProductModel.php");?>
<?php include_once ("../model/CompanyModel.php");?>
<?php include_once ("../model/Tmdt.php");?>
<?php include_once ("../model/Customer.php");?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Giỏ Hàng</title>
<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-5.0.2-dist/css/bootstrap.css">
	<script src="../bootstrap-5.0.2-dist/js/jquery-3.7.1.min.js"></script>
	<script src="../bootstrap-5.0.2-dist/js/bootstrap.js"></script>
	
</head>

<body>
	
	<style>
		tr{
			border-bottom: 2px solid;
		}
		
	</style>
		<style>
		.row-item{
			display: flex;
		}
		.row-item div{
			display: inline-block;
			padding: 5px 40px;
		}
			
	</style>
	<style>
		#banner h1{
			text-align: center;
			text-transform: uppercase;
			padding-top: 28px;
			color: #fdfdfd;
		}
		.category-title {
			    margin: 25px;
				font-size: 22px;
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
		.product-name{
			width: 140px;
		}
	</style>
	
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
<div id="container">
	<div id="banner"><h1>Cửa Hành Điện thoại Trực Tuyến</h1></div>
    <div id="main-content">
		
    	<div id="left-content">	
			<div class="category-title">Danh Sách Thương Hiệu</div>
			<ul>
				<li><a href="./">Tất Cả Sản Phẩm</a></li>
        	<?php 
				$c = new CompanyModel();
				$c->showComanyLink();
				$tmdt = new Tmdt();
				$customer = new Customer();
				$customer->checkLoginCart();
			?>
			</ul>
        		
    	</div>
        <div id ="right-content">
     
            <table width="1000px" border="2px">
              <tbody>
                <tr>
                  <td colspan="5" align="center"><h2>Giỏ Hàng</h2></td>
                </tr>
                <tr>
                  <td colspan="5">
					  <div clas="row-item" style="display: flex">
					     <div style="display: inline-block;padding:5px 30px ">STT</div>
						<div style="display: inline-block;padding:5px 40px ">Tên sản phẩm</div>
						<div style="display: inline-block;padding:5px 40px ">Giá</div>
						<div style="display: inline-block;padding:5px 40px ">Số lượng</div>
						<div style="display: inline-block;padding:5px 40px ">Hành động</div>
					  </div>
					  </td>
                </tr>
				  <?php 
				$idsp =$_POST['idsp'];
				$soluong = $_POST['soluong'];
				$iddh = $_POST['iddh'];
				switch($_POST['btn']){
					case "Cập nhật":
						if($soluong==''||$soluong<=0){
							$tmdt->showAlert("Số lượng phải lớn hơn 0");
						}else{
							if($tmdt->xoasua("update dathang_chitiet set soluong = $soluong where iddh = $iddh and idsp = $idsp")!=0){
								$tmdt->showAlert("Cập nhật thành công.");
							}else{
								$tmdt->showAlert("Lỗi cập nhật");
							}
						}
						break;
					case "Xóa":
								if($tmdt->xoasua("delete from dathang_chitiet where iddh=$iddh and idsp =$idsp")!=0){
								$tmdt->showAlert("Xóa thành công.");
							}else{
								$tmdt->showAlert("Xóa thất bại");
							}
						break;
				}
		//		$tmdt->showAlert("active rồi");		 
			?>
                <?php 

				  $customer->showCartList();
				  ?>
				  <td><a href="../index.php">Về trang chủ</a></td>
              </tbody>
            </table>
          <p>&nbsp;</p>
        </div>
		
    </div>
    <div id="footer"></div>
</div>


	
	
</body>
</html>