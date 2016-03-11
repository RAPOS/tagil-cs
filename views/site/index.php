<?php
/* @var $this yii\web\View */
use app\modules\admin\models\BImages;
$this->title = 'TAGIL-CS';
?>
<!--Content-->
<div id="content" class="">
		<?/*<div id="main_sertificates">
			<p class="title"><?=$sertificate->title?></p>
			<?$model_images = json_decode($sertificate->images);
			$BImages = BImages::findOne($model_images[0]);
			if($BImages->path && file_exists(Yii::getAlias('@webroot/'.$BImages->path))){
				$image = Yii::$app->image->load(Yii::getAlias('@webroot/'.$BImages->path));
				$image->resize(280, 200);
				$image->save(Yii::getAlias('@webroot/assets/'.$BImages->name.'.'.$BImages->extension));?>
				<a class="zoomimage" href="<?=$BImages->path?>">
					<img src="<?='/assets/'.$BImages->name.'.'.$BImages->extension?>" alt="">
				</a>
			<?}?>
		</div>*/?>
</div>
<!--Content-->