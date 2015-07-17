<?php
	if(Yii::app()->user->hasFlash('registration')) echo "<h3>Вы зарегистрировались!</h3>"; 
	if (!Yii::app()->user->isGuest) {
		printf("<h3>Личный кабинет пользователя %s.</h3>", Yii::app()->user->name); 
		printf("<h3>Баланс: %s$</h3>", UserCount::getBalance(Yii::app()->user->id)); 
	}
	else {
		echo "<h3>Что бы войти в личный кабинет авторизируйтесь!</h3>";
	}
 ?>
 
<?php
	$this->widget('zii.widgets.CMenu',array(
		'items'=>array(
			
			array('label'=>'Создать статью', 'url'=>array('/page/create'), 'visible'=>!Yii::app()->user->isGuest),	
			array('label'=>'Просмотр статей', 'url'=>array('/page/userpage'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Регистрация', 'url'=>array('/site/registration'), 'visible'=>Yii::app()->user->isGuest),			
			array('label'=>'Выход', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
		),
	)); 
 ?>