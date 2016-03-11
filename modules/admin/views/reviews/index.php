<?php
use kartik\widgets\Alert;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breviews-index" style="width: 700px;">
	<?if($save){
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
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
			[
				'attribute' => 'date',
				'format' => ['date', 'php:d.m.Y']
			],
			[
				'attribute' => 'email',
				'format' => 'email',
				'contentOptions' => ['style' => 'width: 190px;'],
			],
			[
				'attribute' => 'name',
				'contentOptions' => ['style' => 'width: 190px;'],
			],
			[
				'attribute' => 'moderate',
				'format' => 'html',
				'contentOptions' => ['style' => 'text-align: center;'],
				'value' => function ($model, $key, $index, $column){
					if($model['moderate']){
						return '<img src="/images/panel/checkmark.png" width="32"/>';
					} else {
						return '<img src="/images/panel/cancel.png" width="32"/>';
					}
				}
			],
            [
				'class' => 'yii\grid\ActionColumn',
				'buttons' => ['update' => function ($url, $model, $key) {return false;}]
			],
        ],
    ]); ?>
</div>
