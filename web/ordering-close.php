<?php

//包含连接数据库的公共代码
require_once("../inc/conn.php");

//获取地址栏传递的ID
$id = $_GET['id'];
$num = $_GET['num'];
$water = $_GET['water'];

//获取该客户
$userId = $_SESSION['user_id'];

//构建删除的SQL语句
$sql = "UPDATE out_ SET out_good = '0' WHERE out_id = $id AND client_id = $userId";

//执行SQL语句
if (mysqli_query($link, $sql)) {
    echo "<h3> 关闭 $id 操作成功!</h3>";

    //库存调整SQL语句
    $sqlNumEdit = "UPDATE water SET water_num = water_num+$num WHERE water_id = $water";
    //echo $sqlNumEdit;
    mysqli_query($link, $sqlNumEdit);

    //告诉浏览器执行代码：等待3秒，并跳转文件
    header("refresh:3;url=ordering.php");

    echo "3秒后自动返回,或者 <a href='ordering.php'> 点击这里 </a> 立刻返回";

}



