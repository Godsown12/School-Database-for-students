<?php
include "include/header.php";
function sanitize($dirty){
    return htmlentities($dirty, ENT_QUOTES, "UTF-8");
}
$username=((isset($_POST['username']))?sanitize($_POST['username']):'');
$username = trim($username);
$password=((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$display= '';
//$passwordHash = password_hash('ict2021', PASSWORD_DEFAULT);
//echo($passwordHash);
if ($_POST) {
    if(empty($username) || empty($password)){
        $display='It is empty';
    }else{
        $sql = $conn->query("SELECT * FROM user WHERE userName = '$username'");
        $checkRow = mysqli_num_rows($sql);
        $result = mysqli_fetch_assoc($sql);
        if($checkRow < 1){
            $display = 'UserName does is not correct';
        }elseif(!password_verify($password , $result['password'])){
            $display = "Password is incorrect";
        }else{
            $login = $result['users_id'];
            $_SESSION['login'] = $login;
            $_SESSION['welcome'] = 'welcome';
            header('Location: index.php');
        }
    }

}
?>
<div class="containerrr">   
    <div class="login-main">
        <div class="form">
            <form action="login.php" method="post">
                <h6>Login Admin:</h6>
                <h6 class="error"><?=$display;?></h6>
                <div class="form-group">
                    <input type="text" name="username" id="username" placeholder="UserName" class="form-control">
                </div>
                </br>
                <div class="form-group">
                    <input type="text" name="password" id="password" placeholder="Password" class="form-control">
                </div>
                </br>
                <div class="form-group">
                    <button type="submit"  name="submit" class="form-control">Enter</button>
                </div>
            </form>
        </div>
    </div> 
</div>