<h3>Кабинет администратора.</h3>

<?php
	$this->widget('zii.widgets.CMenu',array(
		'items'=>array(
	
			array('label'=>'Просмотр пользователей', 'url'=>array('userlist')),
			array('label'=>'Выход', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
		),
	)); 
 ?>