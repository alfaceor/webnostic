<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "header.php"; ?>
</head>
<body>
<?php include "navbar.php"; ?>
<div class="content">
    <h1>Bienvenidos a Webnostic </h1>
    <h2>Portal de integrado de diagnostico </h2>
    <p> <?php echo $data['user']['username']; ?> </p>
    <?php if( $data['user'] == Null ): ?>
        <form id="loginform" action="<?php echo $data['baseurl']; ?>index.php/login" method="post">
            <div style="float:left">
                <span class="normal">Usuario:</span>
                <input name="username" type="text" style="width:100px;" maxlength="64" value=""/>
                <span class="normal">Contrase&ntilde;a:</span>
                <input name="password" type="password" style="width:100px;" maxlength="64" value=""/>
                <br/>
            </div>
            <div style="float:left">
                <input type="submit" value="Login" style="margin-left:10px;margin-top:0px;width:90px;height:30px;" />
            </div>
        </form>
    <?php else: ?>
        <form action="<?php echo $data['baseurl']; ?>index.php/logout" method="post">
                <p class="normal">Hi, <strong><?php echo $data['user']['username']; ?></strong>! You are a <?php echo $data['user']['nombres']; ?> <?php echo $data['user']['apellidos']; ?> <input type="submit" value="Logout"/></p>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
