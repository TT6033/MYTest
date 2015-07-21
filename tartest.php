<html>
<body>

<?php
$dir = array (
		"./a.tar",
		"b.tar" 
); // 压缩文件
$path = array (
		"./dest/a",
		"./dest/b" 
); // 解压路径
$ret = array (
		"./dest/result/ret_one.txt",
		"./dest/result/ret_two.txt" 
);
$output = array (); // 存放解压后的文件名称
$pathone = "";
$pathtwo = "";

$storezipone = array (); // 保存压缩包有区别的文件名
$storeziptwo = array ();

// 提取文件名称
extractfile ( $dir, $path, $output );

// 比较MD5码
comparefile ( $path [0], $path [1], $output [0], $output [1], $storezipone, $storeziptwo );

// 显示对比结果
showresult ( $output, $storezipone, $storeziptwo );
function showresult($output, $storezipone, $storeziptwo) {
	echo "<table align='center' border='1'>";
	echo "<tr><td>压缩包1内容</td\><td>压缩包2内容</td>";
	for($i = 0, $j = 0; $i < count ( $output [0] ) || $j < count ( $output [1] );) {
		echo "<tr>";
		echo "<td>";
		if (isset ( $output [0] [$i] )) {
			
			if (in_array ( $output [0] [$i], $storezipone )) {
				echo "<p style='color:red'>";
			}
			
			echo $output [0] [$i];
			
			echo "</p>";
			++ $i;
		}
		echo "</td>";
		echo "<td>";
		if (isset ( $output [1] [$j] )) {
			
			if (in_array ( $output [1] [$j], $storeziptwo )) {
				echo "<p style='color:red'>";
			}
			
			echo $output [1] [$j];
			echo "</p>";
			++ $j;
		}
		echo "</td>";
		echo "</tr>";
	}
	
	echo "</table>";
}
function extractfile($dir, $path, &$output) {
	for($i = 0; $i < count ( $dir ); ++ $i) {
		
		$temp = array ();
		$filedir = $dir [$i];
		$destination = $path [$i];
		$shellcommand = "tar -xvf $filedir -C $destination | sort -n ";
		exec ( $shellcommand, $temp );
		$output [$i] = $temp; // 获取解压文件名
	}
	
	// print_r($output[0]);
	// print_r($output[1]);
	// die();
}
function comparefile($path1, $path2, $array_one, $array_two, &$storezipone, &$storeziptwo) {
	$pathone = $pathone . $path1;
	$pathtwo = $pathtwo . $path2;
	
	for($i = 0, $j = 0; ($i < count ( $array_one )) && ($j < count ( $array_two ));) {
		
		if (strcmp ( $array_one [$i], $array_two [$j] ) == 0) { // 文件名相同
			
			if (1 == finddiff ( $path1, $path2, $array_one [$i], $array_two [$j] )) { // 文件名称相同，但MD5不同
			  // 不是目录
			  // echo "不同文件1：$array_two[$j]！ ";
				$storezipone [] = $array_one [$i];
				$storeziptwo [] = $array_two [$j];
			}
			
			++ $i;
			++ $j;
		} 

		else if (strcmp ( $array_one [$i], $array_two [$j] ) > 0) {
			
			// echo "不同文件2：$array_two[$j]！ ";
			
			$storeziptwo [] = $array_two [$j];
			
			++ $j;
		} else {
			
			// echo "不同文件3：$array_one[$i]！ ";
			$storezipone [] = $array_one [$i];
			
			++ $i;
		}
	}
	
	while ( $i < count ( $array_one ) ) {
		
		//echo "不同文件4：$array_one[$i]！ ";
		$storezipone [] = $array_one [$i];
		
		++ $i;
	}
	
	while ( $j < count ( $array_two ) ) {
		
		// echo "不同文件5：$array_two[$j]！ ";
		$storeziptwo [] = $array_two [$j];
		
		++ $j;
	}
}
function finddiff($path1, $path2, $content_one, $content_two) {
	$strone = array ();
	$strtwo = array ();
	
	$md5command_one = "md5sum $path1/$content_one"; // 这个路径写死了
	$md5command_two = "md5sum $path2/$content_two";
	
	exec ( $md5command_two, $strtwo );
	exec ( $md5command_one, $strone );
	if (0 != strcmp ( substr ( $strone [0], 0, 32 ), substr ( $strtwo [0], 0, 32 ) )) { // 提取MD5码并比较
		
		return 1;
	} else {
		
		return 0;
	}
}

?>


</body>
</html>