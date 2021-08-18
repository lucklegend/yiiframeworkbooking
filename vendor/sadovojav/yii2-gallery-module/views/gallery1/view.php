<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use sadovojav\gallery\Module;

$this->title = Html::encode($model->name);
$this->params['breadcrumbs'] = [
    ['label' => Module::t('default', 'GALLERIES'), 'url' => ['index']],
    $this->title
];

?>

<div class="gallery-view">
    <div class="page-header">
        <div class="row">
            <div class="col-md-9"> 
            </div>

            <div class="col-md-3">
                <div class="pull-right"> 
                    <?= Html::a(Module::t('default', 'UPDATE'), ['update', 'id' => $model->id], [
                        'class' => 'btn btn-primary btn-sm'
                    ]); ?>
                    <?= Html::a(Module::t('default', 'DELETE'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-sm',
                        'data' => [
                            'confirm' => Module::t('default', 'DELETE_ITEM'),
                            'method' => 'post',
                        ],
                    ]); ?>
					<?= Html::a('Back', ['/gallery/gallery/index1' ], ['class'=>'btn btn-info']) ?>
                </div>
            </div>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [ 
            'name',
            'status:boolean',
            'created',
            'updated',
        ],
    ]); ?>
    
    <?= \sadovojav\gallery\widgets\Gallery::widget([
    'galleryId' => $gallery->galleryId
]); ?>
</div>
