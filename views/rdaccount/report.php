<?php 
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<h1>Report for RD Accounts</h1>
<hr>
<h4>Select Report From Below you want : </h4>

<?php $form = ActiveForm::begin(); ?>

<div class="radio" style="margin-top:30px;">
  <label>
    <input type="radio" name="report" value="1" checked>
    View Outstanding Accounts
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="report" value="2">
    View Advanced Paid Accounts
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="report" value="3">
    Combined Schedules
  </label>
</div>
<div class="form-group">
    <label>Select Month</label>
    <input type="text" class="form-control" style="width:300px;" data-date-viewmode="months" data-date-minviewmode="months" id="input-month" name="month">
  </div>
  <div class="cleafix"></div>
<button type="submit" style="margin-top:30px;" class="btn btn-primary btn-sm">View Report</button>
</form>

<?php ActiveForm::end(); ?>
