<?php printf("<h3>Личный кабинет пользователя %s.</h3>", Yii::App()->user->name); ?>
<?php printf("<h3>Баланс: %s$</h3>", UserCount::getSymbols(UserCount::publishedText(Yii::app()->user->id))*0.1); ?>

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
				'value'=>'UserCount::getSymbols($data->text)',
			),
			'publish'=>array(
				'name'=>'Опубликованно',
				'value'=>'($data->publish == 1)?"Да":"Нет"',
			),
			'coins'=>array(
				'name'=>'Вознаграждение',
				'value'=>'($data->publish == 1)? UserCount::getSymbols($data->text)*0.1."$" :"0$"',
			),			
			array(
				'class'=>'CButtonColumn',
			),
		),
	)); 
?>