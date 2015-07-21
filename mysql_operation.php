<?php
require_once 'mysql_connect.php';


/*
 * 函数名：插入函数
 * 参数：sql语句
 * 返回值：如果查询成功；如果上一查询没有产生 AUTO_INCREMENT 的 ID，返回 0,否则返回插入记录的ID。
 * 				 如果查询失败，返回false
 */
function myinsert($sql)
{
	
	$result=mysql_query($sql);
	if($result)
	{
		echo "插入成功";
		return mysql_insert_id();
	}
	else {
		echo mysql_error();
		return false;
	}
	
	
}
/*
 * 函数名：查询函数
 * 参数：sql语句
 * 返回值：查询成功且存在记录，返回全部记录
 * 				 查询失败，返回false
 */
function myselect($sql)
{
 $result=mysql_query($sql);
    if ($result && mysql_num_rows($result)>0){
        while ($row=mysql_fetch_array($result)){
            $rows[]=$row;
        }
        return $rows;
    }else {
        return false;
    }
}



/*
 * 函数名：更新函数
 * 参数：sql语句
 * 返回值：查询成功,返回更新的记录数
 * 				 查询失败，返回false
 */
function update($sql){
	$res=mysql_query($sql);
	if ($res){
		return mysql_affected_rows();
	}else {
		return false;
	}
}




?>