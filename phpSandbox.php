$username="transportation";
$password="thisisastrongpassword";
$database="http://ytbnserver.ddns.net/phpmyadmin/index.php?db=db1&token=9b98b8d60e7d6b2bab3b19f52f3b71ab";

mysql_connect(localhost,$username,$password);


$sql = "SELECT * FROM `reservations` LIMIT 0, 30 ";