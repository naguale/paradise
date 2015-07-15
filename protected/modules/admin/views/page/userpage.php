<h3>Кабинет администратора.</h3>
<?php
	$this->widget('zii.widgets.CMenu',array(
		'items'=>array(
				
			array('label'=>'Назад', 'url'=>array('userlist')),			
			array('label'=>'Выход', 'url'=>array('/site/logout'), 'visible'=>Yii::app()->user->checkAccess(1)),
			array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>!Yii::app()->user->checkAccess(1)),
		),
	
	));
?>

<?php printf("<h3>Просмотр статей пользователя %s:</h3>", $user->username); ?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'page-grid',
		'dataProvider'=>$dataProvider,
		'columns'=>array(		
			'title'=>array(
				'name'=>'Название статьи',
				'value'=>'CHtml::link(CHtml::encode($data->title),         Yii::app()->controller->createUrl("view", array("id" => $data->id)))',
				'type'=>'html',
				'htmlOptions'=>array('style'=>'text-align: center;'),				
			),
			'text',
			'symbols'=>array(
				'name'=>'Количество символов',
				'value'=>'CHtml::encode(UserCount::getSymbols($data->text))',
				'htmlOptions'=>array('style'=>'text-align: center;'),				
			),
			'publish'=>array(
				'name'=>'Опубликованно',
				'value'=>'($data->publish == 1)?"Да":"Нет"',
				'htmlOptions'=>array('style'=>'text-align: center;'),
			),
			'makepublish'=>array(
				'name'=>'Публикация',
				'value' => '($data->publish == 1)? CHtml::link(CHtml::encode("Снять с публикации"), Yii::app()->controller->createUrl("publish", array("id" => $data->id))) : CHtml::link(CHtml::encode("Опубликовать"), Yii::app()->controller->createUrl("publish", array("id" => $data->id)))',
				'type'=>'html',
				'htmlOptions'=>array('style'=>'text-align: center;'),				
			),
			'coins'=>array(
				'name'=>'Вознаграждение',
				'value'=>'($data->publish==1) ? UserCount::getSymbols($data->text)*0.1."$" : "0$"',
				'htmlOptions'=>array('style'=>'text-align: center;'),			
			),
		),
	)); 
?>