<?php
//引入数据库连接配置
include './utils/conn.php';
//启动session会话
session_start();
//设置头部
header('Content-type:text/html;charset=utf-8');

//获取数据
$account = $_POST['account'];
$password = $_POST['password'];
$isAdmin = $_POST['isAdmin'];

//验证是否有该账户
$sql = 'select * from users where account = ? and isAdmin = ?';
//生成预编译语句
$stmt = mysqli_prepare( $conn, $sql );
//绑定参数
mysqli_stmt_bind_param( $stmt, 'si', $account,$isAdmin);
//准备执行语句
mysqli_stmt_execute( $stmt );
//获取返回数据
$rs = mysqli_stmt_get_result( $stmt );
//读取数据库数据
if(mysqli_num_rows($rs) > 0){
    //说明数据库该用户存在
    //session中存储该用户是管理员
    $_SESSION['isAdmin'] = $isAdmin;
    //session中存储该用户已经登录
    $_SESSION['login'] = TRUE;
    $_SESSION['account'] = $account;
    $arr = [
        "result" => 1,
        "msg" => "登录成功"
    ];
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
}
else{
    $_SESSION['login'] = FALSE;
    $arr = [
        "result"=>0,
        "msg"=>"登录失败"
    ];
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
}
// echo $_SESSION['isAdmin'];
// echo $_SESSION['login'];
mysqli_close($conn);
?>