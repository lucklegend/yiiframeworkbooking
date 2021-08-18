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
		<h1 style="color: #ac7339;"><?php echo $cat['category']; 
		//print_r($cat);
		?></h1>
      	<span class="line-h"></span> 
	</div>  
</div> 
<div class="col-sm-9" style="margin-bottom:10px;  ">
    <?php if ( count($pages) == 0){
		echo 'There are no '.$cat['category']. ' yet.'; 
		} else{
		$i = 0;
	?>
</div> 
<?php foreach ($pages as $page){ ?>
    <div class="col-sm-9" style="margin-bottom:0px;  ">
		<?php 
			if($i % 2 == 0 )
				{
					$cl = 'ddd';
				}else
				{
					$cl ='fff3';
				}
			if($page['attachment'] != ''){ 
		?>
						 
		<h3 class="notice" style="padding-bottom: 12px;background-color:#<?php echo $cl; ?>; "  >
			<img src="statics/web/pdf_icon.gif" />&emsp;<a style="opacity: inherit;background-color: #ff000000;" class="refcus" href="<?php echo filepath.'/'.$page['attachment']; ?>" >
			<?php echo $page['title']; $i++; ?></a>
		</h3>
		<?php }  ?>
    </div> 
<?php } }?>
 