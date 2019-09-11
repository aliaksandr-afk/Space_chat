<?php
$pageName = 'chat';
$itsadmin = $model->isAdmin();
$userList = $model->getUserList();
require_once __DIR__ . '/../templates/layout.phtml';
