<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\BContacts;
use app\modules\admin\models\BFeedback;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FeeadbackController implements the CRUD actions for BFeedback model.
 */
class FeedbackController extends Controller
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
     * Lists all BFeedback models.
     * @return mixed
     */
    public function actionIndex()
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        $dataProvider = new ActiveDataProvider([
            'query' => BFeedback::find(),
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
     * Displays a single BFeedback model.
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
			$model->response = $_POST['BFeedback']['response'];	
			if ($model->save()) {
				Yii::$app->mail->compose()
					->setTo($model->email)
					->setFrom(['baron-nt@yandex.ru' => "Мужской спа-салон «Барон»"])
					->setSubject($model->subject)
					->setHtmlBody('Вам отправлен ответ с сайта:	http://'.$_SERVER['SERVER_NAME'].' <br>'.$model->response)
					->send();
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
     * Deletes an existing BFeedback model.
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
     * Finds the BFeedback model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BFeedback the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BFeedback::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	
	public function actionDescription(){
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}

		$model = BContacts::find()->where(['site' => 1])->one();
		
		if(!$model){
			$model = new BContacts;
			$model->site = 1;
		}

		if ($model->load(Yii::$app->request->post()) && $model->save()) {

			return $this->render('description', ['model' => $model, 'success' => true]);
		}

		return $this->render('description', [
			'model' => $model,
		]);
	}
}