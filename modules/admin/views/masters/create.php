<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BMasters */
$this->title = 'Добавить мастера';
$this->params['breadcrumbs'][] = ['label' => 'Мастера', 'url' => ['/admin/masters']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bmasters-create" style="width: 700px;">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
