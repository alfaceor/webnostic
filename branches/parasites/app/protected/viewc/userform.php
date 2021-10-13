<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include "header.php"; ?>
</head>
<body>
    <?php include "topbar.php"; ?>
    <?php include "navbar.php"; ?>
    <div class="content">
        <h1><?php echo $data['title']; ?></h1>
        <!-- <p>The baseurl is <?php echo $data['baseurl']; ?></p> -->
        <p><span class="boldy"><?php echo $data['content']; ?></span></p>
        <p><?php echo debug($data['printr']); ?>
            <form id="userform" action="<?php echo $data['save_user']; ?>" method="post">
                
                <table>
                <tr>
                    <td>
                        username
                    </td>
                    <td>
                        <?php if( $data['method_flag']=='updateUser' ): ?>
                        <input id="username" readonly="readonly" type="text" name="username" value="<?php echo $data['username']; ?>" />
                        <?php else: ?>
                        <input id="username" type="text" name="username" value="<?php echo $data['username']; ?>" />
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        password
                    </td>
                    <td>
                        <input id="password" type="password" name="password" value="<?php echo $data['password']; ?>" />
                    </td>
                </tr>

                <tr>
                    <td>
                        name
                    </td>
                    <td>
                        <input id="nombres" type="text" name="nombres"  value="<?php echo $data['nombres']; ?>" />
                    </td>
                </tr>

                <tr>
                    <td>
                        lastname
                    </td>
                    <td>
                        <input id="apellidos" type="text" name="apellidos" value="<?php echo $data['apellidos']; ?>" />
                    </td>
                </tr>

                <tr>
                    <td>
                        email
                    </td>
                    <td>
                        <input id="correo" type="text" name="correo" value="<?php echo $data['correo']; ?>" />
                    </td>
                </tr>

                <tr>
                    <td>
                        cellphone
                    </td>
                    <td>
                        <input id="telefono" type="text" name="telefono" value="<?php echo $data['telefono']; ?>" />
                    </td>
                </tr>

                <tr>
                    <td>
                        usertype
                    </td>
                    <td>
                        <input type="radio" name="type" value="0" checked /> Member<br />
                        <input type="radio" name="type" value="1" /> Admin
                    </td>
                </tr>

                <tr>
                    <td>
                        userstatus
                    </td>
                    <td>
                        <input type="radio" name="status" value="1" checked /> Active <br />
                        <input type="radio" name="status" value="0" /> Inactive
                    </td>
                </tr>
                </table>
                <input type="submit" value="save"/>
            </form>
        </p>
        <span class="totop"><a href="javascript:history.back()">BACK TO LAST PAGE</a></span>
    </div>
</body>
</html>
