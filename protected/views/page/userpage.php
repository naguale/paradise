<?php printf("<h3>Личный кабинет пользователя %s.</h3>", Yii::App()->user->name); ?>
<?php printf("<h3>Баланс: %s$</h3>", UserCount::getBalance(Yii::app()->user->id)); ?>

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

<h3>Просмотр статей</h3>

<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'page-grid',
		'dataProvider'=>$dataProvider,
		'columns'=>array(
			'title',
			'text',
			'symbols'=>array(
				'name'=>'Количество символов',
				'value'=>'UserCount::getSymbols($data->id)',
			),
			'publish'=>array(
				'name'=>'Опубликованно',
				'value'=>'($data->publish == 1)?"Да":"Нет"',
			),
			'coins'=>array(
				'name'=>'Вознаграждение',
				'value'=>'UserCount::getReward($data->id)."$"',
			),			
			array(
				'class'=>'CButtonColumn',
			),
		),
	)); 
?>