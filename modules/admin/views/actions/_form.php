<?php
use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BActions */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="bactions-form">
    <?php $form = ActiveForm::begin(); ?>
	<div>
		<?= $form->field($model, 'status')->dropDownList (
			[
				'1' => 'Действует',
				'0' => 'Не действует',
			]
		)?>
	</div>
	<?= $form->field($model, 'text')->widget(TinyMce::className(), [
		'options' => ['rows' => 6],
		'language' => 'ru',
		'clientOptions' => [
			'plugins' => [
				"advlist autolink lists link charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste"
			],
			'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
		]
	]);?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => 'btn btn-success']) ?>
		<?= Html::a('Назад', ['/admin/masters'], ['class'=>'btn btn-primary']) ?>
	</div>
    <?php ActiveForm::end(); ?>
</div>
