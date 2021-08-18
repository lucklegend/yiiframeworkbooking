<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserfulSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contractors Info');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="useful info-index">


<h1><?= Html::encode($this->title) ?></h1> 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
	<div style="overflow-x:auto;">
        <table class="table table-bordered">
            <thead style="background-color: #8c6238; color: #fff;">
                <tr>
                <th scope="col">S.NO</th>
                <th scope="col">Name</th> 
                <th scope="col">Type Of Service</th> 
                <th scope="col">Contacts</th>  
                </tr>
            </thead>
        
        <tbody>
            <?php 
                $n=0;
                foreach ($pages as $page){  
                $n++;
            ?>
            <?php if($page->service !== 'amenities'){  ?>
            <tr>
                <td style="vertical-align: middle;padding: 13px;text-align: center"> <?php echo $n?> </td>
                <td style="vertical-align: middle;padding: 13px;text-align: center"> <?php echo $page['name']?> </td>
                <td style="vertical-align: middle;padding: 13px;text-align: center"> <?php echo $page['service'] ?> </td>
                <td style="vertical-align: middle;padding: 13px;text-align: center"> <?php echo $page['address'] ?> </td>
                
            
            </tr>
            <?php } ?>
        </tbody>
        <?php } ?>
        </table> 
	</div> 
     
</div>
