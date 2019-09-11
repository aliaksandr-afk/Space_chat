<?php

$message = strip_tags($_POST['common_text']);
$userId = $model->getSeesionId();

return $model->addMessage($userId, $message);


