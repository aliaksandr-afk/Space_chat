<?php
    $pageName = 'login';
    $itsadmin = $model->isAdmin();

	if(isset($_POST['submit']))
	{
		$email=trim(htmlspecialchars($_POST['email']));
	
		$password=trim(htmlspecialchars(($_POST['password'])));

		$user = $model->loginUser($email,$password);

		if($user !== false){
            $model->setSeesionId($user['id']);
        }

		header("Location: index.php");
	}
	require_once __DIR__ . '/../templates/layout.phtml';
