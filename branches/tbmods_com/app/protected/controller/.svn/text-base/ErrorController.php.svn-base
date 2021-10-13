<?php
/**
 * ErrorController
 * Feel free to change this and customize your own error message
 *
 */
class ErrorController extends DooController{

    public function index(){
        header('Location: '.Doo::conf()->APP_URL); 
  exit();
        
    }

    function loginRequire() {
                $data['baseurl'] = Doo::conf()->APP_URL;
				$data['disease'] = Doo::conf()->SITE;
                $data['title'] = 'Debe autenticarse!';
                $data['content'] = 'Acceso No permitido!';
                $data['printr'] = 'Debe autenticarse para entrar aquí.';
                $this->render('template', $data);
    }


}
?>