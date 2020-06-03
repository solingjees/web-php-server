<?php

//引入数据库连接配置
include './utils/conn.php';
include './utils/auth.php';
header('Content-type:text/html;charset=utf-8');

$arr = [];
if (!auth_login()) {
    $arr = [
        "result" => 0,
        "msg" => "尚未登录"
    ];
} else if (!auth_root()) {
    $arr = [
        "result" => 0,
        "msg" => "您没有权限"
    ];
} else {
    //鉴权成功
    $activityId = $_POST['activityId'];
    $account = $_SESSION["account"];
    //构造mysql语句
    $sql0 = "select * from activities where id = ".$activityId;
    $rs0 = mysqli_query($conn,$sql0);
    if(mysqli_num_rows($rs0) > 0){
        // 输出数据
        while($row = mysqli_fetch_assoc($rs0)) {
            if($row["isPass"] === "1"){
                $arr = [
                    "result"=>0,
                    "data"=>[
                        "approver"=>$row["approver"]
                    ],
                    "msg"=>"该项目已经被审批"
                ];
            }
            else{
                //该项目并咩有被审批
                $sql = "update activities set isPass = 1,approver='".$account."' where id =".$activityId;
                $rs = mysqli_query($conn,$sql);
                if (mysqli_affected_rows($conn) > 0) {
                    $arr = [
                        "result" => 1,
                        "msg" => '活动审批成功'
                    ];
                } else {
                    $arr = [
                        "result" => 0,
                        "msg" => "活动审批失败"
                    ];
                }
            }
        }
    }else {
        //不存在该项目
        $arr = [
            "result"=>0,
            "msg"=>"该项目不存在"
        ];
    }

}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);
?>