<?php
Doo::loadCore('db/DooModel');
class User extends DooModel{

    /**
     * @var varchar Max length is 45.
     */
    public $username;

    /**
     * @var varchar Max length is 45.
     */
    public $password;

    /**
     * @var varchar Max length is 45.
     */
    public $nombres;

    /**
     * @var varchar Max length is 45.
     */
    public $apellidos;

    /**
     * @var varchar Max length is 45.
     */
    public $correo;

    /**
     * @var varchar Max length is 45.
     */
    public $telefono;

    /**
     * @var timestamp
     */
    public $ts;

    /**
     * @var int Max length is 11.
     */
    public $status;

    /**
     * @var int Max length is 11.
     */
    public $type;

    public $_table = 'user';
    public $_primarykey = 'username';
    public $_fields = array('username','password','nombres','apellidos','correo','telefono','ts','status','type');

    function  __construct() {
        parent::$className=__CLASS__;
    }

    public function getVRules() {
        return array(
                'username' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),

                'password' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'nombres' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'apellidos' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'correo' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'telefono' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'ts' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'status' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),

                'type' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
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