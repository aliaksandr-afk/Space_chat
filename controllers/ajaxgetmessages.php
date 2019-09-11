<?php

ob_start();
include ( __DIR__ . "/../templates/chatpage/chatpagemessages.phtml");
$content = ob_get_contents();
ob_end_clean();

 echo json_encode(array(
		'result' =>  $content
 ));
