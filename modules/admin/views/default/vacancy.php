<?php
use dosamigos\tinymce\TinyMce;
use kartik\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Вакансии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancy" style="width: 700px;">
	<?if($success){
		echo Alert::widget([
			'type' => Alert::TYPE_SUCCESS,
			'icon' => 'glyphicon glyphicon-remove-sign',
			'body' => 'Изменения успешно сохранены!',
			'showSeparator' => true,
			'delay' => 5000,
			'options' => [
				'style' => 'position: fixed;top: 50px;right: 0;width: 400px;',
			],
		]);
	}?>
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'title') ?>
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
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
			<?= Html::a('Назад', ['/admin'], ['class'=>'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
