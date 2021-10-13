<?php

/**
 * Description of AdminController
 * Controlador para el usuario que tiene privilegios de administrador.
 */
class AdminController extends DooController{
    var $data;
    // FIXME: Repair this for denied access to the no admin user.
    public function beforeRun($resource, $action){
        session_start();

        global $data;
        if(isset($_SESSION['user'])){
            $data['user'] = $_SESSION['user'];
        }else{
            $data['user'] = null;
        }

        //if not login, group = anonymous
        $role = (isset($_SESSION['user']['type'])) ? $_SESSION['user']['type'] : 'anonymous';
        //if user.type == 1 then admin
        if (isset($_SESSION['user']['type']) && $_SESSION['user']['type']== 1)
            $role = 'admin';
        //if user.type == 2 then member
        if (isset($_SESSION['user']['type']) && $_SESSION['user']['type']== 0)
            $role = 'member';

        //check against the ACL rules
        if($rs = $this->acl()->process($role, $resource, $action )){
            //echo $role .' is not allowed for '. $resource . ' '. $action;
            return $rs;
        }
    }

    /**
     * Se muestra la pagina principal del modulo de administracion
     * from: $route['*']['/admin']
     */

    public function index() {
        global $data;
        $data['baseurl'] = Doo::conf()->APP_URL;
		$data['disease'] = Doo::conf()->SITE;
        $data['title'] = 'Jobs ';
        /* FIXME: Make the posible FAQs*/
        $data['content'] = '<p>FIXME<b> You can do all this process:</b></p>
                            <p><a href="'.$data['baseurl'].'index.php/admin/adduser">Add a new user</a></p>
                            <p><a href="'.$data['baseurl'].'index.php/admin/updateuser/:username">Modify user</a></p>
                            <p><a href="'.$data['baseurl'].'index.php/admin/list_all_users">List all users</a></p>
                            ';
        $data['printr'] = '<p>You are visiting '.$_SERVER['REQUEST_URI'].'</p>';

        $data['username']   = Null;
        $data['password']   = Null;
        $data['nombres']    = Null;
        $data['apellidos']  = Null;
        $data['correo']     = Null;
        $data['telefono']   = Null;
        $data['status']     = Null;
        $data['type']       = Null;
        $this->view()->render('general_template', $data);

    }
    /**
     * To render the page for add a new user for the system
     * from: $route['*']['/admin/adduser']
     *
     */

    public function addUser(){
        global $data;
        // Create a new user.
        // Define status.
        $data['baseurl'] = Doo::conf()->APP_URL;
		$data['disease'] = Doo::conf()->SITE;
		if ( $_SESSION['user']['type']==1){
        $data['title']      = 'Agregar Paciente';
        $data['content']    = 'Puede agregar nuevos Pacientes';
		}
		if ( $_SESSION['user']['type']==2){
		$data['title']      = 'Agregar Usuario';
        $data['content']    = 'Puede agregar nuevos Laboratorios y/o Expertos';
		}	
        $data['save_user']  = $data['baseurl'].'index.php/admin/save_user';
        $data['method_flag']= 'addUser';
        $this->render('userform', $data);
        /*
        All Users must first get authorization before using the Leica microscope.
        Please fill-in the form below. (Starred items must be filled in.)
        Please note: This electronic form is used in lieu of an SU-13.  PI will be contacted to confirm billing
         */

    }

    /**
     * Change permission to a user o make it active or inactive.
     */

    public function updateUser(){
        global $data;
        // General page information.
        $data['baseurl'] = Doo::conf()->APP_URL;
		$data['disease'] = Doo::conf()->SITE;
        $data['title']      ='Actualizar datos';
        $data['content']    ='Puede modificar los datos pero NO borrarlos ni modificar el nombre de usuario';
        $data['save_user']  = $data['baseurl'].'index.php/admin/save_user'; // action form
        $data['method_flag']= 'updateUser';
        // User query for the update.
        Doo::loadModel('User');
        $user   = new User();

        // If the query is using the username.
        if(isset($this->params['username'])){
            $user->username=$this->params['username'];
            $result=Doo::db()->find($user, array('limit'=>1));
        }

        // User validation.
        if($result==Null){
            // FIXME: Convert to a pretty render.
            echo 'Usuario no existe<br/>';
        }else{
            //if user exists put parameters in the form
            $data['username']   = $result->username;
            $data['password']   = $result->password;
            $data['nombres']    = $result->nombres;
            $data['apellidos']  = $result->apellidos;
            $data['correo']     = $result->correo;
            $data['telefono']   = $result->telefono;
            $data['status']     = $result->status;
            $data['type']       = $result->type;

            $this->render('userform', $data);
        }
    }
    /**
     * Function to save changes in the user.
     * @todo: make data validation, e.g. cellphone must be numbers.
     */
    public function saveUser(){
        global $data;
        // FIXME: Essta haciendo cambios al usuario con user id = 1 memberuser.
        // If Post variables come from the create page then
        
        if(basename($_SERVER['HTTP_REFERER'])=='adduser'){
            $addusermethod=true;    // adduser.
            echo $_SERVER['HTTP_REFERER'];
        }else{
            $addusermethod=false;   // update user.
            echo $_SERVER['HTTP_REFERER'];
        }

        // Remove blank spaces in the post variables.
        foreach($_POST as $k=>$v){
            $_POST[$k] = trim($v);
        }

        if($_POST['url']=='http://' || empty($_POST['url']))
            unset($_POST['url']);

        // To save a new user with there corresponding parameters.
        Doo::loadModel('User');
        Doo::autoload('DooDbExpression');

        $user       = new User();
        $user->username = $_POST['username'];

        // Check if user exist.
        $result = Doo::db()->find($user, array('limit'=>1));

        // FIXME: Maybe was better a trigger for the time
           //Save changes time
        $user->password = $_POST['password'];
        $user->nombres  = $_POST['nombres'];
        $user->apellidos= $_POST['apellidos'];
        $user->correo   = $_POST['correo'];
        $user->telefono = $_POST['telefono'];
        $user->status   = $_POST['status'];
        $user->type     = $_POST['type'];
        
        // If user not exist.
        if($result==Null){
            // If method is adduser.
            if($addusermethod){
                
                $user->ts       = new DooDbExpression('NOW()');
                $user->insert();    // adduser to the system.
                // Render adduser confirmation
                $data['baseurl'] = Doo::conf()->APP_URL;
				$data['disease'] = Doo::conf()->SITE;
                $data['title']      = 'Confirmación de Usuario';
                $data['content']    = 'Usuario <span><b>'.$user->username.'</b></span> fue agregado satisfactoriamente.';
                $data['printr']     = '';
            }else{  // updateuser method
                // Render adduser not exists.
                $data['baseurl'] = Doo::conf()->APP_URL;
				$data['disease'] = Doo::conf()->SITE;
                $data['title']      = 'Error de Usuario';
                $data['content']    = 'Usuario <span><b>'.$user->username.'</b></span> no existe.';
                $data['printr']     = '';
            }
                
        }else{ // user exist.
            // If method is adduser.
            if($addusermethod){
                $data['baseurl'] = Doo::conf()->APP_URL;
				$data['disease'] = Doo::conf()->SITE;
                $data['title']      = 'Error de Usuario';
                $data['content']    = 'Usuario <span><b>'.$user->username.'</b></span> ya existe.';
                $data['printr']     = '';
            }else{   // updateuser method
                print_r($result->username);
                $user->username=$result->username;
                $user->update();
                $data['baseurl'] = Doo::conf()->APP_URL;
				$data['disease'] = Doo::conf()->SITE;
                $data['title']      = 'Actualización de Usuario';
                $data['content']    = 'Usuario <span><b>'.$user->username.'</b></span> fue actualizado satisfactoriamente.';
                $data['printr']     = '';
            }
        }
        // Render message
        $this->render('general_template', $data);
    }

    /**
     * Function to show all the users.
     */
    public function list_all_users(){
		
        global $data;
       
        Doo::loadModel('User');
		Doo::loadModel('Sample');
		
		Doo::autoload('DooDbExpression');
		
        $user = new User();
        
        $data['baseurl'] = Doo::conf()->APP_URL;
		$data['disease'] = Doo::conf()->SITE;
		
		if ($this->params['tipos']==0) {
        $data['title']      = 'Lista de Expertos'; $user->status=1; }
		if ($this->params['tipos']==1) {
        $data['title']      = 'Lista de Laboratorios'; $user->status=1; }
		if ($this->params['tipos']==3) {
        $data['title']      = 'Lista de Pacientes'; $user->status=$_SESSION['user']['username']; }
		
        //$data['listurl']    = $data['baseurl'].'index.php/admin/list_all_users/'.$this->params['tipos'];
		$data['ver']        = $this->params['tipos'];
		
		$data['users'] = $this->db()->find($user);
		
		$sample = new Sample();
		
		$i=0;
		$j=0;
		if ($_SESSION['user']['type']==2) {
			foreach($data['users'] as $x1=>$y1):
			if ($y1->type==0){ 
			$data['total'.$i.'asi'] = $sample->count(array("custom" => "WHERE (user_id LIKE '%".$y1->username."%' OR allexperts='Si') AND hide <> 1"));
			$data['total'.$i.'res'] = $sample->count(array("custom" => "WHERE status LIKE '%".$y1->username."%' AND hide <> 1"));$i++;
			}
			if ($y1->type==1){
			$data['total'.$j.'lab_all'] = $sample->count(array("custom" => "WHERE user_id LIKE '%".$y1->username."%'"));
			$data['total'.$j.'lab_new'] = $sample->count(array("custom" => "WHERE user_id LIKE '%".$y1->username."%' AND status IS NULL"));$j++;
			}
			endforeach;
		}
		
		if ($_SESSION['user']['type']==1) {
			foreach($data['users'] as $x1=>$y1):
			if ($y1->type==0){ 
			$data['total'.$i.'asi'] = $sample->count(array("custom" => "WHERE user_id LIKE '%*".$_SESSION['user']['username']."%' AND (user_id LIKE '%".$y1->username."%' OR allexperts='Si') AND hide <> 1"));
			$data['total'.$i.'res'] = $sample->count(array("custom" => "WHERE user_id LIKE '%*".$_SESSION['user']['username']."%' AND status LIKE '%".$y1->username."%' AND hide <> 1"));$i++;}
			endforeach;
		}
		
		
		if ($_POST['to']){
			
		include './protected/controller/SMTPClass.php';	
		
		$to = $_POST['to'];
		$from = Doo::conf()->SmtpUser;
		$subject = $data['disease'].": Alerta! Tiene muestras nuevas pendientes";
		$body = 'Para revisar sus muestras pendientes por favor ingrese a: '.$data['baseurl']."\n\n\n".'No responder este mail, Gracias';
		$SMTPMail = new SMTPClient (Doo::conf()->SmtpServer, Doo::conf()->SmtpPort, Doo::conf()->SmtpUser, Doo::conf()->SmtpPass, $from, $to, $subject, $body);
		$SMTPChat = $SMTPMail->SendMail();
		}
				
				$this->view()->render('list_all_users',$data);
	}
	
	
	/**
     * Cron sample for notify users tasks --------------------------------------------
     */
    public function cron_mail(){
		
        global $data;
       
        Doo::loadModel('User');
		Doo::loadModel('Sample');
		
		Doo::autoload('DooDbExpression');
		
        $user = new User();
        $user->status=1;
        
        $data['baseurl'] = Doo::conf()->APP_URL;
		$data['disease'] = Doo::conf()->SITE;
		$data['title']   = 'Notificador de muestras pendientes';
		$data['users']   = $this->db()->find($user);
		
		$sample = new Sample();
		
		$i=0;
		
		include './protected/controller/SMTPClass.php';	
		
		foreach($data['users'] as $x1=>$y1):
			if ($y1->type==0){ 
			$data['total_pen'] = $sample->count(array("custom" => "WHERE ( user_id LIKE '%".$y1->username."%' OR allexperts='Si') and (status not like '%".$y1->username."%' or status is null ) and hide <> 1"));
			
			
				if ($data['total_pen']>0) { 
				
				$to = $y1->correo;
				$from = Doo::conf()->SmtpUser;
				$subject = $data['disease'].": Tiene ".($data['total_pen'])." muestras nuevas pendientes";
				$body = $y1->nombres.', para revisar sus muestras pendientes por favor ingrese a: '.$data['baseurl']."\n\n\n".'No responder este mail, Gracias';
				$SMTPMail = new SMTPClient (Doo::conf()->SmtpServer, Doo::conf()->SmtpPort, Doo::conf()->SmtpUser, Doo::conf()->SmtpPass, $from, $to, $subject, $body);
				$SMTPChat = $SMTPMail->SendMail();
				
				$data['cron_envio'] = $y1->username." -> ".$y1->nombres." ".$y1->apellidos."</br>".$data['cron_envio'];
				} 
			
			}
			
		endforeach;
				
	$this->view()->render('cron_mail',$data);
	}
	
	
}
?>
