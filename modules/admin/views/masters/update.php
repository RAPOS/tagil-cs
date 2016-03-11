<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BMasters */
$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Мастера', 'url' => ['/admin/masters']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_master]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bmasters-update" style="width: 700px;">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
