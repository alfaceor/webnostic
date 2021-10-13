<?php
//ini_set('display_errors',1);
//ini_set('display_startup_errors',1);
//error_reporting(-1);

//define('IMAGE_PATH_SAMPLE', 'C:\Users\Augusto\Documents\xampp\htdocs\_tbmods\app\data\photos\sample');
define('IMAGE_PATH_SAMPLE', '/var/www'.Doo::conf()->SUBFOLDER.'data/photos/sample');

class SampleController extends DooController {
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
     * Function to submit a SAMPLE job.
     */
    function submit() {
        //echo 'You are visiting '.$_SERVER['REQUEST_URI'];
        global $data;
        $data['baseurl'] = Doo::conf()->APP_URL;
		$data['disease'] = Doo::conf()->SITE;
		$data['title']   = 'Agregar Muestra';
        $data['jobtype'] = 'muestra';
        $data['action']  = $data['baseurl'].'index.php/jobs/sample/save';
        $data['more_params'] = false;

        // Search for the corresponding calibration data
        Doo::loadModel('Calibration');
        $calibration = new Calibration();
		
        if ($_SESSION['user']['type']==1) $calibration->user_id = $_SESSION['user']['username'];
		
        $calibration->status_id = '3';
        $data['calibrations']   = $this->db()->find($calibration, array("where" => "value <> '-nan' AND hide <> 1"));

		 // Search for the corresponding user Paciente
        Doo::loadModel('User');
        $user = new User();
		
        if ($_SESSION['user']['type']==1) $user->status = $_SESSION['user']['username'];
		// $user->telefono<>""; Pacientes con telefono ----------------------------------
        $user->type = '3';
        $data['pacientes']   = $this->db()->find($user);
		
        $this->view()->render('newjob', $data);
    }

    /**
     * To save sample image to upload and diagnostic.
     */
    function save(){
        global $data;
        // Action for the form newjob
        // Remove blank spaces in the post variables.
        foreach($_POST as $k=>$v){
            $_POST[$k] = trim($v);
        }

        if($_POST['url']=='http://' || empty($_POST['url']))
            unset($_POST['url']);
			
		if ($_FILES['uploadedfile0']['tmp_name'] <> "" and ($_POST['paciente']<> "" or $_SESSION['user']['username']=="laboratorio1")) { //--- validate all empty fields------------------------------------------------------------
			// To save a new calibration with there corresponding parameters.
			Doo::loadModel('Sample');
			Doo::loadModel('User');
			Doo::loadModel('Ccu_lamina');
			
			Doo::autoload('DooDbExpression');
			$data['disease'] = Doo::conf()->SITE;
			
			$value_describ = explode("|", $_POST['calibration_value']);
			
			$user = new User();
			
			// Random 3 user (expertos) access only for role 1 (labs) and except ´laboratorio1´ -----------------------------------------------------------------------------
			if ($_SESSION['user']['type']==1 and $_SESSION['user']['username']<>"laboratorio1") { 
				$data['randuser']   = $this->db()->find($user, array("where" => "type = 0","custom" => "ORDER BY rand() LIMIT 3"));
				foreach($data['randuser'] as $k1=>$v1):
				$data['expertos']=$v1->username."|".$data['expertos'];
				endforeach;
			}
			
			$expertos = '*'.$_SESSION['user']['username']."|".$_POST['paciente']."|".$data['expertos'];
			
			for ($i = 0; $i < 10; $i++) {
			if ($_FILES['uploadedfile'.$i]['tmp_name'] <> "") {
				$sample     = new Sample();
				$sample->calibration_value  = $value_describ[0]; // get value calibration -----
				$sample->calibration_descr  = $value_describ[1]; // get describtion calibration -----
				$sample->user_id			= $expertos;
				
				if ($data['disease']=="MELANOMA") {
				$sample->mela_edad			= $_POST['mela_edad'.$i];
				$sample->mela_tiem			= $_POST['mela_tiem'.$i];
				$sample->mela_mole			= $_POST['mela_mole'.$i];
				$sample->mela_ubic			= $_POST['mela_ubic'.$i];
				}
				
				if ($data['disease']=="TUBERCULOSIS") {
				$sample->tb_muestra			= $_POST['tb_muestra'];
				$sample->tb_cultivo			= $_POST['tb_cultivo'];
				$sample->tb_pozo			= $_POST['tb_pozo'];
				$sample->tb_diagnos			= $_POST['tb_diagnos'];
				$sample->tb_procesa			= $_POST['tb_procesa'];
				$sample->tb_foto			= $_POST['tb_foto'];
				}
				
				if ($data['disease']=="CANCER DE CUELLO UTERINO") {
				$sample->ccu_lamina			= $_POST['ccu_lamina'];
				$sample->ccu_fur			= $_POST['ccu_fur'];
				$sample->ccu_edad			= $_POST['ccu_edad'];
				$sample->ccu_pap			= $_POST['ccu_pap'];
				$sample->ccu_dxpap			= $_POST['ccu_dxpap'];
				$sample->ccu_gp			    = $_POST['ccu_gp'];
				$sample->ccu_lacta			= $_POST['ccu_lacta'];
				$sample->ccu_gesta			= $_POST['ccu_gesta'];
				$sample->ccu_mac			= $_POST['ccu_mac'];
				$sample->ccu_antece			= $_POST['ccu_antece'];
				$sample->ccu_per			= $_POST['ccu_per'];
				}
				
				if ($data['disease']=="VAGINOSIS") {
				$sample->vag_flu			= $_POST['vag_flu'];
				$sample->vag_can			= $_POST['vag_can'];
				$sample->vag_fet			= $_POST['vag_fet'];
				$sample->vag_ami			= $_POST['vag_ami'];
				$sample->vag_sec			= $_POST['vag_sec'];
				$sample->vag_cel			= $_POST['vag_cel'];
				$sample->vag_pru			= $_POST['vag_pru'];
				$sample->vag_irr			= $_POST['vag_irr'];
				}
				
				$sample->status_id          = '1';
				$sample->imagepath          = 'data/photos/sample/'.$_SESSION['user']['username'];
				
				// Insert in the database
				$result_id = $sample->insert();
				
				// create the image filename
				$infoimagen            = pathinfo($_FILES['uploadedfile'.$i]['name']);
				$sample->originame     = $infoimagen['filename'];
				$sample->imagename     = $_SESSION['user']['username'].'-'.$result_id.'.jpg';
				$image_filename		   = IMAGE_PATH_SAMPLE.'/'.$_SESSION['user']['username'].'/'.$sample->imagename;
				// Save the image in the filesystem
			$folder = IMAGE_PATH_SAMPLE.'/'.$_SESSION['user']['username']; 
			if(!is_dir($folder)) mkdir($folder);
		
				if(move_uploaded_file($_FILES['uploadedfile'.$i]['tmp_name'],$image_filename)){
					// Update the database.
					$sample->id=$result_id;
					$sample->update();
				}
			}
			}
		
			// make and update to the database
			$data['baseurl'] = Doo::conf()->APP_URL;
			$data['disease'] = Doo::conf()->SITE;
			$data['title']      = 'Muestra';
			$expos = explode("|", $expertos);
			$data['content'] = 'Imágenes cargadas satisfactoriamente:</br></br><u>Expertos Asignados: </u></br>'.$expos[2].", ".$expos[3].", ".$expos[4];
			
			$data['printr']     = "Procesando imágen, por favor espere el resultado <a href='".$data['baseurl']."index.php/jobs/sample/list_all/0/desc/////1' rel='external'> Aquí </a> <a href='".$data['baseurl']."index.php/jobs/sample/submit' data-role='button' data-theme='b' data-inline='true' rel='external'>Agregar otra muestra</a> </p>";
			
			$lamina = new Ccu_lamina();
			$hay_lamina =  $lamina->count(array("where" => "lam = '".$_POST['ccu_lamina']."'"));
			if ($hay_lamina <>1) {
			
				$new_lamina = new Ccu_lamina();
				$new_lamina->lam  = $_POST['ccu_lamina']; // get value lam -----
				$new_lamina->lab  = $_SESSION['user']['username'];
				$new_lamina->insert();
				
				$user2 = new User();
				$user2->username=$_POST['paciente'];
				$result=Doo::db()->find($user2, array('limit'=>1));
				
				//------------------------------ envia sms a paciente -----------------------------
				if ($result->telefono<>"") {
				
					require("./protected/viewc/twilio/Services/Twilio.php");
		 
					$account_sid = 'AC8b29a897814b0aa0fd87e9ff5eae5035'; 
					$auth_token = 'e975449427c0731443c98d90c3694231'; 
					$client = new Services_Twilio($account_sid, $auth_token); 
					 
					$client->account->messages->create(array( 
						'To' => "+51".$result->telefono, 
						'From' => "+12017316903", 
						'Body' => "Estimado(a) ".$result->nombres." ".$result->apellidos.", su muestra de PAP ya fue procesada.",   
					));
				
				} 
				
			}
			
		} else {
			$data['baseurl'] = Doo::conf()->APP_URL;
			$data['disease'] = Doo::conf()->SITE;
			$data['title']      = 'Error de Muestra';
			$data['content']    = 'NO pudo agregarse una muestra: <b>Debe subir al menos una imágen de muestra y agregar un Paciente</b> ';
			$data['printr']     = "Intentelo nuevamente <a href='".$data['baseurl']."index.php/jobs/sample/submit' rel='external'> Aquí </a>";
		}                        
        // TODO: Send to the web service.
        $this->render('general_template', $data);
    }
    /**
     * To view the result of the sample, id, image, status, score, result
     */
    function sampleResult(){
        global $data;
        
        $data['baseurl'] = Doo::conf()->APP_URL;
		$data['disease'] = Doo::conf()->SITE;
        $data['title']      = 'Resultado de Muestra';
		$data['ver']        = $this->params['verlist'];
		
        Doo::loadModel('Sample');
		Doo::autoload('DooDbExpression');
        
        $sample = new Sample();
        $sample->id         = $this->params['idsample'];
        
        $result = $this->db()->find($sample, array('limit'=>1));

        $data['id']         = $result->id;
		$data['user_id']    = $result->user_id;
        $data['originame']  = $result->originame;
        $data['result']     = $result->result;
        $data['score']      = $result->score;
        $data['calibration_descr']  = $result->calibration_descr;
		$data['ts']         = $result->ts;
        $data['status_id']  = $result->status_id;
        $data['image_url']  = $data['baseurl'].$result->imagepath.'/'.$result->imagename;
        $data['allexperts'] = $result->allexperts;
		$data['action']     = $data['baseurl'].'index.php/jobs/sample/'.$data['id'];
		
		// for MELANOMA -----------------------------
		$data['mela_edad'] = $result->mela_edad;
		$data['mela_tiem'] = $result->mela_tiem;
		$data['mela_mole'] = $result->mela_mole;
		$data['mela_ubic'] = $result->mela_ubic;
		// for TUBERCULOSIS -----------------------------
		$data['tb_muestra'] = $result->tb_muestra;
		$data['tb_cultivo'] = $result->tb_cultivo;
		$data['tb_pozo']    = $result->tb_pozo;
		$data['tb_diagnos'] = $result->tb_diagnos;
		$data['tb_procesa'] = $result->tb_procesa;
		$data['tb_foto']    = $result->tb_foto;
		// for CANCER DE CUELLO UTERINO -----------------------------
		$data['ccu_lamina'] = $result->ccu_lamina;
		$data['ccu_fur']    = $result->ccu_fur;
		$data['ccu_edad']   = $result->ccu_edad;
		$data['ccu_pap']    = $result->ccu_pap;
		$data['ccu_dxpap']  = $result->ccu_dxpap;
		$data['ccu_gp']     = $result->ccu_gp;
		$data['ccu_lacta']  = $result->ccu_lacta;
		$data['ccu_gesta']  = $result->ccu_gesta;
		$data['ccu_mac']    = $result->ccu_mac;
		$data['ccu_antece'] = $result->ccu_antece;
		$data['ccu_per']    = $result->ccu_per;
		// for VAGINOSIS -----------------------------
		$data['vag_flu'] = $result->vag_flu;
		$data['vag_can'] = $result->vag_can;
		$data['vag_fet'] = $result->vag_fet;
		$data['vag_ami'] = $result->vag_ami;
		$data['vag_sec'] = $result->vag_sec;
		$data['vag_cel'] = $result->vag_cel;
		$data['vag_pru'] = $result->vag_pru;
		$data['vag_irr'] = $result->vag_irr;
		
		// --------- Boton siguiente  -------------------------------------------------------------------------------------------------------------
		
		if ($_SESSION['user']['type']==1 or $_SESSION['user']['type']==2) {
			$allexpert=""; 
			$esp=$_SESSION['user']['username'].'|';
			if ($data['ver']==1)
				$status_var = " status IS NOT NULL"; // muestras con resultado ------------ 
			if ($data['ver']==0)
				$status_var = " status IS NULL AND hide<>1"; // muestras nuevas ------------
		}
		if ($_SESSION['user']['type']==0) {
			$allexpert=" OR sample.allexperts='Si'"; 
			$esp='|'.$_SESSION['user']['username'].'|'; 
			if ($data['ver']==1)
				$status_var = " status LIKE '%".$_SESSION['user']['username']."%' AND sample.hide<>1"; // muestras con resultados ------
			if ($data['ver']==0)
				$status_var = " (status NOT LIKE '%".$_SESSION['user']['username']."%' OR status IS NULL) AND hide<>1"; // muestras nuevas ------
		}
		
		$sample2 = new Sample();
		
		$i=0;
		do {
			
			$i++;
			$next_id=$data['id']-$i;
				if ($next_id == 0) {$data['next_muestra']=0;break;}
			$next_muestra =  $sample2->count(array("where" => "(user_id LIKE '%".$esp."%'".$allexpert.") AND id = ".$next_id." AND originame IS NOT NULL AND ".$status_var.""));
				if ($next_muestra == 1) {$data['next_muestra']=$next_id;break;}
			
		} while ($next_muestra < 1);
		
		// --------- Envio de resultados ------------------------------------------------------------------------------
		
		if ($_POST['ex_result']){
		
        //add expert´s result value -----
		if ($data['disease']=="CANCER DE CUELLO UTERINO") {
        $sample->status = $result->status.'{'.$_SESSION['user']['username'].'}['.$_POST['ex_result'].']('.date("Y-m-d H:i:s").')'.$_POST['ex_calid'].','.$_POST['ex_fija'].','.$_POST['ex_tinta'].','.$_POST['ex_monta'];
		} else {
		$sample->status = $result->status.'{'.$_SESSION['user']['username'].'}['.$_POST['ex_result'].']('.date("Y-m-d H:i:s").')'.$_POST['ex_calid'];	
		}
		//Change allexperts value -----
        $sample->allexperts = $_POST['allexperts'];
        $sample->update();
		
		?>
		<script>
		var x = "<? echo $data['action']; ?>";
		window.parent.location.href=x;
		</script>
        <? 
	
		}
		
		Doo::loadModel('User');
        $user   = new User();
		$expos = explode("|", $data['user_id']);
		for ($i=2;$i<=4;$i++) { // el 0 y 1 es para lab y paciente respectivamente ------
			$user->username=$expos[$i];
			$result_user=Doo::db()->find($user, array('limit'=>1));
			$data['expos'.$i] = $result_user->nombres." ".$result_user->apellidos;
		}
		
		$data['lista_expertos'] = "";
			preg_match_all('/\{(.*?)\}/',$result->status, $e_nom); 
			preg_match_all('/\[(.*?)\]/',$result->status, $e_res);
			preg_match_all('/\((.*?)\)/',$result->status, $e_fec); 
				
			for ($i=0;$i<=10;$i++) { // asumiendo que habria un maximo de 10 expertos que diagnostquen una muestra ---------
			if($e_nom[1][$i]) {
			$user->username=$e_nom[1][$i];
			$result_user=Doo::db()->find($user, array('limit'=>1));
			$data['lista_expertos'] = "<p>".$result_user->nombres." ".$result_user->apellidos.": <b>".$e_res[1][$i]."</b> (".$e_fec[1][$i].")</p>".$data['lista_expertos']; 
			} }
					
		
		Doo::loadModel('Comments');
        
        // Insert in the database
		if ($_POST['comentario']){
		// To save a new comments with there corresponding parameters.
        
        $comments = new Comments();
		$comments->idexperto  = $_SESSION['user']['username'];
        $comments->idsample   = $data['id'];
		$comments->comentario = $_POST['comentario']; // get value comentario -----
        $comments->insert();
		
		}
		// list comments per sample -----
		
        $comments2 = new Comments();
       // $comments2->idsample   = $data['id'];
        $data['commentsample']   = $this->db()->find($comments2, array("custom" => "INNER JOIN user ON comments.idexperto = user.username WHERE comments.idsample = ".$data['id']." "));
		
		$data['sample_result'] = $result;
		
		$sample3 = new Sample();
		$data['totalpages'] = $sample3->count(array("where" => "(user_id LIKE '%".$esp."%'".$allexpert.") AND ".$status_var.""));
		
        $this->view()->render('jobresult', $data);
    }

    /**
     * List all sample to the corresponding user.
     */
    function list_all() {
        global $data;
        Doo::loadHelper('DooPager');
        Doo::loadModel('Sample');
		Doo::loadModel('User');
		Doo::autoload('DooDbExpression');
		
        $sample = new Sample();
		
		//$sample->user_id    = $_SESSION['user']['username']; -------------
		
		$data['baseurl'] = Doo::conf()->APP_URL;
		$data['disease'] = Doo::conf()->SITE;
		
		if ($this->params['verlist']==0)
        $data['title']      = 'Muestras Nuevas';
		if ($this->params['verlist']==1)
        $data['title']      = 'Muestras con resultado';
		
        $data['listurl']    = $data['baseurl'].'index.php/jobs/sample/list_all/'.$this->params['verlist'];
		$data['ver']        = $this->params['verlist'];
		
		if (!$this->params['orden']) $this->params['orden'] = "desc";
		
		if ($_POST['s_nam']) $this->params['nombre'] = $_POST['s_nam']; else $_POST['s_nam'] = $this->params['nombre'];
		
		//$this->params['fecha'] = "";
		 
		if ($_POST['s_ano']!="") { 
			$this->params['fecha'] = $_POST['s_ano']."-";
			if ($_POST['s_mes']!="")  
			$this->params['fecha'] = $_POST['s_ano']; }
		
		if ($_POST['s_mes']!="")  {
			$this->params['fecha'] = $this->params['fecha']."-".$_POST['s_mes']."-";
			if ($_POST['s_dia']!="")  
			$this->params['fecha'] = "-".$_POST['s_mes']; }
			
		if ($_POST['s_dia']!="")  $this->params['fecha'] = $this->params['fecha']."-".$_POST['s_dia'];
		
		//$data['title'] = $this->params['fecha']; Imprime paramtros de fecha ----------------------------------------
		$allexpert="";
		
		if ($_SESSION['user']['type']==1 or $_SESSION['user']['type']==2) {
			
			$user = new User();
			$data['users'] = $this->db()->find($user, array("where" => "type >= 1 "));
			
			if ($_SESSION['user']['type']==1) {
				$esp='*'.$_SESSION['user']['username'].'|';
				if ($this->params['paci']<>"") $esp='*'.$_SESSION['user']['username'].'|'.$this->params['paci'].'|';
			}
			if ($_SESSION['user']['type']==2) {
				if ($this->params['labs']) $esp='*'.$this->params['labs'].'|'; else $esp="";
				if ($this->params['paci']<>"") $esp='|'.$this->params['paci'].'|';
		    }
			if ($this->params['verlist']==0)
			$status_var = "AND sample.status IS NULL"; // muestras nuevas ----------
			if ($this->params['verlist']==1)
			$status_var = "AND sample.status IS NOT NULL"; // muestras con resultado ------------ 
		}
		if ($_SESSION['user']['type']==0) {
			
		$esp='|'.$_SESSION['user']['username'].'|';
		$allexpert=" OR sample.allexperts='Si'";
			if ($this->params['verlist']==0)
			$status_var = "AND (sample.status NOT LIKE '%".$_SESSION['user']['username']."%' OR sample.status IS NULL) AND sample.hide<>1"; // muestras nuevas ------
			if ($this->params['verlist']==1)
			$status_var = "AND sample.status LIKE '%".$_SESSION['user']['username']."%' AND sample.hide<>1"; // muestras con resultados ------
		}
		
		
		$data['totalpages'] = $sample->count(array("where" => "(user_id LIKE '%".$esp."%'".$allexpert.") AND originame COLLATE UTF8_GENERAL_CI LIKE '%".$this->params['nombre']."%' AND ts LIKE '%".$this->params['fecha']."%' ".$status_var.""));
		
		$pager  = new DooPager($data['listurl']."/".$this->params['orden']."/".$this->params['nombre']."/".$this->params['fecha']."/".$this->params['labs']."/".$this->params['paci'], $data['totalpages'], 20, 10);
        $page   = $this->params['pindex'];

        if(isset($this->params['pindex']) && $this->params['pindex']>0)
            $pager->paginate($page);
        else
            $pager->paginate(1);
		
		if ($pager->limit<0) $pager->limit = 0;	
		
		  if ($_POST['id_sample']){
		//hide or show sample ------------------------------------------------------------
		$sample2 = new Sample();
		$sample2->id = $_POST['id_sample'];
        $sample2->hide = $_POST['hide_sample'];
        $sample2->update();
		}
		
		$data['samples'] = $this->db()->find($sample, array("select" => "sample.id, sample.originame,sample.result, sample.score,sample.calibration_descr, sample.ts,sample.status_id, sample.user_id,sample.status,sample.hide, COUNT( comments.id ) AS numcomment","custom" => "LEFT JOIN comments ON comments.idsample = sample.id WHERE (sample.user_id LIKE '%".$esp."%'".$allexpert.") AND sample.originame COLLATE UTF8_GENERAL_CI LIKE '%".$this->params['nombre']."%' AND sample.ts LIKE '%".$this->params['fecha']."%' ".$status_var." GROUP BY sample.id ORDER BY sample.id ".$this->params['orden']." LIMIT ".$pager->limit.""));
		
	    $pager->defaultCss;
        $pager->components['prev_link'];
        $data['pager']  = $pager->output;
        //echo $pager->components['page_size'];

        $this->view()->render('list_all_samples', $data);
    }
	
	 /**
     * Diagnostico por laminas
     */
    function ccu_lamina(){
		
        global $data;
		
		$data['baseurl'] = Doo::conf()->APP_URL;
		$data['disease'] = Doo::conf()->SITE;
        $data['title']   = 'Diagnóstico de Lámina';
		
		Doo::loadModel('Sample');
		Doo::loadModel('Ccu_lamina');
		Doo::loadModel('User');
		Doo::autoload('DooDbExpression');
        
		$lamina = new Ccu_lamina();
       
        $data['lamina_diag']   = $this->db()->find($lamina, array("custom" => "WHERE lab = '".$_SESSION['user']['username']."' ORDER by diag DESC"));
		
        $sample = new Sample();
		$i=0;
		foreach($data['lamina_diag'] as $k1=>$v1):
		 $i++;
		 $data['lamina_sample'.$i] = $this->db()->find($sample, array("select" => "user_id,status,result","custom" => "WHERE ccu_lamina = '".$v1->lam."' AND hide = 0"));
		endforeach;
        
        // Insert in the database
		if ($_POST['lam'] && $_POST['diag']){
		// To save a new comments with there corresponding parameters.
        
        $new_lamina = new Ccu_lamina();
		
        $new_lamina->lam  = $_POST['lam']; // get value lam -----
		$new_lamina->diag = $_POST['diag']; // get value diag -----
        $new_lamina->update();
		
		?>
		<script>
		var x = "<? echo $data['action']; ?>";
		window.parent.location.href=x;
		</script>
        <? 
		}
		
      $this->view()->render('ccu_lamina', $data);
    }
	
	 /**
     * Cron sample for incomplete process --------------------------------------------
     */
    function cron_sample() {
        global $data;
        Doo::loadHelper('DooPager');
        Doo::loadModel('Sample');
		Doo::loadModel('User');
		Doo::autoload('DooDbExpression');
		
        $sample = new Sample();
		
		$data['baseurl'] = Doo::conf()->APP_URL;
		$data['disease'] = Doo::conf()->SITE;
		
        $data['title']      = 'Reprocesador de Muestras';
		
        $data['listurl']    = $data['baseurl'].'index.php/jobs/sample/cron_sample/';
		
				$sample = new Sample();
				$data['proccess']   = $this->db()->find($sample, array("where" => "status_id = 2 AND hide<>1"));
				foreach($data['proccess'] as $k1=>$v1):
				$sample->id = $v1->id;
				$sample->status_id = 1;
				
				$sample->update();
				$data['cron_muestra'] = $v1->id." -> ".$v1->originame."</br>".$data['cron_muestra'];
				endforeach;
		
		$this->view()->render('cron_sample', $data);
    }

}
?>
