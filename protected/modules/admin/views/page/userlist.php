<h3>Кабинет администратора.</h3>
<?php
	$this->widget('zii.widgets.CMenu',array(
		'items'=>array(
				
			array('label'=>'Просмотр пользователей', 'url'=>array('userlist')),			
			array('label'=>'Выход', 'url'=>array('/site/logout'), 'visible'=>Yii::app()->user->checkAccess(1)),
			array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>!Yii::app()->user->checkAccess(1)),
		),
	
	));
?>

<h3>Просмотр пользователей:</h3>

<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'page-grid',
		'dataProvider'=>$dataProvider,
		'columns'=>array(
			'username'=>array(
				'name'=>'Автор',
				'value'=>'CHtml::link(CHtml::encode($data->username),         Yii::app()->controller->createUrl("userpage", array("id" => $data->id)))',
				'type'=>'html',
				'htmlOptions'=>array('style'=>'text-align: center;'),				
			),
			'articles'=>array(
				'name'=>'Количество статей',
				'value'=>'CHtml::encode(UserCount::getArticles($data->id))',
				'htmlOptions'=>array('style'=>'text-align: center;'),				
			),
			'symbols'=>array(
				'name'=>'Количество символов',
				'value'=>'UserCount::getAllSymbols($data->id)',
				'htmlOptions'=>array('style'=>'text-align: center;'),				
			),
			'price'=>array(
				'name'=>'Баланс',
				'value'=>'UserCount::getBalance($data->id)."$"',
				'htmlOptions'=>array('style'=>'text-align: center;'),				
			),
		),
	)); 
?>