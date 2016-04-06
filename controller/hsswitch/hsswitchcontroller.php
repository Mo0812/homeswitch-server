<?php

/**
 * Created by PhpStorm.
 * User: mkanzler
 * Date: 24.03.16
 * Time: 23:46
 */

require dirname(__FILE__)."/../../models/hsswitch.php";
require dirname(__FILE__)."/../../sql/class.sqlloader.php";

class hsswitchcontroller {

    private $sqlloader;

    function __construct() {
        $this->sqlloader = sqlloader::factory();
    }

    public function getSwitches() {
        $result = $this->sqlloader->makeResult($this->sqlloader->makeQuery("SELECT switches.*, switchtypes.label, switchtypes.icon FROM switches JOIN switchtypes ON switches.type = switchtypes.id"));
        $res_arr = array();
        foreach($result as $switch) {
            $hsswitch = new hsswitch($switch["id"], utf8_encode($switch["switchname"]), $switch["type"], $switch['label'], $switch['icon'], $switch["systemcode"], $switch["unitcode"]);
            array_push($res_arr, $hsswitch);
        }

        return $res_arr;
    }

    public function toggleSwitch($id, $on) {
        $result = $this->sqlloader->makeResult($this->sqlloader->makeQuery("SELECT * FROM switches WHERE id = $id"));
        foreach($result as $switch) {
            $onoff = 0;
            if($on)
                $onoff = 1;
            shell_exec("send ".$switch['systemcode']." ".$switch['unitcode']." ".$onoff);
        }
    }

    public function toggleAll($on) {
        $result = $this->sqlloader->makeResult($this->sqlloader->makeQuery("SELECT * FROM switches"));
        foreach($result as $switch) {
            $onoff = 0;
            if($on)
                $onoff = 1;
            shell_exec("send ".$switch['systemcode']." ".$switch['unitcode']." ".$onoff);
        }
    }

}