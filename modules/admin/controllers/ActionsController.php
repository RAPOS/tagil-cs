<?php
namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\BActions;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActionsController implements the CRUD actions for BActions model.
 */
class ActionsController extends Controller
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
     * Lists all BActions models.
     * @return mixed
     */
    public function actionIndex()
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        $dataProvider = new ActiveDataProvider([
            'query' => BActions::find(),
			'sort' => [
				'defaultOrder' => ['id' => SORT_DESC],
			],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new BActions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        $model = new BActions();

        if ($model->load(Yii::$app->request->post())) {
			$model->date = time();
			$model->save();
			//print_r($model->getErrors());
            return $this->redirect(['/admin/actions']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BActions model.
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
             return $this->redirect(['/admin/actions']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BActions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if(Yii::$app->user->isGuest){
			$this->redirect(Yii::$app->user->loginUrl);
		}
		
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BActions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BActions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BActions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
