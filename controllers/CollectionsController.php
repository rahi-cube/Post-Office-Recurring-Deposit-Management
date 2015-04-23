<?php

namespace app\controllers;

use Yii;
use app\models\Collections;
use app\models\RdAccounts;
use app\models\FindCollections;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * CollectionsController implements the CRUD actions for Collections model.
 */
class CollectionsController extends Controller
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
     * Lists all Collections models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FindCollections();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Collections model.
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
     * Creates a new Collections model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Collections();

        if($_POST)
        {

          $collection_date = $_POST['collection_date'];
          $transaction = Yii::$app->db->beginTransaction();
          try
          {
                foreach($_POST['info'] as $row)
                {
                    $date = $row['collection_date'];

                    $pieces  = explode("-", $date);
                    $month   = ltrim($pieces[1],"0");
                    $year    = $pieces[0];
                    $account = $row['collection_account_no'];

                    $date = $date . "-01";

                    $col = Collections::findOne(['month' => $month, 'year' => $year, 'account_id' => $account, 'inst_month' => $date, 'ispaid' => 0]);
                    
                    if(count($col) == 1)
                    {
                        $col->ispaid = 1;
                        $col->receive_date = $collection_date;
                        $col->save();
						$rd = RdAccounts::findOne(['account_no' => $account]);
						$rd->balance_in = intval($rd->balance_in) + intval($rd->deposit_amount);
						$rd->save();
                    }
                    else
                    {
                          continue;
                    }

                }
                $transaction->commit();
                //die();
          }
          catch(\Exception $e) {
              $transaction->rollBack();
          }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Collections model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Collections model.
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
     * Finds the Collections model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Collections the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Collections::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
