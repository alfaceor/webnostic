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
     * @var varchar Max length is 80.
     */
    public $imagepath;

    /**
     * @var varchar Max length is 45.
     */
    public $trichu_score;

    /**
     * @var varchar Max length is 45.
     */
    public $trichu_result;

    /**
     * @var varchar Max length is 45.
     */
    public $taenia_score;

    /**
     * @var varchar Max length is 45.
     */
    public $taenia_result;

    /**
     * @var varchar Max length is 45.
     */
    public $fascio_score;

    /**
     * @var varchar Max length is 45.
     */
    public $fascio_result;

    /**
     * @var varchar Max length is 45.
     */
    public $diphy_score;

    /**
     * @var varchar Max length is 45.
     */
    public $diphy_result;

    public $_table = 'sample';
    public $_primarykey = 'id';
    public $_fields = array('id','user_id','calibration_value','status_id','ts','imagename','imagepath','trichu_score','trichu_result','taenia_score','taenia_result','fascio_score','fascio_result','diphy_score','diphy_result');

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
                        array( 'maxlength', 80 ),
                        array( 'optional' ),
                ),

                'trichu_score' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'trichu_result' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'taenia_score' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'taenia_result' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'fascio_score' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'fascio_result' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'diphy_score' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'diphy_result' => array(
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