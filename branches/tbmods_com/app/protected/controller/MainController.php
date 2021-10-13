<?php
/**
 * 
 * MainController
 * Feel free to delete the methods and replace them with your own code.
 *
 */
class MainController extends DooController{

    public function index(){
        session_start();
		$data['baseurl'] = Doo::conf()->APP_URL;
		$data['disease'] = Doo::conf()->SITE;
        $data['title']='Inicio';
                if(isset($_SESSION['user'])){
                        $data['user'] = $_SESSION['user'];
                }else{
                        $data['user'] = null;
                }
                
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
                        'id'        => $user->username,
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
			$data['disease'] = Doo::conf()->SITE;
            $data['title'] = 'Error de autenticación!';
            $data['content'] = 'Usuario no encontrado, verifique sus datos de acceso';
            $data['printr'] = $_POST;
            
        } $this->render('template', $data);
    }

    public function logout(){
            session_start();
            unset($_SESSION['user']);
            session_destroy();
            return Doo::conf()->APP_URL;
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