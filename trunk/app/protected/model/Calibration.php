<?php
Doo::loadCore('db/DooModel');
class Calibration extends DooModel{

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
    public $value;

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
    public $description;

    /**
     * @var varchar Max length is 45.
     */
    public $imagename;

    /**
     * @var varchar Max length is 45.
     */
    public $imagepath;

    public $_table = 'calibration';
    public $_primarykey = 'id';
    public $_fields = array('id','user_id','value','status_id','ts','description','imagename','imagepath');

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
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'value' => array(
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

                'description' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'imagename' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'imagepath' => array(
                        array( 'maxlength', 45 ),
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