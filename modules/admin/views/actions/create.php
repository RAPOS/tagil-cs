<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BActions */
$this->title = 'Добавить акцию';
$this->params['breadcrumbs'][] = ['label' => 'Акции', 'url' => ['/admin/actions']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bactions-create" style="width: 700px;">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
