<?php if( $data['user'] == Null ): ?>
      <!--  <form id="loginform" action="<?php //echo $data['baseurl']; ?>index.php/login" method="post">
            
                <label for="username">Usuario</label>
                <input name="username" id="username" type="text" maxlength="45" value="<?php // echo $_GET['userweb']; ?>"/>
                <label for="password">Contraseña</label>
                <input name="password" id="password" type="password" maxlength="45" value=""/>
                
                <input type="submit" value="Entrar" data-theme="e" data-inline="true" />
           
        </form>-->
    <?php else: ?>
        <form action="<?php echo $data['baseurl']; ?>index.php/logout" method="post" data-ajax="false">
                <p>Usuario: <strong><?php echo $data['user']['username']; ?></strong></p>
                <p> Bienvenido <?php echo $data['user']['nombres']." ".$data['user']['apellidos']; ?> </p>
                <p><input type="submit" value="Salir" data-mini="true" data-theme="e" data-inline="true"/></p>
        </form>
        
        <li data-role="list-divider">Menu</li>

		<?php if ($_SESSION['user']['type'] ==1) { ?>
        <li><a href="<?php echo $data['baseurl']; ?>index.php/jobs/sample/submit" rel="external">Agregar Muestra</a></li><?php } ?>
        
        <?php if ($_SESSION['user']['type'] <3) { ?>
        <li><a href="<?php echo $data['baseurl']; ?>index.php/jobs/sample/list_all/0/desc/////1" rel="external">Muestras Nuevas</a></li>
        <li><a href="<?php echo $data['baseurl']; ?>index.php/jobs/sample/list_all/1/desc/////1" rel="external">Muestras con resultado</a></li>
        <?php } ?>
        
        <?php if ($_SESSION['user']['type']==1 and $data['disease']=="CANCER DE CUELLO UTERINO") { ?>
        <li><a href="<?php echo $data['baseurl']; ?>index.php/jobs/sample/ccu_lamina" rel="external">Diagnóstico de Lámina</a></li><?php } ?>
        
        <?php if ($_SESSION['user']['type']==1 and $data['disease']<>"MELANOMA") { ?>
        <li><a href="<?php echo $data['baseurl']; ?>index.php/jobs/calibration/submit" rel="external">Agregar Calibración</a></li>
        <li><a href="<?php echo $data['baseurl']; ?>index.php/jobs/calibration/list_all" rel="external">Lista de Calibraciones</a></li><?php } ?>
        
        <?php if ($_SESSION['user']['type']==1 or $_SESSION['user']['type']==2) { ?>
            <li data-role="list-divider">Administración</li>
            <?php if ($_SESSION['user']['type']==2) { ?>
                <li><a href="<?php echo $data['baseurl']; ?>index.php/jobs/sample/cron_sample" rel="external">Reprocesador de Muestras</a></li>
                <li><a href="<?php echo $data['baseurl']; ?>index.php/admin/adduser" rel="external">Agregar Usuario</a></li>
                <li><a href="<?php echo $data['baseurl']; ?>index.php/admin/list_all_users/1" rel="external">Lista de Laboratorios</a></li>
            <?php } ?>
            <?php if ($_SESSION['user']['type']==1) { ?>
        	<li><a href="<?php echo $data['baseurl']; ?>index.php/admin/adduser" rel="external">Agregar Paciente</a></li>
            <li><a href="<?php echo $data['baseurl']; ?>index.php/admin/list_all_users/3" rel="external">Lista de Pacientes</a></li>
            <?php } ?>
        	<li><a href="<?php echo $data['baseurl']; ?>index.php/admin/list_all_users/0" rel="external">Lista de Expertos</a></li>
		    <?php if ($data['disease']=="TUBERCULOSIS" ) { ?>
            <li><a href="<?php echo $data['baseurl']; ?>global/img/formato-tbmods.pdf" rel="external">Descargar Formato PDF</a></li>
            <li><a href="<?php echo $data['baseurl']; ?>global/img/formato-tbmods.xlsx" rel="external">Descargar Formato XLS</a></li>
            <?php } ?>
            <?php if ($data['disease']=="MELANOMA" ) { ?>
            <li><a href="<?php echo $data['baseurl']; ?>global/img/formato-melanoma.pdf" rel="external">Descargar Formato</a></li>
            <?php } ?>
            <?php if ($data['disease']=="CANCER DE CUELLO UTERINO" ) { ?>
            <li><a href="<?php echo $data['baseurl']; ?>global/img/formato-ccu.pdf" rel="external">Descargar Formato PDF</a></li>
            <li><a href="<?php echo $data['baseurl']; ?>global/img/formato-ccu.xlsx" rel="external">Descargar Formato XLS</a></li>
            <?php } ?>   
            <?php if ($data['disease']=="VAGINOSIS" ) { ?>
            <li><a href="<?php echo $data['baseurl']; ?>global/img/formato-vaginosis.pdf" rel="external">Descargar Formato PDF</a></li>
            <li><a href="<?php echo $data['baseurl']; ?>global/img/formato-vaginosis.xlsx" rel="external">Descargar Formato XLS</a></li>
            <?php } ?>       
		<?php } ?>
        
        <li><a href="<?php echo $data['baseurl']; ?>index.php/admin/updateuser/id/<?php echo $data['user']['username']; ?>" rel="external">Mis Datos</a></li>
        
    <?php endif; ?>
<li> <div data-role="none" ><a href="http://190.40.222.75:8085/portal/" target="_blank"><img src="<?php echo $data['baseurl']; ?>global/img/logo2.jpg" /></a></div></li>
<li> <div data-role="none" ><img src="<?php echo $data['baseurl']; ?>global/img/logo1.jpg" /></div></li>
<li> <div data-role="none" ><a href="http://www.upch.edu.pe/portal/" target="_blank"><img src="<?php echo $data['baseurl']; ?>global/img/logo3.jpg" /></a></div></li>
