<?php
/**
 * 
 * MainController
 * 
 * @author Carlos Olivares
 */

class MainController extends DooController{

    public function index(){
        session_start();
        $data['title']='Webnostic Home';
                if(isset($_SESSION['user'])){
                        $data['user'] = $_SESSION['user'];
                }else{
                        $data['user'] = null;
                }
                
        $data['baseurl'] = Doo::conf()->APP_URL;
        $this->view()->render('home', $data);
    }
    /**
     * login function 
     */

     public function login(){
        if(isset($_POST['username']) && isset($_POST['password']) ){
            $_POST['username'] = trim($_POST['username']);
            $_POST['password'] = trim($_POST['password']);

            //check User existance in DB, if so start session and redirect to home page.
            if(!empty($_POST['username']) && !empty($_POST['password'])){
                $user = Doo::loadModel('User', true);
                $user->username = $_POST['username'];
                $user->password = $_POST['password'];
                $user = $this->db()->find($user, array('limit'=>1));

                if($user){
                    session_start();
                    unset($_SESSION['user']);
                    $_SESSION['user'] = array(
                        'id'        => $user->id,
                        'username'  => $user->username,
                        'nombres'   => $user->nombres,
                        'apellidos' => $user->apellidos,
                        'correo'    => $user->correo,
                        'telefono'  => $user->telefono,
                        'status'    => $user->status,
                        'type'      => $user->type
                         );
                    return Doo::conf()->APP_URL;
                }
            }
            // FIXME: mostrar una mejor respuesta al fallo del login.
            $data['baseurl'] = Doo::conf()->APP_URL;
            $data['title'] = 'Failed to login!';
            $data['content'] = 'User with details below not found';
            $data['printr'] = $_POST;
            $this->render('template', $data);
        }
    }

    public function logout(){
            session_start();
            unset($_SESSION['user']);
            session_destroy();
            return Doo::conf()->APP_URL;
    }

    /**
     * TODO: Render FAQs page
     */

    public function faqs(){
        $data['baseurl'] = Doo::conf()->APP_URL;
        $data['title'] = 'Preguntas frecuentes';
        /* FIXME: Make the posible FAQs*/
        $data['content'] = '<p> FIXME: Presentamos un listado de las preguntas mas frecuentes sobre<b> comming soon</b></p> ';
        $data['printr'] = '<p>You a                                        re visiting '.$_SERVER['REQUEST_URI'].'</p>';
        //var_dump($data);
        $this->view()->render('general_template', $data);
    }
    /**
     * TODO: Information about the disease and how to use the web page.
     */
    public function information(){
        $data['baseurl'] = Doo::conf()->APP_URL;
        $data['title'] = 'Disease Information';
        /* FIXME: Make the posible FAQs*/
        $data['content'] = '<p>FIXME<b> comming soon</b></p> ';
        $data['printr'] = '<p>You are visiting '.$_SERVER['REQUEST_URI'].'</p>';
        //var_dump($data);
        $this->view()->render('general_template', $data);
    }
    /**
     * TODO: Make a contact form (create a mail account for this)
     */
    public function contactus(){
        $data['baseurl'] = Doo::conf()->APP_URL;
        $data['title'] = 'Contact us';
        /* FIXME: Make the posible FAQs*/
        $data['content'] = '<p>FIXME<b> form to send mail. The physical address, mail contact,etc.</b></p> ';
        $data['printr'] = '<p>You are visiting '.$_SERVER['REQUEST_URI'].'</p>';
        //var_dump($data);
        $this->view()->render('general_template', $data);
    }
/*
        
//------------------------- I can delete this, but not rigth now. -------------
    public function index(){
                //Just replace these
                Doo::loadCore('app/DooSiteMagic');
                DooSiteMagic::displayHome();
    }
*/
        public function allurl(){
                Doo::loadCore('app/DooSiteMagic');
                DooSiteMagic::showAllUrl();
        }

    public function debug(){
                Doo::loadCore('app/DooSiteMagic');
                DooSiteMagic::showDebug($this->params['filename']);
    }

        public function gen_sitemap_controller(){
                //This will replace the routes.conf.php file
                Doo::loadCore('app/DooSiteMagic');
                DooSiteMagic::buildSitemap(true);
                DooSiteMagic::buildSite();
        }

        public function gen_sitemap(){
                //This will write a new file,  routes2.conf.php file
                Doo::loadCore('app/DooSiteMagic');
                DooSiteMagic::buildSitemap();
        }

        public function gen_site(){
                Doo::loadCore('app/DooSiteMagic');
                DooSiteMagic::buildSite();
        }

    public function gen_model(){
        Doo::loadCore('db/DooModelGen');
        DooModelGen::gen_mysql();
    }

}
?>