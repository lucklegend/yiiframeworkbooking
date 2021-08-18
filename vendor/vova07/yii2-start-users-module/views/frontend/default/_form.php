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
            <?= $form->field($user, 'email') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($user, 'contact_no')->textInput() ?>
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