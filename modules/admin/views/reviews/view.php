<?php
use app\modules\admin\models\BMasters;
use app\modules\admin\models\BTypesOfMassage;
use kartik\widgets\SwitchInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breviews-view" style="width: 700px;">
	<?php $form = ActiveForm::begin(); ?>
	<div class="clearfix">
		<div class="breviews-view-left">
			<?if($model->section == 'interior'){
				$page = 'Интерьер';
				$url = '/interior';
			} else if($model->section == 'reviews'){
				$page = 'Отзывы';
				$url = '/reviews';
			} else if($model->section == 'masters'){
				$BMasters = BMasters::find()->where(['translate' => $model->translate])->one();
				$page = 'Мастера / '.$BMasters->name;
				$url = '/masters/'.$model->translate;
			} else if($model->section == 'programs'){
				$BTypesOfMassage = BTypesOfMassage::find()->where(['translate' => $model->translate])->one();
				$page = 'Программы / '.$BTypesOfMassage->name;
				$url = '/programs/'.$model->translate;
			}?>
			<div class="breviews-view-border">Отзыв к странице: <a href="<?=$url?>" target="_blank"><?=$page?></a></div>
			<div class="breviews-view-name clearfix"> 
				<img src="/images/panel/user.png" width="48"/>
				<span><?=$model->name?></span>
			</div>
			<div class="breviews-view-baloon"><?=$model->text?></div>
			<?= $form->field($model, 'moderate', [
				'labelOptions' => [
					'class' => 'breviews-label-switch'
				]
			])->widget(SwitchInput::classname(), [
				'pluginOptions' => [
					'size' => 'normal',
					'onColor' => 'success',
					'offColor' => 'danger',
					'onText' => 'Включить',
					'offText' => 'Выключить',
					
				],
			])?>
		</div>
		<div class="breviews-view-right">
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
				<span><a href="mailto:<?=$model->email?>"><?=$model->email?></a></span>
			</p>
			<p>
				<span>IP:</span> 
				<span><?=$model->ip?></span>
			</p>
		</div>
	</div>
	<br>
    <div class="form-group">
        <?=Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>
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
