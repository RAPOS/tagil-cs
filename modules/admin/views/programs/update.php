<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BTypesOfMassage */
$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Программы', 'url' => ['/admin/programs']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_massage]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="btypes-of-massage-update" style="width: 700px;">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
