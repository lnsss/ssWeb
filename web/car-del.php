<?php
/**
 * Created by PhpStorm.
 * User: lns
 * Date: 2019/4/19
 * Time: 01:38
 */

//包含连接数据库的公共代码
require_once("../inc/conn.php");

//获取地址栏传递的ID
$id = $_GET['id'];

//获取该客户
$userId = $_SESSION['user_id'];

//构建删除的SQL语句
$sql = "DELETE FROM car WHERE car_id = $id AND client_id = $userId";

//执行SQL语句
if (mysqli_query($link, $sql)) {
    echo "<h3> 删除 $id 操作成功!</h3>";

    //告诉浏览器执行代码：等待3秒，并跳转文件
    header("refresh:3;url=car.php");

    echo "3秒后自动返回,或者 <a href='car.php'> 点击这里 </a> 立刻返回";

}
