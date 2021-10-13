<div id="topbar">
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
                <p class="normal">Hola, <strong><?php echo $data['user']['username']; ?></strong>! Usted es <?php echo $data['user']['nombres']; ?> <?php echo $data['user']['apellidos']; ?> <input type="submit" value="Logout"/></p>
        </form>
    <?php endif; ?>
</div>

