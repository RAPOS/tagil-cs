<?php
use kartik\widgets\Alert;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Обратная связь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bfeedback-index" style="width: 700px;">
	<?if($save){
		echo Alert::widget([
			'type' => Alert::TYPE_SUCCESS,
			'icon' => 'glyphicon glyphicon-remove-sign',
			'body' => 'Ответ успешно отправлен!',
			'showSeparator' => true,
			'delay' => 5000,
			'options' => [
				'style' => 'position: fixed;top: 50px;right: 0;width: 400px;',
			],
		]);
	}?>
	<?if($delete){
		echo Alert::widget([
			'type' => Alert::TYPE_SUCCESS,
			'icon' => 'glyphicon glyphicon-remove-sign',
			'body' => 'Запись успешно удалена!',
			'showSeparator' => true,
			'delay' => 5000,
			'options' => [
				'style' => 'position: fixed;top: 50px;right: 0;width: 400px;',
			],
		]);
	}?>
	<p>
		<?= Html::a('Описание страницы', ['description'], ['class' => 'btn btn-primary']) ?>
	</p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
				'class' => 'yii\grid\SerialColumn'
			],
            'id',
			[
				'attribute' => 'date',
				'format' => ['date', 'php:d.m.Y']
			],
			[
				'attribute' => 'email',
				'format' => 'text',
				'contentOptions' => ['style' => 'width: 155px;'],
			],
			[
				'attribute' => 'name',
				'contentOptions' => ['style' => 'width: 155px;'],
			],
			[
				'attribute' => 'subject',
				'contentOptions' => ['style' => 'width: 155px;'],
			],
            [
				'class' => 'yii\grid\ActionColumn',
				'buttons' => ['update' => function ($url, $model, $key) {return false;}]
			],
        ],
    ]); ?>
</div>
