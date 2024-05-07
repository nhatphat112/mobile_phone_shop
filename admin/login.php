
<?php 
	include_once("../model/Customer.php");
	include_once("../model/Tmdt.php");
	$tmdt = new Tmdt();
	$tmdt->checkPageLogin();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap-5.0.2-dist/css/bootstrap.css">
	<script src="../bootstrap-5.0.2-dist/js/jquery-3.7.1.min.js"></script>
	<script src="../bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</head>

<body>
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
<form id="form1" name="form1" method="post">
  <table width="324" border="1" align="center">
    <tbody>
      <tr>
        <td colspan="2" align="center">Đăng Nhập</td>
      </tr>
      <tr>
        <td width="145">Tên đăng nhập</td>
        <td width="163"><input type="text" name="txtname" id="txtname"></td>
      </tr>
      <tr>
        <td>Mật khẩu</td>
        <td><input type="password" name="txtpass" id="txtpass"></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="btn" id="btn" value="Đăng nhập"></td>
      </tr>
    </tbody>
  </table>
	<?php 
		if($_POST['btn']=="Đăng nhập")
		{
			$name = $_POST['txtname'];
			$pass = $_POST['txtpass'];
			
			if($name ==''||$pass=="")
			{
				$tmdt->showAlert("Vui lòng điền đầy đủ tên đăng nhập và mật khẩu.");
			}else{
				if($tmdt->login($name,$pass)==0)
				{
					$tmdt->showAlert("Tên đăng nhập hoặc mật khẩu không chính xác.");
				}
			}
		}
	?>
</form>
</body>
</html>