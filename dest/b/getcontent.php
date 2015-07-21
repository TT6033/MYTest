<?php
echo date("jS F Y");
echo "<br>";
echo mktime(0,0,0,1,1,1970);
echo"<br>";
echo time();
echo "<br>";
print_r(getdate()) ;
$url="http://slide.mil.news.sina.com.cn/j/slide_8_211_35925.html#p=1";
if(!($contents=file_get_contents($url)))
{
	die("fail to get content from".$url);
}
else {
	echo $contents;
}


?>