<?php

/**
 * Description of AdminController
 * Controlador para el usuario que tiene privilegios de administrador.
 * @author Carlos Olivares - alfaceor@gmail.com
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
        $data['title'] = 'Jobs ';
        /* FIXME: Make the posible FAQs*/
        $data['content'] = '<p>FIXME<b> You can do all this process:</b></p>
                            <p><a href="'.$data['baseurl'].'index.php/admin/adduser">Add a new user</a></p>
                            <p><a href="'.$data['baseurl'].'index.php/admin/updateuser/:iduser">Modify user</a></p>
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
        $data['baseurl']    = Doo::conf()->APP_URL;
        $data['title']      = 'Create a new user';
        $data['content']    = 'All Users must first get authorization before
                              using the diagnostic system.';
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
        $data['baseurl']    = Doo::conf()->APP_URL;
        $data['title']      ='Update user';
        $data['content']    ='You can change the user parameters,
                            <span>You can activate o deactivate a user,
                            but cant deleted  </span>.';
        $data['save_user']  = $data['baseurl'].'index.php/admin/save_user'; // action form
        $data['method_flag']= 'updateUser';
        // User query for the update.
        Doo::loadModel('User');
        $user   = new User();

        // If the query is using the id.
        if(isset($this->params['iduser'])){
            // find the user corresponding to that iduser.
            $user->id=$this->params['iduser'];
            $result=Doo::db()->find($user, array('limit'=>1));
        }

        // If the query is using the username.
        if(isset($this->params['username'])){
            $user->username=$this->params['username'];
            $result=Doo::db()->find($user, array('limit'=>1));
        }

        // User validation.
        if($result==Null){
            // FIXME: Convert to a pretty render.
            echo 'User not exits<br/>';
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
                $data['baseurl']    = Doo::conf()->APP_URL;
                $data['title']      = 'User confirmation';
                $data['content']    = 'User <span><b>'.$user->username.'</b></span> has been added successfully';
                $data['printr']     = '';
            }else{  // updateuser method
                // Render adduser not exists.
                $data['baseurl']    = Doo::conf()->APP_URL;
                $data['title']      = 'User error';
                $data['content']    = 'User <span><b>'.$user->username.'</b></span> not existis';
                $data['printr']     = '';
            }
                
        }else{ // user exist.
            // If method is adduser.
            if($addusermethod){
                $data['baseurl']    = Doo::conf()->APP_URL;
                $data['title']      = 'User error';
                $data['content']    = 'User <span><b>'.$user->username.'</b></span> exist already.';
                $data['printr']     = '';
            }else{   // updateuser method
                print_r($result->id);
                $user->id=$result->id;
                $user->update();
                $data['baseurl']    = Doo::conf()->APP_URL;
                $data['title']      = 'User update';
                $data['content']    = 'User <span><b>'.$user->username.'</b></span> was updated successfully.';
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
        Doo::loadHelper('DooPager');
        Doo::loadModel('User');

        $user = new User();
        $user->status=1;
        $totalpages= $user->count();    // Total number of users.
        $data['baseurl']= Doo::conf()->APP_URL;
        $data['title']='Users list';
        $data['listurl']= $data['baseurl'].'index.php/admin/list_all_users';
        
        $pager = new DooPager($data['listurl'], $totalpages, 4, 7);
        $page = intval($this->params['pindex']);

        if(isset($this->params['pindex']) && $this->params['pindex']>0)
            $pager->paginate($page);
        else
            $pager->paginate(1);
/*
        $data['users'] = $user->relateStatus(
                                    array(
                                        'limit'=>$pager->limit,
                                        'asc'=>'tag.name'
                                        )
                                );
*/
        $options['limit']=$pager->limit;
        $data['users'] = $this->db()->find( $user, $options );
        //$data['users'] = $user->find(array('limit'=>$pager->limit));
        //$data['users']=array('john','doo','marie');
        // Pager settings
        $pager->defaultCss;
        $pager->components['prev_link'];
        $data['pager'] =$pager->output;
        //echo $pager->components['page_size'];
        $this->view()->render('list_all_users',$data);
    }
}
?>
