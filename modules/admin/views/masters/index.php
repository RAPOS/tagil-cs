<?php
use kartik\widgets\Alert;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Мастера';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bmasters-index" style="width: 700px;">
	<?if($create){
		echo Alert::widget([
			'type' => Alert::TYPE_SUCCESS,
			'icon' => 'glyphicon glyphicon-remove-sign',
			'body' => 'Запись успешно создана!',
			'showSeparator' => true,
			'delay' => 5000,
			'options' => [
				'style' => 'position: fixed;top: 50px;right: 0;width: 400px;',
			],
		]);
	}?>
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
    <p>
        <?= Html::a('Добавить мастера', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Описание страницы', ['description'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'tBodyAttr' => 'id="sortable"',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_master',
			[
				'attribute' => 'name',
				'contentOptions' => ['style' => 'width: 380px;'],
			],
			[
				'attribute' => 'new',
				'format' => 'html',
				'contentOptions' => ['style' => 'text-align: center;'],
				'value' => function ($model, $key, $index, $column){
					if($model['new']){
						return '<img src="/images/panel/checkmark.png" width="32"/>';
					} else {
						return '<img src="/images/panel/cancel.png" width="32"/>';
					}
				},
			],
			[
				'attribute' => 'tour',
				'format' => 'html',
				'contentOptions' => ['style' => 'text-align: center;'],
				'value' => function ($model, $key, $index, $column){
					if($model['tour']){
						return '<img src="/images/panel/checkmark.png" width="32"/>';
					} else {
						return '<img src="/images/panel/cancel.png" width="32"/>';
					}
				},
			],
            [
				'class' => 'yii\grid\ActionColumn',
				'buttons' => ['view' => function ($url, $model, $key) {return false;}]
			],
        ],
    ]); ?>
</div>
<script>page = {name: 'masters', files_count: 3};</script>