<?php
class Page extends CActiveRecord
{
	public function tableName()
	{
		return 'page';
	}

	public function rules()
	{
		return array(
			array('title, text', 'required'),
			array('title', 'unique', 'message'=>'Статья с таким названием уже существует.'),
			array('title', 'length', 'max'=>50),
		);
	}

	public function relations()
	{
		return array(
			'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Название статьи',
			'text' => 'Содержание',
			'username' => 'Автор',
			'user_id' => 'Пользователь',
			'symbols'=>'Кол-во символов',
			'publish'=>'Опубликованно',
			'makepublish'=>'Публикация',
			'coins'=>'Баланс',
		);
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
