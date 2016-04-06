<?php

/**
 * Created by PhpStorm.
 * User: mkanzler
 * Date: 24.03.16
 * Time: 23:37
 */


class hsswitch implements JsonSerializable {

    public $id;
    public $name;
    public $type;
    public $typename;
    public $typeicon;
    public $systemcode;
    public $unitcode;

    function __construct($id, $name, $type, $typename, $icon, $systemcode, $unitcode) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->typename = $typename;
        $this->typeicon = $icon;
        $this->systemcode = $systemcode;
        $this->unitcode = $unitcode;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        $arr = ['id' => $this->id, 'label' => $this->name, 'type' => $this->type, 'typename' => $this->typename, 'icon' => $this->typeicon, 'systemcode' => $this->systemcode, 'unitcode' => $this->unitcode];
        return $arr;
    }
}