<?php

namespace app\controllers;

use Yii;
use app\models\MisAccount;
use app\models\FindMisAccount;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MisController implements the CRUD actions for MisAccount model.
 */
class MisController extends Controller
{
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
     * Lists all MisAccount models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FindMisAccount();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MisAccount model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MisAccount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MisAccount();
		
		if($_POST){
			
			$model->load(Yii::$app->request->post());
			
			$model->end_date = date('Y-m-d', strtotime($model->start_date . " +" . $model->term . " year"));
			
			die($model->end_date);
			$model->save();
		
            return $this->redirect(['view', 'id' => $model->account]);
			
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

 /*?>koi bewakuf nahi h yaha pe..!!
 
 He will get it that ur my gf? right?
 to wo to wese bh pata chal jaega.. aur to kitni PARAAI ladkiyo k saamne AAP ese baithte ho.. baniyaan me wo bhi rupa frontline wala? HOOO!!!
 
 I want to introduce you.. That you are my girl.. woman.. hooooo...!!!!
 
 ri4ufg3y84fgyour934u....
 
 okey..<?php */
 
 
	 
    /*
     * Updates an existing MisAccount model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->account]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MisAccount model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MisAccount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MisAccount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MisAccount::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
