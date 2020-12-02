<?php
$curDateTime = date("Y-m-d H:i:s");
$myDate = date("Y-m-d H:i:s", strtotime("2018-06-26 16:15:33"));
if($myDate < $curDateTime){
    echo $curDateTime;
}else{
    echo "inactive";
}

?>