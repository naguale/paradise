<?php

class User extends CActiveRecord
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';	
	public $repassword;

	public function tableName()
	{
		return 'user';
	}

	public function rules()
	{
		return array(
			array('username, password, repassword', 'required'),
			array('username', 'unique'),
			array('username, password', 'match', 'pattern' => '/^([A-Za-z0-9]+)$/u', 
				  'message' => 'Указанны недопустимые символы'),
			array('password', 'compare', 'compareAttribute'=>'repassword'),
			array('username', 'length', 'max'=>25, 'min'=>5),
			array('password', 'length', 'max'=>25, 'min'=>5),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Логин',
			'password' => 'Пароль',
			'repassword' => 'Повторите пароль',
		);
	}
	
	public function beforeSave() {
		$this->password = md5($this->password);
		return parent::beforeSave();
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
