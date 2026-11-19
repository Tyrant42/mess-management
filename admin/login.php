<?php require '../config.php'; $m='';
if($_POST){$r=q("SELECT * FROM admin WHERE username=?","s",$_POST['username']);
if($r&&password_verify($_POST['password'],$r[0]['password'])){$_SESSION['aid']=$r[0]['admin_id'];header("Location: index.php");exit;}$m="Wrong username or password.";}
head("Admin Login",'x'); if($m)echo "<div class='msg'>$m</div>"; ?>
<form method="post"><input name="username" placeholder="Username" required><input type="password" name="password" placeholder="Password" required><button>Login</button></form>
<?php foot();