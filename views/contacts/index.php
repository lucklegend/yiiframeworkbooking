<?php
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ContactsType;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';
$this->params['subtitle'] = 'Contacts list';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="contacts-index">

<?php 
$boxButtons = $actions = [];
$showActions = false;


$param = Yii::$app->request->queryParams;
   
if(!isset($param['ContactsSearch']['type'])){
  $param['ContactsSearch']['type'] = 1;
}

$data = ContactsType::findOne($param['ContactsSearch']['type']);
 
 $this->params['subtitle'] = $data->name . ' list';
// // if (Yii::$app->user->can('BCreateUsers')) {
// //     $boxButtons[] = '{create}';
// }
if (Yii::$app->user->can('BUpdateUsers')) {
    $actions[] = '{update}';
    $showActions = $showActions || true;
}
/*if (Yii::$app->user->can('BDeleteUsers')) {
    $boxButtons[] = '{batch-delete}';
    $actions[] = '{delete}';
    $showActions = $showActions || true;
}
*/
if ($showActions === true) {
    $gridConfig['columns'][] = [
        'class' => ActionColumn::className(),
        'template' => implode(' ', $actions)
    ];
}
$boxButtons = !empty($boxButtons) ? implode(' ', $boxButtons) : null; ?>


<h2>Amenities</h2>
<div class="row">

    <div class="col-sm-3">

       
        <table cellpadding="10" cellspacing="0" width="100%">
          <tr>
            <td valign="top" align="left" width="180%">
              <fieldset>
              <legend><font class="bold" color="#333333">Amenities </font></legend>
              
                

        
<ul>
  <li><a style="opacity: inherit;background-color: #ff000000;" href="<?= Url::to(['contacts/index',"ContactsSearch[type]" => 1])?>">Embassies</li>
  <li><a style="opacity: inherit;background-color: #ff000000;" href="<?= Url::to(['contacts/index',"ContactsSearch[type]" => 2])?>">Hospitals</li>
  <li><a style="opacity: inherit;background-color: #ff000000;" href="<?= Url::to(['contacts/index',"ContactsSearch[type]" => 3])?>">Hotels</li>
  <li><a style="opacity: inherit;background-color: #ff000000;" href="<?= Url::to(['contacts/index',"ContactsSearch[type]" => 4])?>">Police Stations</li>
  <li><a style="opacity: inherit;background-color: #ff000000;" href="<?= Url::to(['contacts/index',"ContactsSearch[type]" => 5])?>">Post Offices</li>
  <li><a style="opacity: inherit;background-color: #ff000000;" href="<?= Url::to(['contacts/index',"ContactsSearch[type]" => 6])?>">Schools</li>
  <li><a style="opacity: inherit;background-color: #ff000000;" href="<?= Url::to(['contacts/index',"ContactsSearch[type]" => 7])?>">Shopping</li>
    <li><a style="opacity: inherit;background-color: #ff000000;" href="<?= Url::to(['contacts/index',"ContactsSearch[type]" => 8])?>">Useful Information</li>
</ul> <br>

  </td>
              </tr>
          </table>
      </fieldset>

      <address>
13 Ardmore Park #01-01<br>
Singapore 259961<br>
Tel: +65 6733 0862<br>
Fax: +65 6733 0872
</address>

    </div>


   
    <div class="col-sm-9">
     <?php Box::begin(
            [
                'title' => $this->params['subtitle'],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'buttonsTemplate' => $boxButtons,
                //'grid' => $gridId
            ]
        ); ?>
    <?= GridView::widget([ 
        'dataProvider' => $dataProvider,
        'rowOptions'   => function ($model, $index, $widget, $grid) {
            return [
                'id' => $model['id'], 
                // 'onclick' => 'location.href="'
                //     . Yii::$app->urlManager->createUrl('contacts/view') 
                //     . '&id="+(this.id);',
                // 'style' =>'cursor:pointer;', 
            ];
     },	
        //'filterModel' => $searchModel,
        'columns' => [
   //          ['class' => 'yii\grid\SerialColumn'],
			// [
   //          'class' => CheckboxColumn::classname()
   //      ],

   //          'id',
			// [
   //          'attribute' => 'type',
			// 'value' => 'type1.name',
			// ],

            //'fname',
            //'lname',
            [
                'attribute' => 'cname',
                'contentOptions' => ['style' => 'opacity: inherit !important;background-color: #ff000000 !important;'],
            ],
            //'cname',
            // 'email:email',
            // 'mobile',
            // 'fax',
            //'address',
            [
                'attribute'=>'address',
                //'label' => '',
                'format' => 'html',
                'contentOptions' => ['style' => 'opacity: inherit !important;background-color: #ff000000 !important;'],
                'value' => function ($model) { 
                    $return = '';
                    if($model->address != ''){
                        $return .= '<i class="fa fa-address-book"></i> '.$model->address;
                   }
                    if($model->mobile != ''){
                        $return .= '<br><i class="fa fa-phone"></i> '.$model->mobile;
                   }
                    if($model->fax != ''){
                        $return .= '<br><i class="fa fa-fax"></i> '.$model->fax;
                   }
                    if($model->zip != ''){
                    	 $return .= '<br><i class="fa fa-map-marker"></i> '.$model->zip;
                    }
                    return $return;
                }
            ],

//             
            // 'city',
            // 'zip',
            // 'service_start',
            // 'service_end',
            // 'bank_account_name',
            // 'bank_account_no',
            // 'bank_name',
            // 'bank_ifsc',
            // 'notes:ntext',
            // 'image',
            // 'created',
            // 'active',
            // 'status',

            //['class' => 'yii\grid\ActionColumn'],
        
], ]); ?>
        <?php Box::end(); ?>
    </div>
</div>
