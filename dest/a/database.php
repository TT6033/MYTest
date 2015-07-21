<html>
<body>
</body>
</html>
<?php
echo "123";
require_once 'mysql_connect.php';
echo "456";
$sql="select * from function";
$result=mysql_query($sql);

while($property=mysql_fetch_array($result))
{
  echo $property['Funname'];
  
}
mysql_close();
?>