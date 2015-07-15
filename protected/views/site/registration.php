<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'enableAjaxValidation'=>false,
)); ?>

	<h1>Регистрация</h1>
	<p class="note">Поля помеченные <span class="required">*</span> обязательны для зполнения!</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username',array('size'=>26,'maxlength'=>25)); ?>
        <?php echo $form->error($model,'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password',array('size'=>26,'maxlength'=>25)); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>
	
    <div class="row">
        <?php echo $form->labelEx($model,'repassword'); ?>
        <?php echo $form->passwordField($model,'repassword',array('size'=>26,'maxlength'=>25)); ?>
        <?php echo $form->error($model,'repassword'); ?>
    </div>
	
    <div class="row buttons">
        <?php echo CHtml::submitButton('Зарегистрироваться'); ?>
		<?php echo CHtml::submitButton('Войти', array('submit'=>array('/site/login'))); ?>	
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->