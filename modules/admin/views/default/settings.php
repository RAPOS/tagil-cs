<?php
use kartik\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Настройки сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings" style="width: 700px;">
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
        <?= $form->field($model, 'keywords')->textarea()?>
		<?= $form->field($model, 'description')->textarea(['rows' => 6])?>
        <div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
			<?= Html::a('Назад', ['/admin'], ['class'=>'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
