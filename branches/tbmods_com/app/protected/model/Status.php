<?php
class Status{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 45.
     */
    public $description;

    public $_table = 'status';
    public $_primarykey = 'id';
    public $_fields = array('id','description');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'description' => array(
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