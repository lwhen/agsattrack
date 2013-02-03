<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
      // var_dump( Yii::app()->user->isAdmin()); die(); 
/*
$auth=Yii::app()->authManager;
 
$auth->createOperation('updateElements','Update Elements');
$auth->createOperation('updateGroups','Update Groups');
$auth->createOperation('updateCatalog','Update Catalog');

$bizRule='return !Yii::app()->user->isGuest;';
$role = $auth->createRole('authenticated', 'authenticated user', $bizRule);
 
$bizRule='return Yii::app()->user->admin == 1;';
$role = $auth->createRole('admin', 'admin user', $bizRule);
$role->addChild('updateElements');
$role->addChild('updateGroups');
$role->addChild('updateCatalog');



die();  
*/      
       // $url = Yii::app()->createUrl('satellites/getdata', array('catalognumber' => '343243'));
       // die($url);
        
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
        $this->layout='ajax-login-layout';

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {
				$this->redirect(Yii::app()->user->returnUrl);
            }
		}
		// display the login form
		$this->render('login',array('model'=>$model));
        Yii::app()->end();
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
        Yii::app()->end();
		//$this->redirect(Yii::app()->homeUrl);
	}
}