<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\ButtonDropdown;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\modules\admin\models\BAdmins;
use app\modules\admin\models\BSettings;

$BAdmins = BAdmins::findOne(Yii::$app->user->id);

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" style="background: none;">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'На сайт',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
	if(!Yii::$app->user->isGuest){
		echo ButtonDropdown::widget([
			'label' => $BAdmins->name,
			'options' => [
				'class' => 'btn-link',
				'style' => 'margin: 8px'
			],
			/* 'dropdown' => [
				'items' => [
					['label' => 'Изменить данные', 'url' => '/admin/userchange'],
				],
			], */
		]);
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => [
				[
					'label' => 'Выйти',
					'url' => ['/admin/logout'],
					'linkOptions' => ['data-method' => 'post']
				],
			],
		]);
	}
    NavBar::end();
    ?>
    <div class="container">
		<?if(!Yii::$app->user->isGuest){?>
		<aside class="admin_panel">
			<?echo Nav::widget([
				'options' => ['class' => 'navbar-left'],
				'items' => [
					[
						'label' => 'Главная страница',
						'url' => ['/admin/mainpage'],
					],
					[
						'label' => 'Акции',
						'url' => ['/admin/actions'],
					],
					[
						'label' => 'Мастера',
						'url' => ['/admin/masters'],
					],
					[
						'label' => 'Программы',
						'url' => ['/admin/programs'],
					],
					[
						'label' => 'Интерьер',
						'url' => ['/admin/interior'],
					],
					[
						'label' => 'Правила',
						'url' => ['/admin/rules'],
					],
					[
						'label' => 'Вакансии',
						'url' => ['/admin/vacancy'],
					],
					[
						'label' => 'Подарочный сертификат',
						'url' => ['/admin/sertificate'],
					],
					[
						'label' => 'Отзывы',
						'url' => ['/admin/reviews'],
					],
					[
						'label' => 'Обратная связь',
						'url' => ['/admin/feedback'],
					],
					[
						'label' => 'Настройки сайта',
						'url' => ['/admin/settings'],
					],
					[
						'label' => 'Изменить данные входа',
						'url' => ['/admin/userchange'],
					],
				],
			]);?>
		</aside>
		<?}?>
		<section class="admin_content">
			<?= Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				'homeLink'=>['label' => 'Панель управления', 'url' => '/admin'],
			]) ?>
			<?= $content ?>
		</section>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Мужской спа-салон «Барон» <?= date('Y') ?></p>
        <!--<p class="pull-right"><?= Yii::powered() ?></p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
