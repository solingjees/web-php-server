<?php

////引入数据库连接配置
//include './utils/conn.php';
//include './utils/auth.php';
//header('Content-type:text/html;charset=utf-8');
//
//$arr = [];
//    //鉴权成功
//    $title = $_POST['title'];
//    $content = $_POST['content'];
//    $startDate = $_POST['startDate'];
//    $endDate = $_POST['endDate'];
//    $enlistStartDate = $_POST['enlistStartDate'];
//    $enlistEndDate = $_POST['enlistEndDate'];
//
//    //构造mysql语句
//    $sql = 'insert into activities (subject,content,startDate,endDate,enlistStartDate,enlistEndDate,isPass,isEnd,creator) values ("?","?","?","?","?","?",0,0,"' . $_SESSION['account'] . '")';
//    $stmt = mysqli_prepare($conn, $sql);
//    mysqli_stmt_bind_param($stmt, 'ssssss', $title, $content, $startDate, $endDate, $enlistStartDate, $enlistEndDate);
//    mysqli_stmt_execute($stmt);
//    $rs = mysqli_stmt_get_result($stmt);
//    if (mysqli_affected_rows($conn) > 0) {
//        $arr = [
//            "result" => 1,
//            "msg" => '活动添加成功'
//        ];
//    } else {
//        $arr = [
//            "result" => 0,
//            "msg" => "活动添加失败"
//        ];
//    }
//}
//
//echo json_encode($arr, JSON_UNESCAPED_UNICODE);
//mysqli_close($conn);
//?>