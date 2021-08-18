<?php

namespace vova07\admin\controllers;

use vova07\admin\components\Controller;

/**
 * Backend default controller.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['error'],
            'roles' => ['@']
        ];

        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }

    /**
     * Backend main page.
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
	 public function actionDefect()
    {
        return $this->render('defect');
    }
	public function actionUnit()
    {
        return $this->render('unit');
    }
	public function actionBlock()
    {
        return $this->render('block');
    }
	public function actionPriority()
    {
        return $this->render('priority');
    }
}
