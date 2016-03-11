<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\BReviews;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReviewsController implements the CRUD actions for BReviews model.
 */
class ReviewsController extends Controller
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
     * Lists all BReviews models.
     * @return mixed
     */
    public function actionIndex()
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        $dataProvider = new ActiveDataProvider([
            'query' => BReviews::find(),
			'sort' => [
				'defaultOrder' => ['id' => SORT_DESC],
			],
        ]);
		
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
			'save' => $save,
			'delete' => $delete,
        ]);
    }

    /**
     * Displays a single BReviews model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
		$model = $this->findModel($id);
		if(Yii::$app->request->post()){
			$model->verifyCode = rand(1, 100);
			$model->moderate = $_POST['BReviews']['moderate'];		
			if ($model->save()) {
				Yii::$app->getSession()->setFlash('save', 'true');
				return $this->redirect(['index']);
			}
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BReviews model.
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
     * Finds the BReviews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BReviews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BReviews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
