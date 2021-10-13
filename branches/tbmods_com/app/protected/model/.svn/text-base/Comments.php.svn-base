<?php
Doo::loadCore('db/DooModel');
class Comments extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $idexperto;

    /**
     * @var int Max length is 11.
     */
    public $idsample;

    /**
     * @var Longtext.
     */
    public $comentario;
	
	 /**
     * @var timestamp
     */
    public $ts;

	/**
     * @var int Max length is 2.
     */
    public $status;

    public $_table = 'comments';
    public $_primarykey = 'id';
    public $_fields = array('id','idexperto','idsample','comentario','ts','status');

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

                'idexperto' => array(
                        array( 'maxlength', 30 ),
                        array( 'notnull' ),
                ),

                'idsample' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'comentario' => array(
						array( 'maxlength', 1000 ),
                        array( 'notnull' ),
                ),
				
				'ts' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),
				
				'status' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
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