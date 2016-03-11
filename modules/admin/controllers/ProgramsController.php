<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\BImages;
use app\modules\admin\models\BMainpageMassage;
use app\modules\admin\models\BTypesOfMassage;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProgramsController implements the CRUD actions for BTypesOfMassage model.
 */
class ProgramsController extends Controller
{
	public $layout = 'dark';
	
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all BTypesOfMassage models.
     * @return mixed
     */
    public function actionIndex()
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        $dataProvider = new ActiveDataProvider([
            'query' => BTypesOfMassage::find(),
			'sort' => [
				'defaultOrder' => ['sort' => SORT_ASC],
			],
        ]);

		if(Yii::$app->getSession()->getFlash('create')){
			$create = true;
		} else {
			$create = false;
		}
		if(Yii::$app->getSession()->getFlash('save')){
			$save = true;
		} else {
			$save = false;
		}
		if(Yii::$app->getSession()->getFlash('delete')){
			$delete = true;
		} else {
			$delete = false;
		}
		
        return $this->render('index', [
            'dataProvider' => $dataProvider,
			'create' => $create,
			'save' => $save,
			'delete' => $delete,
        ]);
    }

    /**
     * Creates a new BTypesOfMassage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        $model = new BTypesOfMassage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$model->images = json_encode($_POST[id_img]);
			if($model->save()){
				Yii::$app->getSession()->setFlash('create', 'true');
				return $this->redirect(['index']);
			}
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BTypesOfMassage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if($_POST[id_img]){
				$array_id_img = json_decode($model->images);
				if(is_array($array_id_img)){
					$new_pre_images = array_merge($array_id_img, $_POST[id_img]);
					$model->images = json_encode(array_unique($new_pre_images));
					if($model->save()){
						Yii::$app->getSession()->setFlash('save', 'true');
						return $this->redirect(['index']);
					}
				} else {
					$model->images = json_encode($_POST[id_img]);
					if($model->save()){
						Yii::$app->getSession()->setFlash('save', 'true');
						return $this->redirect(['index']);
					}
				}
			} else {
				Yii::$app->getSession()->setFlash('save', 'true');
				return $this->redirect(['index']);
			}
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BTypesOfMassage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
		if( $this->findModel($id)->delete()){
			Yii::$app->getSession()->setFlash('delete', 'true');
		}

        return $this->redirect(['index']);
    }

    /**
     * Finds the BTypesOfMassage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BTypesOfMassage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BTypesOfMassage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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
			$model = $this->findModel($_POST['id_massage']);
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
	
	public function actionSort(){
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
		if(!$_POST){
			return $this->redirect('/admin/programs');
		}
		
		if($_POST['id_massage']){
			foreach($_POST['id_massage'] as $key => $id_massage){
				$ids[] ="(".$id_massage.",".($key+1).")";
				$model = $this->findModel($id_massage);
				$model->sort = $key+1;
				$model->save();
			}
			print json_encode(array('msg' => 'ОК'));
		}
	}
	
	public function actionDescription(){
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}

		$model = BMainpageMassage::find()->where(['site' => 1])->one();
		
		if(!$model){
			$model = new BMainpageMassage;
		}

		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				$model->site = 1;
				$model->save();
				
				return $this->render('description', ['model' => $model, 'success' => true]);
			}
		}

		return $this->render('description', [
			'model' => $model,
		]);
	}
}