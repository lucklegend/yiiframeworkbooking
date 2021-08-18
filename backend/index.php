 <?php
 
ob_start(); 
//defined('YII_DEBUG') or define('YII_DEBUG', false);
//defined('YII_ENV') or define('YII_ENV', 'prod');


defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');


require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../common/config/aliases.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../common/config/main.php'),
    require(__DIR__ . '/../common/config/main-local.php'),
    require(__DIR__ . '/config/main.php'),
    require(__DIR__ . '/config/main-local.php')
);

$application = new yii\web\Application($config);

$connection = Yii::$app->getDb();
$command = $connection->createCommand("set sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';");
$command->execute();

$application->run();

//$user = Yii::$app->getUser()->identity->attributes;

//if(is_null($user)){
//	header('Location: ../index.php');
//	exit;	
//}
//var_dump($user);
//echo $user->_user;
//var_dump($action);
//echo $action = Yii::$app->controller->action->id;
//echo Yii::$app->controller->id;
//
