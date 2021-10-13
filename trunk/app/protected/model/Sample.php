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
    public $imagename;

    /**
     * @var varchar Max length is 45.
     */
    public $imagepath;

    public $_table = 'sample';
    public $_primarykey = 'id';
    public $_fields = array('id','user_id','result','score','calibration_value','status_id','ts','imagename','imagepath');

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

                'status_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'ts' => array(
                        array( 'datetime' ),
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