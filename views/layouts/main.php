<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<div class="wrap">
	<!--Header-->
	<?NavBar::begin(
		[
			'options' => [
				'class' => 'navbar navbar-default navbar-fixed-top',
				'style' => 'display: block; border-radius: 0;background: #474747;',
				'id' => 'main-menu'
			],
			'brandLabel' => '<img class="image-brand-navbar" src="/images/logo.png"/>',
			'brandUrl' => [
				'/'
			],
			'brandOptions' => [
				'class' => 'navbar-brand',
				'style' => 'padding-top: 20px;padding-bottom: 80px;'
			]
		]
	);
	
	echo Nav::widget([
		'activateParents' => false,
		'encodeLabels' => false,
		'options' => [
			'class' => 'navbar-nav navbar-right',
		],
		'items' => [
			['label' => 'Home', 'url' => Url::to(['/site/index'])],
			['label' => 'About', 'url' => ['/site/about']],
			'<li>'.Html::a('Регистрация', '#', ['id' => 'reg']).'</li>',
			Yii::$app->user->isGuest ? (
				'<li>'.Html::a('Авторизация', '#', ['id' => 'auth']).'</li>'
			) : (
				'<li>'
				. Html::beginForm(['/site/logout'], 'post')
				. Html::submitButton(
					'Logout (' . Yii::$app->user->identity->username . ')',
					['class' => 'btn btn-link']
				)
				. Html::endForm()
				. '</li>'
			)
		],
	]);
	NavBar::end();
	?>
	<?= $this->render('/site/_form_auth');?>
	<!--Header-->
	<div class="container">
		<?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
		<?= $content ?>
	</div>
	<!--Footer-->
	<footer class="footer">
		<div class="container">
			<div id="copyright"><span>&copy; <?= date('Y') ?> TAGIL-CS</span></div>
		</div>
	</div>
	<!--Footer-->
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
