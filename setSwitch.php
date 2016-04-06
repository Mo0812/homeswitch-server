<?php
/**
 * Created by PhpStorm.
 * User: mkanzler
 * Date: 25.03.16
 * Time: 02:10
 */


require dirname(__FILE__) . "/controller/hsswitch/hsswitchcontroller.php";

$switch_id = $_GET['switch_id'];
$state = $_GET['state'];

$hsswitchescontroller = new hsswitchcontroller();

if(is_numeric($switch_id) && ($state == 1 || $state == 0)) {
    $hsswitchescontroller->toggleSwitch($switch_id, $state);
} else if($switch_id == "all" && ($state == 1 || $state == 0)) {
    $hsswitchescontroller->toggleAll($state);
}