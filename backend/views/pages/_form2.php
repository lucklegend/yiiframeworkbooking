<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\PagesType;
use common\models\PagesCategories;
use common\models\Profiles;
use vova07\fileapi\Widget;
use vova07\users\Module;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' =>   'multipart/form-data']]); ?>
          <div class="box-body table-responsive">
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
           </div>
           <div class="col-sm-6">
           <?php $model->category = $_GET['id']; ?>
                <?= $form->field($model, 'category')->dropDownList(ArrayHelper::map(PagesCategories::find()->all(),'id','category'),  
                ['prompt'=>'Select from list', 'disabled' => 'true']); ?>
           </div>
       </div>
       
        <div class="row">
    			 <div class="col-sm-6">
                           <?= $form->field($model, 'image')->widget(Widget::className(),
                [
                    'settings' => [
                        'url' => ['fileapi-upload']
                    ],
                  //  'crop' => true,
                  //  'cropResizeWidth' => 100,
                   // 'cropResizeHeight' => 100
                ]
            ) ?>
                        <?php if($model->image){ ?>
           <?php //= Html::img('../statics/web/users/avatars/'.$profile->avatar_url);?> 
            <img src="../statics/web/pages/<?php echo $model->image; ?>" width="100" height="100"  />
            <?php }?>

           </div>
          <div class="col-sm-6">
                           <?= $form->field($model, 'attachment')->widget(FileInput::classname(), [
							    'pluginOptions' => [
								'showPreview' => false,
								'showCaption' => true,
								'allowedFileExtensions'=>['jpg','pdf','png','doc','docx','xls','xlsx']
								]
							]);?>
            </div>
      </div>
        
        <div class="row">
           <div class="col-sm-6">
    			<?= $form->field($model, 'type')->dropDownList(ArrayHelper::map(PagesType::find()->all(),'id','type'),  ['prompt'=>'Select from list']); ?>
            </div>
            <div class="col-sm-6">
   				<?= $form->field($model, 'created_by')->dropDownList(ArrayHelper::map(Profiles::find()->all(),'user_id','name'),  ['prompt'=>'Select from list']); ?>
            </div>
        </div>
        
        <div class="row">
           <div class="col-sm-6">
   			 <?= $form->field($model, 'status')->dropDownList(['0' => 'InActive', '1' => 'Active']); ?>
           </div>
           <div class="col-sm-6">
             <?= $form->field($model, 'content')->widget(
                Imperavi::className(),
                [
                    'settings' => [
                        'minHeight' => 300,
                        'imageGetJson' => Url::to(['/pages/imperavi-get']),
                        'imageUpload' => Url::to(['/pages/imperavi-image-upload']),
                        'fileUpload' => Url::to(['/pages/imperavi-file-upload'])
                    ]
                ]
            ) ?>

           </div>
        </div>
        
</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?php  if($model->isNewRecord) { ?>
		 
		<?php } else { 
		 echo Html::a('Cancel', ['/pages/view','id'=>$model->id], ['class'=>'btn btn-danger']); 
		}		?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
