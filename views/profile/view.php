<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'My Profile';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//print_r($model);
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
			[
				'attribute' => 'fname',
				'value' =>$model->fname == '' ? '-' : $model->fname	
			],
			[
				'attribute' => 'lname',
				'value' =>$model->lname == '' ? '-' : $model->lname	
			],
			[
				'attribute' => 'email',
				'type' => 'email',
				'value' =>$model->email == '' ? '-' : $model->email	
			],
			[
				'attribute' => 'contact_no',
				'value' =>$model->contact_no == '' ? '-' : $model->contact_no	
			],
        ],
    ]) ?>

</div>
