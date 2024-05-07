<?php include_once ("model/ProductModel.php");?>
<?php include_once ("model/CompanyModel.php");?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Trang Chủ</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
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
	</style>
<div id="container">
	<div id="banner">
		<h1>Cửa Hành Điện thoại Trực Tuyến</h1>
	</div>
    <div id="main-content">
    	<div id="left-content">
			<div class="category-title">Danh Sách Thương Hiệu</div>
			<ul>
				<li><a href="./">Tất Cả Sản Phẩm</a></li>
				<?php 
				$c = new CompanyModel();
				$c->showComanyLink();
			?>
			</ul>
        	
        </div>
        <div id ="right-content">
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
			$p = new ProductModel();
			if(isset($_GET['id']))
			{
				$p->showAllProductViewByCompanyId($_GET['id']);
			}else
			{
				$p->showAllProductView();	
			}
		?>
        </div>
    </div>
    <div id="footer"></div>
</div>
</body>
</html>