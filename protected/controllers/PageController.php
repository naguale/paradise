<?php

class PageController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array(
				'allow',
				'actions'=>array('index', 'room', 'create', 'userpage', 'view', 'update', 'delete'),
				'roles'=>array('0'),
			),		
			array(
				'allow',
				'actions'=>array('index', 'room'),
				'users'=>array('*'),
			),		
			array('deny',  
				'users'=>array('*'),
			),
		);
	}
	
	public function textCount($text)
	{
		return strip_tags(mb_strlen($text, 'utf-8'));
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionRoom()
	{
		$this->render('room');
	}
	
	public function actionCreate()
	{
		$model=new Page;
		if(isset($_POST['Page']))
		{
			$model->attributes=$_POST['Page'];
			$model->user_id = Yii::app()->user->id;
			if($model->save())
				$this->redirect(array('userpage'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Page']))
		{
			$model->attributes=$_POST['Page'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		
		if (!$model->publish) 
			$this->render('update',array(
				'model'=>$model,
			));
		else $this->redirect(array('userpage'));
	}

	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		if (!$model->publish)
			$model->delete();
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('userpage'));
	}

	public function actionUserpage()
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'user_id="'.Yii::App()->user->id.'"';
		$criteria->order = 'title ASC';
		$dataProvider=new CActiveDataProvider('Page', array(
			'criteria'=>$criteria,
		));

		$this->render('userpage',array(
			'dataProvider'=>$dataProvider,
			'model'=>$model,
		));
	}
	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}	

	public function loadModel($id)
	{
		$model=Page::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='page-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
