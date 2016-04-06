<?php
/**
 * Created by PhpStorm.
 * User: mkanzler
 * Date: 24.03.16
 * Time: 23:50
 */

require dirname(__FILE__) . "/controller/hsswitch/hsswitchcontroller.php";

$hsswitchescontroller = new hsswitchcontroller();
$result = $hsswitchescontroller->getSwitches();

echo json_encode($result, JSON_PRETTY_PRINT);