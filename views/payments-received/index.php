<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaymentsReceivedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments Received';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-received-index no-padding">
  <div class="row">
    <div class="col-xs-12">
      <div class="col-lg-4 col-sm-4 col-xs-12 no-padding"><h3 class="box-title"><i class="fa fa-th-list"></i> <?php echo $this->title ?></h3></div>
      <div class="col-xs-4 col-sm-4 col-xs-12 no-padding" style="padding-top: 20px !important;"><?php echo $this->render('_search', ['model' => $searchModel]); ?></div>
      <div class="col-lg-4 col-sm-4 col-xs-12 no-padding" style="padding-top: 20px !important;">
        <div class="col-xs-4 left-padding">
           
        </div>
        <div class="col-xs-4 left-padding">
        <?= Html::a('<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp; PDF', ['export-data/export-to-pdf', 'model'=>get_class($searchModel)], ['class' => 'btn btn-block btn-danger btn-sml', 'target'=>'_blank']) ?>
        </div>
        <div class="col-xs-4 left-padding">
        <?= Html::a('<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp; EXCEL', ['export-data/export-excel', 'model'=>get_class($searchModel)], ['class' => 'btn btn-block btn-primary btn-sml', 'target'=>'_blank']) ?>
        </div>
      </div>
    </div>
  </div>

    <div class="row">
    <div class="col-xs-12" style="padding-top: 10px;">
    <div class="box">
    <div class="box-body table-responsive">
    <div class="state-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'  => "{items}\n{pager}",
        'headerRowOptions' => ['style'=>'background-color:#fff'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
            'attribute' => 'aggregator',
            'value'=>'aggregators.name',
            ],
            'aggregator_transaction_id',
            'vehicle_reference',
            //'aggregator_payment_processed_date',
            // 'date_received',
            'aggregator_payment_reference',
            'amount',
            // 'aggregator_memo',
            'payer_mobile',
            // 'payer_email:email',
            'payer_name',
            // 'payment_recon_flag',
            'payment_status',
            'sticker_generated:boolean',

             [
             'class' => 'app\components\CustomActionColumn',
             'template' => '{view}',
             ],
        ],
    ]); ?>
     </div>
  </div>
</div>

</div>
</div>
</div>


<?php 
$script = <<< JS
$("document").ready(function(){ 
    $("#insurance").removeClass('active').addClass('active');
    $("#payments").removeClass('active').addClass('active');
  });
JS;
$this->registerJs($script);
?>