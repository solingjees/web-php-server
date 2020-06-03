<?php
//引入数据库连接配置
include './utils/conn.php';
header('Content-type:text/html;charset=utf-8');
//获取post请求中的account
$account = $_POST['account'];
//获取post请求中的password
$password = $_POST['password'];
//获取post请求中的name
$name = $_POST['name'];
//检查数据库中是否有该用户
//构造sql语句
//生成sql语句模版
$sql = 'select * from users where account = ?';
//生成预编译语句
$stmt = mysqli_prepare( $conn, $sql );
//绑定参数
mysqli_stmt_bind_param( $stmt, 's', $account);
//准备执行语句
mysqli_stmt_execute( $stmt );
//获取返回数据
$rs = mysqli_stmt_get_result( $stmt );
//读取数据库数据
if(mysqli_num_rows($rs) > 0){
    //说明数据库已经有该用户了
    $arr = [
        "result" => 0,
        "msg" => "该用户已存在"
    ];
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
}
else{
    //将该用户的信息放入数据库
    $sql1 = 'insert into users (account,name,password,isAdmin) values ("'.$account.'","'.$name.'","'.$password.'",0)';
    echo $sql1;
    if(mysqli_query($conn,$sql1)){
        $arr = [
            "result"=>1,
            "msg"=>"注册成功"
        ];
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);
    }else{
        $arr = [
            "result"=>0,
            "msg"=>"注册失败"
        ];
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);
    }
}
mysqli_close($conn);
?>