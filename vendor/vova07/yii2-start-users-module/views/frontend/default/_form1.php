<?php

/**
 * User form view.
 *
 * @var \yii\web\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \vova07\users\models\backend\User $model Model
 * @var \vova07\users\models\Profile $profile Profile
 * @var array $roleArray Roles array
 * @var array $statusArray Statuses array
 * @var \vova07\themes\admin\widgets\Box $box Box widget instance
 */

use vova07\fileapi\Widget;
use vova07\users\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\UsersUnit;
use yii\helpers\ArrayHelper;

?>
<?php $form = ActiveForm::begin(); ?>
<?php $box->beginBody(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($profile, 'name') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($profile, 'surname') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($user, 'username') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($user, 'email') ?>
        </div>
    </div>
    <div class="row">
       <div class="col-sm-6">
            <?= $form->field($user, 'user_unit')->dropDownList(ArrayHelper::map(UsersUnit::find()->all(),'id','unit_name'),  ['prompt'=>'Select from list', 'onchange'=>'setValue();']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($user, 'block_no')->textInput(array('readonly' => true)) ?>
        </div>
    </div>
     <div class="row">
       <div class="col-sm-6">
            <?= $form->field($user, 'company')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($user, 'vehicle_no')->textInput() ?>
        </div>

    </div>

      <div class="row">
        <div class="col-sm-6">
            <?= $form->field($user, 'contact_no')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($user, 'handphone_no')->textInput() ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($user, 'office_no')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($user, 'fax')->textInput() ?>
        </div>
    </div>

    <div class="row">
                        <div class="col-sm-6">
            <?= $form->field($profile, 'avatar_url')->widget(Widget::className(),
                [
                    'settings' => [
                        'url' => ['fileapi-upload']
                    ],
                    'crop' => true,
                    'cropResizeWidth' => 100,
                    'cropResizeHeight' => 100
                ]
            ) ?>
            <?php if($profile->avatar_url){ ?>
           <?php //= Html::img('../statics/web/users/avatars/'.$profile->avatar_url);?> 
            <img src="statics/web/users/avatars/<?php echo $profile->avatar_url; ?>"  />
            <?php }?>
        </div>
    </div>
    
    <h3 class="box-title">Account Settings</h3>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($profile, 'no_adults')->textInput(['placeholder' => 'Adult - Age more than 12']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($profile, 'no_child')->textInput(['placeholder' => 'Children - Age less than or equal to 12']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($profile, 'no_residentcard')->textInput(['placeholder' => 'Seperate the numbers with a comma']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($profile, 'no_accesscard')->textInput(['placeholder' => 'Seperate the numbers with a comma']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($profile, 'car_rgno1')->textInput(['placeholder' => 'Seperate Regn and IU # with a comma']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($profile, 'car_rgno2')->textInput(['placeholder' => 'Seperate Regn and IU # with a comma']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($profile, 'car_rgno3')->textInput(['placeholder' => 'Seperate Regn and IU # with a comma']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($profile, 'car_rgno4')->textInput(['placeholder' => 'Seperate Regn and IU # with a comma']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($profile, 'dog_pets') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($profile, 'cat_pets') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($profile, 'any_pets')->textInput(['placeholder' => 'Eg:- Hamster -3, Rabbit -2 etc.']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($profile, 'no_bicycle') ?>
        </div>
    </div>

<?php $box->endBody(); ?>
<?php $box->beginFooter(); ?>
<?= Html::submitButton(
    $user->isNewRecord ? Module::t('users', 'BACKEND_CREATE_SUBMIT') : Module::t('users', 'BACKEND_UPDATE_SUBMIT'),
    [
        'class' => $user->isNewRecord ? 'btn btn-primary btn-large' : 'btn btn-success btn-large'
    ]
) ?>
<?php $box->endFooter(); ?>
<?php ActiveForm::end(); ?>

<script>

	function setValue() {

		$.ajax({

			   url: '<?php echo Yii::$app->request->baseUrl. '/index.php?r=users/default/query' ?>',

			   type: 'get',

			   data: {id: $("#user-user_unit").val()},
			   			   
			   success: function (data) {

				  	console.log(data.block_no);

					document.getElementById("user-block_no").value = data.unit_block;

			   }

		  });
	}

</script>