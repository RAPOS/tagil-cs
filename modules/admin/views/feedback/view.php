<?php
use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Обратная связь', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bfeedback-view">
	<?php $form = ActiveForm::begin(); ?>
	<div class="clearfix">
		<div class="bfeedback-view-left">
			<div class="bfeedback-view-border">Тема: <span><?=$model->subject?></span></div>
			<div class="bfeedback-view-name clearfix"> 
				<img src="/images/panel/user.png" width="48"/>
				<span><?=$model->name?></span>
			</div>
			<div class="bfeedback-view-baloon"><?=$model->text?></div>
			<?if($model->response){?>
				<div class="bfeedback-view-admin clearfix"> 
					<img src="/images/panel/admin.png" width="48"/>
					<span>Администратор</span>
				</div>
				<div class="bfeedback-view-baloon-admin">
					<?=$model->response?>
				</div>
			<?}?>
		</div>
		<div class="bfeedback-view-right">
			<p>
				<span>Дата:</span> 
				<span><?=Yii::$app->formatter->asTime($model->date, 'php:d.m.Y');?></span>
			</p>
			<p>
				<span>Время:</span> 
				<span><?=Yii::$app->formatter->asTime($model->date, 'php:H:i:s');?></span>
			</p>
			<p>
				<span>E-mail:</span> 
				<span><?=$model->email?></span>
			</p>
			<p>
				<span>IP:</span> 
				<span><?=$model->ip?></span>
			</p>
		</div>
	</div>
	<?if(!$model->response){?>
		<?= $form->field($model, 'response')->widget(TinyMce::className(), [
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
	<?}?>
	<br>
	<div class="form-group">
        <?if(!$model->response){?>
			<?=Html::submitButton('Ответить', ['class' => 'btn btn-success'])?>
		<?}?>
        <?= Html::a('Назад', ['/admin/feedback'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить запись', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
	</div>
	<?php ActiveForm::end(); ?>
</div>
