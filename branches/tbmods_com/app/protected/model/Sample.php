<?php
Doo::loadCore('db/DooModel');
class Sample extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $user_id;

    /**
     * @var varchar Max length is 45.
     */
    public $result;

    /**
     * @var varchar Max length is 45.
     */
    public $score;

    /**
     * @var varchar Max length is 45.
     */
    public $calibration_value;
	
	 /**
     * @var varchar Max length is 45.
     */
    public $calibration_descr;

    /**
     * @var int Max length is 11.
     */
    public $status_id;

    /**
     * @var timestamp
     */
    public $ts;

	/**
     * @var varchar Max length is 45.
     */
    public $originame;
	
    /**
     * @var varchar Max length is 45.
     */
    public $imagename;

    /**
     * @var varchar Max length is 100.
     */
    public $imagepath;
	
	 /**
     * @var int Max length is 2.
     */
    public $allexperts;
	/**
     * @var varchar Max length is 45.
     */
    public $status;
	
	 /**
     * @var int Max length is 1.
     */
    public $hide;
	
	public $mela_edad;
	public $mela_tiem;
	public $mela_mole;
	public $mela_ubic;
	
	public $tb_muestra;
	public $tb_cultivo;
	public $tb_pozo;
	public $tb_diagnos;
	public $tb_procesa;
	public $tb_foto;
	
	public $ccu_lamina;
	public $ccu_fur;
	public $ccu_edad;
	public $ccu_pap;
	public $ccu_dxpap;
	public $ccu_gp;
	public $ccu_lacta;
	public $ccu_gesta;
	public $ccu_mac;
	public $ccu_antece;
	public $ccu_per;
	
	public $vag_flu;
	public $vag_can;
	public $vag_fet;
	public $vag_ami;
	public $vag_sec;
	public $vag_cel;
	public $vag_pru;
	public $vag_irr;
	
    public $_table = 'sample';
    public $_primarykey = 'id';
    public $_fields = array('id','user_id','result','score','calibration_value','calibration_descr','status_id','ts','originame','imagename','imagepath','allexperts','status','hide','mela_edad','mela_tiem','mela_mole','mela_ubic','tb_muestra','tb_cultivo','tb_pozo','tb_diagnos','tb_procesa','tb_foto','ccu_lamina','ccu_fur','ccu_edad','ccu_pap','ccu_dxpap','ccu_gp','ccu_lacta','ccu_gesta','ccu_mac','ccu_antece','ccu_per','vag_flu','vag_can','vag_fet','vag_ami','vag_sec','vag_cel','vag_pru','vag_irr');

    function  __construct() {
        parent::$className=__CLASS__;
    }

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'user_id' => array(
                        array( 'maxlength', 250 ),
                        array( 'optional' ),
                ),

                'result' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'score' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'calibration_value' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),
				
				 'calibration_descr' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),
				
                'status_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'ts' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),
				
				'originame' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),
				
                'imagename' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'imagepath' => array(
                        array( 'maxlength', 250 ),
                        array( 'optional' ),
                ),
				
				'allexperts' => array(
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                ),

                'status' => array(
                        array( 'maxlength', 500 ),
                        array( 'optional' ),
                ),
				
                'hide' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'mela_edad' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),
				
				'mela_tiem' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'mela_mole' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),
				
                'mela_ubic' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),

                'tb_muestra' => array(
                        array( 'maxlength', 50 ),
                        array( 'optional' ),
                ),
				
				'tb_cultivo' => array(
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'tb_pozo' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),
				
                'tb_diagnos' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),

                'tb_procesa' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),
				
                'tb_foto' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),
				
                'ccu_lamina' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),
				
                'ccu_fur' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),
				
                'ccu_edad' => array(
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'ccu_pap' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),
				
				 'ccu_dxpap' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),
				
				'ccu_gp' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'ccu_lacta' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),
				
                'ccu_gesta' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'ccu_mac' => array(
                        array( 'maxlength', 50 ),
                        array( 'optional' ),
                ),
				
                'ccu_antece' => array(
                        array( 'maxlength', 250 ),
                        array( 'optional' ),
                ),

 				'ccu_per' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),
				
                'vag_flu' => array(
                        array( 'maxlength', 60 ),
                        array( 'optional' ),
                ),
				
				'vag_can' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),

                'vag_fet' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),
				
                'vag_ami' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),

                'vag_sec' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),
				
				'vag_cel' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),

                'vag_pru' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),
				
                'vag_irr' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                )
				
            );
    }

    public function validate($checkMode='all'){
        //You do not need this if you extend DooModel or DooSmartModel
        //MODE: all, all_one, skip
        Doo::loadHelper('DooValidator');
        $v = new DooValidator;
        $v->checkMode = $checkMode;
        return $v->validate(get_object_vars($this), $this->getVRules());
    }

}
?>