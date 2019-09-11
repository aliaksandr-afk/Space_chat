<?php
if (!$model->isAdmin()){
    return false;
    exit();
}

if(isset($_POST['id']) && is_numeric($_POST['id'])) {
    return $model->deleteMessage($_POST['id']);
}
