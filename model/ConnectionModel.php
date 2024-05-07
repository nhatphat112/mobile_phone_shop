<?php 
	class ConnectionModel
	{
		public function getConnect()
		{
			return mysqli_connect("localhost","root","","product_manager");	
		}	
	}
?>