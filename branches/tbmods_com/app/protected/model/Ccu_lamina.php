<?php
Doo::loadCore('db/DooModel');
class Ccu_lamina extends DooModel{

    /**
     
     * @var char.
     */
    public $lam;

    /**
     * @var char.
     */
    public $diag;
	
    /**
     * @var char.
     */
    public $expe;
	
    /**
     * @var char.
     */
    public $soft;
	
	/**
     * @var char.
     */
    public $lab;
	
	 /**
     * @var timestamp
     */
    public $ts;


    public $_table = 'ccu_lamina';
    public $_primarykey = 'lam';
    public $_fields = array('lam','diag','expe','soft','lab','ts');

    function  __construct() {
        parent::$className=__CLASS__;
    }

    public function getVRules() {
        return array(
                'lam' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'diag' => array(
						array( 'maxlength', 50 ),
                        array( 'notnull' ),
                ),
				
                'expe' => array(
						array( 'maxlength', 25 ),
                        array( 'notnull' ),
                ),
				
				
                'soft' => array(
						array( 'maxlength', 25 ),
                        array( 'notnull' ),
                ),
				
				'lab' => array(
						array( 'maxlength', 30 ),
                        array( 'notnull' ),
                ),
				
				'ts' => array(
                        array( 'datetime' ),
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