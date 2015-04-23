<?php

namespace app\controllers;

use Yii;
use app\models\RdAccounts;
use app\models\Collections;
use app\models\schedule;
use app\models\FindRdAccounts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\db\Connection;
use  yii\data\ActiveDataProvider;
/**
 * RdAccountController implements the CRUD actions for RdAccounts model.
 */
class RdAccountController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','create','view','print', 'collections', 'update', 'delete' ,'report'],
                        'roles' => ['@'],
                    ],
                ],
            ],

        ];
    }

    /**
     * Lists all RdAccounts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FindRdAccounts();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RdAccounts model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
	public function actionPrint($id)
    {
      $month = substr($id, 0,2);
	  $year  = substr($id, 4, 4);
	   
	  $sql = "SELECT * FROM `schedule` WHERE month = $month AND year = $year";
						
	  $collections = Schedule::findBySql($sql)->all();
	  //$dataProvider = $collections->search(Yii::$app->request->queryParams);
	  return $this->renderPartial('summary_print', [
		  //'model' => $provider,
		  'collections'  => $collections,
		  'year'  => $year,
		  'month'	=> $month
	  ]);
	   
    }
	
	public function actionReport()
	{
		$model = new RdAccounts();
		if($_POST)
		{
			$report = intval($_POST['report']);
			$temp   = $_POST['month'];
			$temp   = explode("/", $temp);
			$month  = rtrim($temp[0],"0");
			$year  =  $temp[1];
			
			if($report == 1)
			{
				
				$provider = new ActiveDataProvider([
					'query' => Collections::find()->where(['ispaid' => '0', 'month' => $month, 'year' => $year]),
					'pagination' => [
						'pageSize' => 200,
					],
				]);
				
				//$collections = 
				//$dataProvider = $collections->search(Yii::$app->request->queryParams);
				return $this->render('outstanding', [
					//'model' => $provider,
					'data'  => $provider,
					'year'  => $year,
					'month'	=> $month
				]);
			}
			elseif($report == 2)
			{
				
				$sql = "SELECT * FROM `collections` WHERE ispaid = 1 AND month > $month AND year >= $year";
				
				//die($sql);
				
				$provider = new ActiveDataProvider([
					'query' => Collections::findBySql($sql),
					'pagination' => [
						'pageSize' => 200,
					],
				]);
				
				//$collections = 
				//$dataProvider = $collections->search(Yii::$app->request->queryParams);
				return $this->render('advanced', [
					//'model' => $provider,
					'data'  => $provider,
					'year'  => $year,
					'month'	=> $month
				]);
			}
			elseif($report == 3)
			{
				$sql = "SELECT * FROM `schedule` WHERE month = $month AND year = $year";
				
				
				
				$collections = Schedule::findBySql($sql)->all();
				//$dataProvider = $collections->search(Yii::$app->request->queryParams);
				return $this->render('summary', [
					//'model' => $provider,
					'collections'  => $collections,
					'year'  => $year,
					'month'	=> $month
				]);
			}
			else
			{
				throw new NotFoundHttpException('The requested page does not exist.');
			}
		}
		
		return $this->render('report', [
            'model' => $model,
        ]);
	}

    /**
     * Creates a new RdAccounts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RdAccounts();
		
		
		
        if($_POST){
        $transaction = Yii::$app->db->beginTransaction();
          try
          {
              $model->date_registered = date('Y-m-d');

              $model->load(Yii::$app->request->post());
              $model->save();

              $start_date = $_POST['RdAccounts']['start_date'];
              $end_date   = $_POST['RdAccounts']['end_date'];
              $accound_id = $_POST['RdAccounts']['account_no'];
              $date1      = $start_date;
              $date2      = $end_date;
              $output     = [];
              $time       = strtotime($date1);
              $last       = date('m-Y', strtotime($date2));

              do {
                  $output[] = [
                      'month' => date('m', $time),
                      'year' => date('Y', $time),
                      'inst_month' => date('Y-m', $time) . "-01",
                  ];
                  $month = date('m-Y', $time);
                  $time = strtotime('+1 month', $time);
              } while ($month != $last);

              foreach($output as $l)
              {
                  $collection                 =   new Collections();
                  $collection->account_id     =   $accound_id;
                  $collection->ispaid         =   0;
                  $collection->month          =   $l['month'];
                  $collection->year           =   $l['year'];
                  $collection->inst_month     =   $l['inst_month'];
                  $collection->save();
              }

              $transaction->commit();

              return $this->redirect(['view', 'id' => $model->account_no]);
          }
          catch(\Exception $e) {
              $transaction->rollBack();
          }
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }
	
	
	
	public function actionCollections($id)
    {
        $collections = Collections::findAll(['account_id' => $id]);
		
		if(count($collections) == 0)
		{
			return $this->redirect(['index']);
		}
		
		$rdaccount = RdAccounts::FindOne(['account_no' => $id]);		
		
		return $this->render('collection', [
            'collections' => $collections,
			'rdaccount'	  => $rdaccount
        ]);
    }
	
	
	
	
    /**
     * Updates an existing RdAccounts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->account_no]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RdAccounts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        //Collections::deleteAll(['account_id' => $id]);
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RdAccounts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return RdAccounts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RdAccounts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
