<h3>Просмотр статьи</h3>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'text',
		'symbols'=>array(
			'name'=>'Кол-во символов',
			'value'=>UserCount::getSymbols($model->id),
		),
		'publish'=>array(
			'name'=>'Опубликованно',
			'value'=>$model->publish == 1 ?"Да":"Нет",
		),
		'username'=>array(
			'name'=>'Автор',
			'value'=>$model->user->username,
		),		
	),
)); ?>
<br>
<b><?php echo CHtml::submitButton('Назад', array('submit'=>array('userpage', 'id'=>$model->user_id))); ?></b>
<b><?php echo CHtml::submitButton($model->publish ? 'Снять с публикации' : 'Опубликовать', 
	array('submit'=>array('publish', 'id'=>$model->id))); ?></b>
<b><?php echo CHtml::submitButton('Удалить', array('submit'=>array('delete', 'id'=>$model->id))); ?></b>