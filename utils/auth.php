<?php
session_start();

//登录鉴权
function auth_login(){
    return $_SESSION["login"] === TRUE;
}

//管理员的鉴权
function auth_root(){
    return $_SESSION["isAdmin"] === "1";
}
?>