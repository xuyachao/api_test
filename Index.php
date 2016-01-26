<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // tag是接口请求时post的值（方法名称），用来区别调用方法
    $tag = $_POST['tag'];
 
    //引用DB_Functions.php
    require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
 
    // 定义输入数组
    $response = array("tag" => $tag, "error" => FALSE);
 
    // 判断tag值
    if ($tag == 'login') {
        //获取login方法的post参数
        $email = $_POST['email'];
        $password = $_POST['password'];
 
        // 通过email 和password获取用户信息
        $user = $db->getUserByEmailAndPassword($email, $password);
        if ($user != false) {
            //找到用户信息
            $response["error"] = FALSE;
            $response["uid"] = $user["unique_id"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["created_at"] = $user["created_at"];
            $response["user"]["updated_at"] = $user["updated_at"];
            echo json_encode($response);
        } else {
            //没有找到用户信息
            //输出错误信息
            $response["error"] = TRUE;
            $response["error_msg"] = "帐号或密码不正确!";
            echo json_encode($response);
        }
    } else if ($tag == 'register') {
        //注册帐号
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        // 判断用户是否存在
        if ($db->isUserExisted($email)) {
            // 如果用户存在就返错误提示
            $response["error"] = TRUE;
            $response["error_msg"] = "用户已存在";
            echo json_encode($response);
        } else {
            // 新增用户
            $user = $db->storeUser($name, $email, $password);
            if ($user) {
                //新增成功返回用户信息
                $response["error"] = FALSE;
                $response["uid"] = $user["unique_id"];
                $response["user"]["name"] = $user["name"];
                $response["user"]["email"] = $user["email"];
                $response["user"]["created_at"] = $user["created_at"];
                $response["user"]["updated_at"] = $user["updated_at"];
                echo json_encode($response);
            } else {
                // 新增失败，返回错误信息
                $response["error"] = TRUE;
                $response["error_msg"] = "服务器繁忙，操作失败";
                echo json_encode($response);
            }
        }
    } else {
        // tag值无效时
        $response["error"] = TRUE;
        $response["error_msg"] = "未找到您要的方法";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "您的参数不正确!";
    echo json_encode($response);
}

?>