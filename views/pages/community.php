<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use vova07\themes\admin\widgets\Box;
use yii\grid\CheckboxColumn;
use yii\widgets\Pjax;
use yii\data\Pagination;
use yii\widgets\LinkPager;

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
        <h1 style="color:#ac7339"><?php echo $cat['category']; ?></h1>
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
		<h3 class="notice" style="padding-bottom: 12px;background-color:#<?php echo $cl; ?>; "  ></h3>
            <?php Pjax::begin(); ?>
				<div style="overflow-x:auto;">
					<div class="container tbl">
				
						<!-- <div class="row">
							<div class="col-sm-12 title">
								<h2>Circulars</h2>
							</div>
						</div>
							
						<div class="row mt">
							<?php foreach ($pages as $page){   

                                if($page['category']  == 'Notices/ Circulars') {}
                            ?>
                            <a  style="color: #CE8651;" class="refcus" href="<?php echo filepath.'/'.$page['attachment']; ?>" >
                            <?php echo $page['created_on'];?></a>
                            <?php echo $page['title']; ?><br>
								
							<?php  }?>	
						</div>
        			</div> 
				</div>
		        <br> -->

				<div style="overflow-x:auto;">
					<div class="container tbl">
				
						<div class="row">
							<div class="col-sm-12 title">
								<h2> Community News</h2>
							</div>
						</div>
							
						<div class="row mt">
							<?php 
							 
							foreach ($pages as $page){  
							if($page['category']  == 'News & Circulars') {
                            ?>
                            <a  style="color: #CE8651;" class="refcus" href="<?php echo filepath.'/'.$page['attachment']; ?>" >
                            <?php echo $page['created_on'];?></a>
                            <?php echo $page['title']; ?><br>
							<?php  } }?>	
						</div>
        			</div> 
				</div>

			<?php Pjax::end(); ?>
<?php } ?>
         