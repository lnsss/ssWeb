<?php

//包含连接数据库的公共文件
require_once("inc/conn.php");

$time = date('Y-m-d H:i:s');

// 判断表单是否合法提交(防止攻击)
if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token']) {
    //获取表单提交数据
    $staff_name = $_POST['staff_name'];
    $staff_pwd = $_POST['staff_pwd'];
    $staff_time = $_POST['staff_time'];
    $staff_phone = $_POST['staff_phone'];
    $staff_add = $_POST['staff_add'];
    $staff_note = $_POST['staff_note'];

    //执行查询的SQL语句
    $sqlNmd = "SELECT * FROM staff WHERE staff_name = '$staff_name'";
    $result = mysqli_query($link, $sqlNmd);

    //获取所有行数据,0无重名但不符合条件,1重名符合条件
    if (mysqli_num_rows($result)) {
        echo "<script>alert('该名称已存在,请更换!')</script>";   //通过js弹出窗口

    } else {
        //构建插入的SQL语句
        $sql = "INSERT INTO staff VALUES(null,'$staff_name','$staff_pwd','$staff_time','$staff_phone','$staff_add','$staff_note')";

        //判断SQL语句是否执行成功
        if (mysqli_query($link, $sql)) {
            echo "<script>alert('新配送员添加成功!')</script>";   //通过js弹出窗口
            header("refresh:0;url=ren-staff.php");
        }
    }

}

//产生表单验证随机字符串
$_SESSION['token'] = uniqid();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>嗖嗖送水</title>
</head>

<link rel="stylesheet" href="css/staticfile-bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/water-edit-go.css"/>

<script src="js/staticfile-jquery.js"></script>
<script src="js/staticfile-bootstrap.js"></script>

<body>

<!--头部框架开始-->
<div class="top">

    <a href="index.php" class="top-left"> </a>

    <div class="top-right">
        当前登录:<?php echo $_SESSION['admin_name'] ?>
        <a href="login-esc.php" style="color: #ffffff">(退出)</a>
    </div>

</div>
<!--头部框架结束-->

<div class="con">

    <!--左边<框架开始-->
    <div class="left">

        <div class="panel-group" id="accordion">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#collapse-1">
                            商品管理
                        </a>
                    </h4>
                </div>
                <div id="collapse-1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <P><a href="water-so.php">查找商品</a></P>
                        <p><a href="water-all.php">全部商品</a></p>
                        <p><a href="water-in.php">补货</a></p>
                        <p><a href="water-down.php">下架</a></p>
                        <p><a href="water-on.php">上架</a></p>
                        <p><a href="water-new.php">发布新品</a></p>
                        <p><a href="water-edit.php">修改商品</a></p>
                        <P><a href="water-auto.php">库存助理</a></P>
                        <P><a href="water-autoPuss.php">自动诊断</a></P>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#collapse-2">
                            订单管理
                        </a>
                    </h4>
                </div>
                <div id="collapse-2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p><a href="out-loading.php">等待配送</a></p>
                        <p><a href="out-ing.php">正在配送</a></p>
                        <p><a href="out-ok.php">送达订单</a></p>
                        <p><a href="out-close.php">失效订单</a></p>
                        <p><a href="out-good.php">有效订单</a></p>
                        <P><a href="out-so.php">查找订单</a></P>
                        <p><a href="out-all.php">全部订单</a></p>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#collapse-3">
                            销售统计
                        </a>
                    </h4>
                </div>
                <div id="collapse-3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p><a href="top-staff.php">配送员业绩</a></p>
                        <p><a href="top-water.php">产品销售榜</a></p>
                        <P><a href="top-client.php">客户购物榜</a></P>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#collapse-5">
                            人员管理
                        </a>
                    </h4>
                </div>
                <div id="collapse-5" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <P><a href="ren-client.php">客户管理</a></P>
                        <P><a href="ren-staff.php">配送员管理</a></P>
                        <P><a href="ren-supplier.php">供应商管理</a></P>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!--左边<框架结束-->

    <!--分开多一点-->

    <!--右边>框架开始-->
    <div class="right">

        <div style="text-align:center; padding-bottom: 10px;">
            <h3>人员管理—配送员管理</h3>
            哇哦！新员工来啦 o_O
        </div>

        <br>

        <div class="right-body">

            <form method="post" action="">

                <table width="600" bordercolor="#FFF" border="1" rules="all" align="center" cellpadding="5">

                    <tr>
                        <td width="120" align="right">用户名：</td>
                        <td><input type="text" name="staff_name"></td>
                        <td width="120" align="right">密码：</td>
                        <td><input type="text" name="staff_pwd"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td width="120" align="right">注册时间：</td>
                        <td><input type="text" name="staff_time" value="<?php echo $time ?>"></td>
                        <td width="120" align="right">手机号：</td>
                        <td><input type="text" name="staff_phone"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td width="120" align="right">地址：</td>
                        <td><input type="text" name="staff_add"></td>
                        <td width="120" align="right">备注：</td>
                        <td><input type="text" name="staff_note"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
                            <br>
                            <input type="submit" value=" 提 交 ">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                        </td>
                        <td>&nbsp;</td>
                    </tr>

                </table>

            </form>

        </div>

    </div>
    <!--右边>框架结束-->

</div>

</body>

</html>


<!--    <frameset cols="170px,*" frameborder="no">-->
<!--		<frame src="nBar.php">-->
<!--		<frame src="welcome.php" name ="ssWebAdminGO">-->
<!--    </frameset>-->


<!--<div class="col-md-6 mb-3">-->
<!--    <label for="firstName">商品名称</label>-->
<!--    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>-->
<!--</div>-->
<!--<div class="col-md-6 mb-3">-->
<!--    <label for="firstName">来源供应商编号</label>-->
<!--    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>-->
<!--</div>-->
<!--<div class="col-md-6 mb-3">-->
<!--    <label for="firstName">商品简介</label>-->
<!--    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>-->
<!--</div>-->
<!--<div class="col-md-6 mb-3">-->
<!--    <label for="firstName">商品图片</label>-->
<!--    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>-->
<!--</div>-->
<!--<div class="col-md-6 mb-3">-->
<!--    <label for="firstName">商品规格</label>-->
<!--    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>-->
<!--</div>-->
<!--<div class="col-md-6 mb-3">-->
<!--    <label for="firstName">商品类型</label>-->
<!--    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>-->
<!--</div>-->
<!--<div class="col-md-6 mb-3">-->
<!--    <label for="firstName">商品进价</label>-->
<!--    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>-->
<!--</div>-->
<!--<div class="col-md-6 mb-3">-->
<!--    <label for="firstName">商品售价</label>-->
<!--    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>-->
<!--</div>-->
<!--<div class="col-md-6 mb-3">-->
<!--    <label for="firstName">商品数量</label>-->
<!--    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>-->
<!--</div>-->
<!--<div class="col-md-6 mb-3">-->
<!--    <label for="firstName">商品备注</label>-->
<!--    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>-->
<!--</div>-->