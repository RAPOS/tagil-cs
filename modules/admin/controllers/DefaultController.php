<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\modules\admin\models\BAdmins;
use app\modules\admin\models\BImages;
use app\modules\admin\models\BInterior;
use app\modules\admin\models\BMainpage;
use app\modules\admin\models\BRules;
use app\modules\admin\models\BSettings;
use app\modules\admin\models\BTypesOfMassage;
use app\modules\admin\models\BVacancy;
use app\modules\admin\models\BSertificates;

class DefaultController extends Controller
{
	public $layout = 'dark';
	
    public function actionIndex()
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        return $this->render('index');
    }

    public function actionRules() {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		$model = BRules::find()->where(['site' => 1])->one();
		
		if(!$model){
		print_r($_POST);
			$model = new BRules;
			$model->site = 1;
		}
		
		if ($model->load(Yii::$app->request->post()) && $model->save()) {

			return $this->render('rules', ['model' => $model, 'success' => true]);
		}

		return $this->render('rules', [
			'model' => $model,
		]);
	
    }
	
    public function actionVacancy()
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}

		$model = BVacancy::find()->where(['site' => 1])->one();
		
		if(!$model){
			$model = new BVacancy;
			$model->site = 1;
		}

		if ($model->load(Yii::$app->request->post()) && $model->save()) {

			return $this->render('vacancy', ['model' => $model, 'success' => true]);
		}

		return $this->render('vacancy', [
			'model' => $model,
		]);
    }

    public function actionSertificate()
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}

		$model = BSertificates::find()->where(['site' => 1])->one();
		
		if(!$model){
			$model = new BSertificates;
			$model->site = 1;
		}
		
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if($_POST[id_img]){
				$array_id_img = json_decode($model->images);
				if(is_array($array_id_img)){
					$new_pre_images = array_merge($array_id_img, $_POST[id_img]);
					$model->images = json_encode(array_unique($new_pre_images));
					$model->save();
				} else {
					$model->images = json_encode($_POST[id_img]);
					$model->save();
				}
			}
			$model->save();			
			
			return $this->render('sertificate', ['model' => $model, 'success' => true]);
		}	
		
		return $this->render('sertificate', ['model' => $model]);
    }	
	
	public function actionLogin()
	{
		$model = new BAdmins;
		if(Yii::$app->request->post()){
			$model->attributes = Yii::$app->request->post('BAdmins');
			if($model->validate()) {
				$BAdmins = BAdmins::find()->where(["name" => $model->name])->one();
				if($BAdmins){
					if($BAdmins->password === md5(md5($model->password))){
						if($BAdmins->login()) $this->redirect(Yii::$app->user->returnUrl);
					} else {
						print "Не верный пароль.";
						return;
					}
				} else {
					print "Не верный логин.";
					return;
				}
			} else {
				print "Не прошло валидацию.";
				return;
			}
		}

		return $this->render('login', [
			'model' => $model,
		]);
	}
	
    public function actionLogout()
    {
        Yii::$app->user->logout();
		return $this->goHome();
    }
	
	public function actionMainpage(){
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}

		$model = BMainpage::find()->where(['site' => 1])->one();
		if(!$model){
			$model = new BMainpage;
			$model->site = 1;
		}
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if($_POST[id_img]){
				$array_id_img = json_decode($model->images);
				if(is_array($array_id_img)){
					$new_pre_images = array_merge($array_id_img, $_POST[id_img]);
					$model->images = json_encode(array_unique($new_pre_images));
					$model->save();
				} else {
					$model->images = json_encode($_POST[id_img]);
					$model->save();
				}
			}
			$model->save();
			
			return $this->render('mainpage', ['model' => $model, 'success' => true]);
		}

		return $this->render('mainpage', [
			'model' => $model,
		]);
	}
	
	public function actionPrograms(){
		$this->redirect('/admin/programs/');
	}

	public function actionMasters(){
		$this->redirect('/admin/masters/');
	}
	
	public function actionFeedback(){
		$this->redirect('/admin/feedback/');
	}
	
	public function actionInterior(){
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
		$model = BInterior::find()->where(['site' => 1])->one();
		if(!$model){
			$model = new BInterior;
			$model->site = 1;
		}
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if($_POST[id_img]){
				$array_id_img = json_decode($model->images);
				if(is_array($array_id_img)){
					$new_pre_images = array_merge($array_id_img, $_POST[id_img]);
					$model->images = json_encode(array_unique($new_pre_images));
					$model->save();
				} else {
					$model->images = json_encode($_POST[id_img]);
					$model->save();
				}
			}
			$model->save();
				
			return $this->redirect('interior', ['model' => $model, 'success' => true]);
		}

		return $this->render('interior', [
			'model' => $model,
		]);
	}

	
	public function actionSettings(){
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
		$model = BSettings::find()->where(['site' => 1])->one();
		if(!$model){
			$model = new BSettings;
			$model->site = 1;
		}
		if ($model->load(Yii::$app->request->post()) && $model->save()) {

			return $this->render('settings', ['model' => $model, 'success' => true]);
		}

		return $this->render('settings', [
			'model' => $model,
		]);
	}
	
	public function actionUserchange(){
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
		$model = BAdmins::findOne(Yii::$app->user->id);
		if(!$model){
			$model = new BAdmins;
		}
		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				$model->password = md5(md5($model->password));
				$model->save();
				
				return $this->render('userchange', ['model' => $model, 'success' => true]);
			}
		}

		return $this->render('userchange', ['model' => $model]);
	}
	
	public function actionUpload(){
		if($_FILES){
			for($i=0;$i<count($_FILES);$i++){
				if(!in_array(exif_imagetype($_FILES['image']['tmp_name'][$i]), array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG))){
					return false;
				}
				$path_info = pathinfo($_FILES['image']['name'][$i]);
				$name = md5($path_info['filename'].md5(rand(1,1000000)));
				$dir = 'files/images';
				
				$BImages = new BImages;
				$BImages->name = $name;
				$BImages->extension = $path_info['extension'];
				if($BImages->save()){
					$BImages->path = $dir.'/'.$BImages->id_img.'/'.$name.'.'.$path_info['extension'];
					$BImages->save();
					
					$path = $dir.'/'.$BImages->id_img;
					mkdir($_SERVER['DOCUMENT_ROOT'].'/'.$path, 0777, true);
					if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/files/uploads/')){
						mkdir($_SERVER['DOCUMENT_ROOT'].'/files/uploads/');
					}
					if(move_uploaded_file($_FILES['image']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'].'/files/uploads/'.$name.'.'.$path_info['extension'])){
						$image = Yii::$app->image->load(Yii::getAlias('@webroot/files/uploads/'.$name.'.'.$path_info['extension']));
						$image->resize(800, NULL, \yii\image\drivers\Image::AUTO);
						$mark = Yii::$app->image->load(Yii::getAlias('@webroot/images/label.png'));
						$image->watermark($mark, TRUE, TRUE);
						$image->save(Yii::getAlias('@webroot/'.$BImages->path));
						
						unlink($_SERVER['DOCUMENT_ROOT'].'/files/uploads/'.$name.'.'.$path_info['extension']);
						print json_encode(array('id_img' => $BImages->id_img));
					}
				}
			}
		}
	}
	
	public function actionDeleteimages(){
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
		if($_POST){
			$new_array_images = array();
			for($i=0;$i<count($_POST['id_images']);$i++){
				if($_POST['delete_id_img'] != $_POST['id_images'][$i]){
					$new_array_images[] = $_POST['id_images'][$i];
				}
			}
			if($_POST['page'] == 'interior'){
				$model = BInterior::find()->where(['site' => 1])->one();
			} else if($_POST['page'] == 'sertificate'){
				$model = BSertificates::find()->where(['site' => 1])->one();
			} else if($_POST['page'] == 'mainpage'){
				$model = BMainpage::find()->where(['site' => 1])->one();
			}
			$model->images = json_encode($new_array_images);
			if($model->save()){
				$BImages = BImages::findOne($_POST['delete_id_img']);
				if($BImages->delete()){
					if(!unlink(Yii::getAlias('@webroot/'.$_POST['delete_path']))){
						return 'Не удалось удалить изображение локально';
					} else {
						return true;
					}
				} else {
					return 'Не удалось удалить изображение из базы';
				}
			} else {
				return 'Не удалось перезаписать изображения';
			}
		} else {
			return 'Не пришли данные для удаления';
		}
	}
}
