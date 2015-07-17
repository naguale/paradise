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
				'actions'=>array(
					'index', 'room', 'userlist', 'userpage', 'view', 'delete', 'publish'
				),
				'roles'=>array('1'),
			),		
			array('deny',
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionRoom()
	{
		$this->render('room');
	}

	public function actionUserList()
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'username!="admin"';
		$criteria->order = 'username ASC';
		$dataProvider=new CActiveDataProvider('User', array(
			'criteria'=>$criteria,
		));

		$this->render('userlist',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionUserPage($id)
	{
		$user = User::model()->findByPk($id);
		$criteria = new CDbCriteria;
		$criteria->condition = 'user_id="'.$id.'"';
		$criteria->order = 'title ASC';
		$dataProvider=new CActiveDataProvider('Page', array(
			'criteria'=>$criteria,
		));

		$this->render('userpage',array(
			'dataProvider'=>$dataProvider,
			'user'=>$user,
		));
	}	

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}	

	public function actionPublish($id)
	{
		$model=$this->loadModel($id);
		
		if ($model->publish) $model->publish=0;
		else $model->publish=1;		
		$model->save();	

		$dataProvider=new CActiveDataProvider('Page');
		$this->redirect(array('userpage', 'id'=>$model->user_id));
	}

	public function actionDelete($id)
	{
		$model=$this->loadModel($id);
		$model->delete();
		$this->redirect(array('userpage', 'id'=>$model->user_id));
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
