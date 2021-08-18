<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pages';
$this->params['subtitle'] = 'Pages list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">
<?php 
$boxButtons = $actions = [];
$showActions = false;

if (Yii::$app->user->can('BCreateUsers')) {
    $boxButtons[] = '{create}';
}
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
 
      	 <div class="page-title">
      <h1 style="color:ac7339;"> Useful Information</h1>
      <span class="line-h"></span> </div>
		
		
			<table class="table table-striped" >
			<p>In case of emergencies, here are a list of useful numbers that you can seek help form:
  <thead>
    <tr>
      
      <th scope="col" style="color:#8c704b;">Service</th>
      <th scope="col" style="color:#8c704b;">Number</th> 
    </tr>
  </thead>
  <tbody>
   
     <?php 		  foreach ($pages as $page){  
	 echo "<tr>";
	 echo "<td style='border-top: 1px solid #dddddd2b; color:#000;'>".$page['title']."</td>";
	 echo "<td style='border-top: 1px solid #dddddd2b; color:#000;'>".$page['content']."</td>";
	 echo "</tr>";
	 } ?>
     
    
  </tbody>
</table>
		    