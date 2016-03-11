<?php
use app\modules\admin\models\BImages;
use dosamigos\tinymce\TinyMce;
use kartik\widgets\FileInput;
use kartik\widgets\SwitchInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$array_image = array();
$array_image_cfg = array();
if(!$model->isNewRecord){
	$array_id_images = json_decode($model->images);
	for($i=0;$i<count($array_id_images);$i++){
		$BImages = BImages::findOne($array_id_images[$i]);
		$array_image[] = Html::img('/'.$BImages->path, ['class'=>'file-preview-image', 'alt'=>$BImages->name, 'title'=>$BImages->name, 'style'=>'width:auto;height:210px;']);
		$array_image_cfg[] = [
			'caption' => $BImages->name,
			'url' => '/admin/programs/deleteimages',
			'key' =>  $BImages->id_img,
			'extra' => ['delete_id_img' => $BImages->id_img, 'delete_path' => $BImages->path, 'id_master' => $model->id_master, 'id_images' => $array_id_images],
		];
	}
}
if(!$array_image && !$array_image_cfg){
	$array_image = array();
	$array_image_cfg = array();
}
?>

<div class="bmasters-form">
    <?php $form = ActiveForm::begin(); ?>
	<div class="clearfix">
		<div style="float: left;">
			<?= $form->field($model, 'name')->textInput(
				[
					'maxlength' => true,
					'style' => 'width: 250px;',
				]
			) ?>
		</div>
		<div style="float: left;margin-left: 39px;">
			<?= $form->field($model, 'new')->widget(SwitchInput::classname(), [
				'pluginOptions' => [
					'size' => 'normal',
					'onColor' => 'success',
					'offColor' => 'danger',
					'onText' => 'Включить',
					'offText' => 'Выключить',
					
				],
			])?>
		</div>
		<div style="float: left;margin-left: 39px;">
			<?= $form->field($model, 'tour')->widget(SwitchInput::classname(), [
				'pluginOptions' => [
					'size' => 'normal',
					'onColor' => 'success',
					'offColor' => 'danger',
					'onText' => 'Включить',
					'offText' => 'Выключить',
					
				],
			])?>
		</div>
	</div>
	<div class="clearfix">
		<div style="float: left;">
			<?= $form->field($model, 'age')->textInput([
				'style' => 'width: 50px;',
				'maxlength' => 2,
			]) ?>
		</div>
		<div style="float: left;margin-left: 150px;">
			<?= $form->field($model, 'growth')->textInput([
				'style' => 'width: 50px;',
				'maxlength' => 3,
			]) ?>
		</div>
		<div style="float: left;margin-left: 150px;">
			<?= $form->field($model, 'weight')->textInput([
				'style' => 'width: 50px;',
				'maxlength' => 3,
			]) ?>
		</div>
		<div style="float: left;margin-left: 150px;">
			<?= $form->field($model, 'breast')->textInput([
				'style' => 'width: 50px;',
				'maxlength' => 2,
			]) ?>
		</div>
	</div>
    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'description')->widget(TinyMce::className(), [
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
				'image' => ['width' => 'auto', 'height' => '220px'],
			],
			'maxFileCount' => 3,
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
				if($(".file-input .file-preview-frame").length == 3){
					$(".file-input .input-group").show();
				}
			}',
			'fileuploaded' => 'function(event, data, previewId, index){
				var form = data.form, files = data.files, extra = data.extra, response = data.response, reader = data.reader;
				$(".file-input").append(\'<input hidden type="text" name="id_img[]" value="\'+response["id_img"]+\'"/>\');
				$(".file-input input[name=\"id_img[]\"]").each(function(i, value){
					$(this).attr("data-name", files[i]["name"]);
				});
				if($(".file-input .file-preview-frame").length == 3){
					$(".file-input .input-group").hide();
				}
			}',
			'filesuccessremove' => 'function(event, id){
				if($(".file-input .file-preview-frame").length == 3){
					$(".file-input .input-group").show();
				}
			}',
		]
	]);?>
	<br>
    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ?  'Сохранить' : 'Обновить', ['class' => 'btn btn-success'])?>
		<?= Html::a('Назад', ['/admin/masters'], ['class'=>'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script>page = {name: 'masters', files_count: 3};</script>