<?php

namespace app\controllers;

use Yii;
use app\models\Schedule;
use app\models\RdAccounts;
use app\models\ScheduleDetails;
use app\models\FindSchedule;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use app\models\Pdf;
/**
 * ScheduleController implements the CRUD actions for Schedule model.
 */
class ScheduleController extends Controller
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
     * Lists all Schedule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FindSchedule();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	/**
     * Displays a single Schedule model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$details = ScheduleDetails::find()->where(['schedule_id' => $id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
			'details' => $details
        ]);
    }
	
	public function actionPrint($id)
    {
		$details = ScheduleDetails::find()->where(['schedule_id' => $id])->all();
        
		return $this->renderPartial('print', ['model' => $this->findModel($id), 'details' => $details]);
		
    }

    /**
     * Creates a new Schedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if($_POST)
		{
			
			$nos = $_POST['nos'];
			$sn  = explode("-",$_POST['schedule_num']);
			$sn  = explode("/",$sn[1]);
			$month = $sn[0];
			$year  = $sn[1];
			$schedule_date = $_POST['schedule_date'];			

			$total = sprintf("%.2f",$_POST['total']);
			
			$comm = sprintf("%.2f",($total) * (.04)); // 4% of amount
			
			$tender_amount = sprintf("%.2f",($total) - $comm); 
			
			$tds = sprintf("%.2f",($comm) * (.10));		
			
			//$total_text = Schedule::convert_number_to_words(9800);
			
			$transaction = Yii::$app->db->beginTransaction();
			try
          	{
				$m = new Schedule();
				
				$m->srno  = $nos;
				$m->month = $month;
				$m->year  = $year;
				$m->schedule_date  = $schedule_date;
				$m->gross_total = $total;
				$m->commision = $comm;
				$m->net_amount = $tender_amount;
				$m->tds = $tds;
				
				$m->save();
				
				foreach($_POST['account'] as $a)
				{
					
					$rd = RdAccounts::find()->where(['account_no' => $a])->one();
					if(count($rd) == 1)
					{
						$sd = new ScheduleDetails();
						$sd->schedule_id = $m->id;
						$sd->account_no = $rd->account_no;
						$sd->last_trans_date = $rd->last_trans_date;
						$sd->balance = $rd->balance_out;
						$sd->save();
						
						$rd->last_trans_date = date("Y-m-d", strtotime($schedule_date));
						$rd->balance_out = $rd->balance_out + $rd->deposit_amount;
						
						$rd->save();
					}
					unset($rd);
					unset($sd);
				}
				$transaction->commit();
				$this->redirect(['view', 'id' => $m->id]);
			}
			catch(\Exception $e) {
			  	$transaction->rollBack();
			}
			
		}
        $model = new Schedule();
		return $this->render('create', [
           'model' => $model,
        ]);
        
    }

    /**
     * Updates an existing Schedule model.
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
     * Deletes an existing Schedule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        ScheduleDetails::deleteAll(['schedule_id' => $id]);
		$this->findModel($id)->delete();		
        return $this->redirect(['index']);
    }

    /**
     * Finds the Schedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Schedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Schedule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
