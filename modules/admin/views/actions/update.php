<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BActions */
$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Акции', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bactions-update" style="width: 700px;">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
