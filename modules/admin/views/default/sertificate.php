<?php
use app\modules\admin\models\BImages;
use dosamigos\tinymce\TinyMce;
use kartik\widgets\Alert;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Сертификат';
$this->params['breadcrumbs'][] = $this->title;
$array_image = array();
$array_image_cfg = array();
if(!$model->isNewRecord){
	$array_id_images = json_decode($model->images);
	for($i=0;$i<count($array_id_images);$i++){
		$BImages = BImages::findOne($array_id_images[$i]);
		$array_image[] = Html::img('/'.$BImages->path, ['class'=>'file-preview-image', 'alt'=>$BImages->name, 'title'=>$BImages->name, 'style'=>'width:auto;height:210px;']);
		$array_image_cfg[] = [
			'caption' => $BImages->name,
			'url' => '/admin/deleteimages',
			'key' =>  $BImages->id_img,
			'extra' => ['delete_id_img' => $BImages->id_img, 'delete_path' => $BImages->path, 'id_images' => $array_id_images, 'page' => 'sertificate'],
		];
	}
}
if(!$array_image && !$array_image_cfg){
	$array_image = array();
	$array_image_cfg = array();
}
?>
<div class="sertificate" style="width: 700px;">
	<?if($success){
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
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'title') ?>
		<?= $form->field($model, 'text')->widget(TinyMce::className(), [
			'options' => ['rows' => 6],
			'language' => 'ru',
			'clientOptions' => [
				'plugins' => [
					"advlist autolink lists link charmap print preview anchor",
					"searchreplace visualblocks code fullscreen",
					"insertdatetime media table contextmenu paste"
				],
				'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
			]
		]);?>
		<?=FileInput::widget([
			'name' => 'image[]',
			'language' => 'ru',
			'options' => [
				'multiple' => true,
				'accept' => 'image/*',
			],
			'pluginOptions' => [
				'previewFileType' => 'image',
				'previewSettings' => [
					'image' => ['width' => 'auto', 'height' => '210px'],
				],
				'maxFileCount' => 1,
				'validateInitialCount' => true,
				'overwriteInitial' => false,
				'initialPreview' => $array_image,
				'initialPreviewConfig' => $array_image_cfg,
				'uploadUrl' => '/admin/upload',
				'browseClass' => 'btn btn-success',
				'uploadClass' => 'btn btn-info',
				'removeClass' => 'btn btn-danger',
				'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',
				'showRemove' => false,
			],
			'pluginEvents' => [
			   'filepredelete' => 'function(event, key) {
					if($(".file-input .file-preview-frame").length == 1){
						$(".file-input .input-group").show();
					}
				}',
				'fileuploaded' => 'function(event, data, previewId, index){
					var form = data.form, files = data.files, extra = data.extra, response = data.response, reader = data.reader;
					$(".file-input").append(\'<input hidden type="text" name="id_img[]" value="\'+response["id_img"]+\'"/>\');
					$(".file-input input[name=\"id_img[]\"]").each(function(i, value){
						$(this).attr("data-name", files[i]["name"]);
					});
					if($(".file-input .file-preview-frame").length == 1){
						$(".file-input .input-group").hide();
					}
				}',
				'filesuccessremove' => 'function(event, id){
					if($(".file-input .file-preview-frame").length == 1){
						$(".file-input .input-group").show();
					}
				}',
			]
		]);?>
		<br>
        <div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
			<?= Html::a('Назад', ['/admin'], ['class'=>'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
<script>page = {name: 'sertificate', files_count: 1};</script>