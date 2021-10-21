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
	$boxButtons = !empty($boxButtons) ? implode(' ', $boxButtons) : null;
	?>
	<div class="page-title">
		<h1><?php echo $cat['category']; ?></h1>
		<span class="line-h"></span>
	</div>
	<?php if (count($pages) == 0) {
		echo 'There are no ' . $cat['category'] . ' yet.';
	} else {
		$i = 0;
	?>
		<table style="width:100%">
			<?php foreach ($pages as $key => $page) {
			}
			?>

			<td> <?php ++$key ?> </td>
			<td>
				<?php foreach ($pages as $page) { ?>
					<?php
					if ($i % 2 == 0) {
						$cl = 'ddd';
					} else {
						$cl = 'fff3';
					}
					if ($page['attachment'] != '' && $page['type'] != 4) {
					?>
						<div>
							<b class="b text-white"><img src="img/icon-handbook.png" />&emsp;
								<?php echo $page['title'];
								$i++; ?>
							</b>
							<small>Published on <?= $page['created_on'];
																	$i++; ?></small>
							<hr>
						</div>
						<div class="one">
							<h5 class="notice" style="padding-bottom:5px;opacity: inherit;background-color: #ff000000;<?php echo $cl; ?>;">
								<b class="b1">File attachment
								</b><br><br><img src="statics/web/pdf_icon.gif" />&emsp;
								<u>
									<a style="padding-bottom:1px;opacity: inherit;background-color: #ff000000;" class="refcus" href="<?php echo filepath . '/' . $page['attachment']; ?>">
										<?php echo $page['title'];
										$i++; ?>
								</u>
								<a target="_BLANK" href="<?php echo filepath . '/' . $page['attachment']; ?>" style="float:right;margin-right: 5px;">
									<i style="opacity: inherit;background-color: #ff000000;" class="fa fa-download"></i></a>
								</a>
							</h5>
						</div> <br>
					<?php }  ?>

				<?php } ?>
			</td>
		</table>


	<?php } ?>
</div>
<style>
	.h2 {
		margin-top: 15px;
		padding-bottom: 10px;
		font-size: 21px;
		color: #814250;
		font-weight: bold;
		font-family: calibri;
	}

	.b {
		font-size: 13px;
		display: block;
		background-color: #8c6238;
	}

	.text-white {
		color: white !important;
	}

	.b1 {
		font-size: 13px;
		padding: 5px;
		background: #8c6238 !important;
		color: #fff;
	}

	.one {
		display: block;
		border: 1px SOLID #686868;
		margin-top: 1px;
		padding: 1px;
		margin-left: 5px;
	}
</style>
</div>