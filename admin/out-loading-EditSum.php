<?php
/**
 * Created by PhpStorm.
 * User: lns
 * Date: 2019/4/18
 * Time: 18:31
 */

//包含连接数据库的公共代码
require_once("inc/conn.php");

//获取地址栏传递的ID
$id = $_GET['id'];
$sum = $_GET['sum'];

//构建删除的SQL语句
$sql = "UPDATE out_ SET out_sum = '$sum' WHERE out_id = $id";

//执行SQL语句
if (mysqli_query($link, $sql)) {
    echo "<h3> 修改 $id 操作成功!</h3>";

    //告诉浏览器执行代码：等待3秒，并跳转文件
    header("refresh:3;url=out-loading.php");

    echo "3秒后自动返回,或者 <a href='out-loading.php'> 点击这里 </a> 立刻返回";

}
