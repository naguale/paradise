<?php printf("<h3>Личный кабинет пользователя %s.</h3>", Yii::App()->user->name); ?>
<?php
	$this->widget('zii.widgets.CMenu',array(
		'items'=>array(
			
			array('label'=>'Создать статью', 'url'=>array('/page/create'), 'visible'=>!Yii::app()->user->isGuest),	
			array('label'=>'Просмотр статей', 'url'=>array('/page/userpage'), 'visible'=>!Yii::app()->user->isGuest),			
			array('label'=>'Выход', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
		),
	));
?>
<h3>Создать статью</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>