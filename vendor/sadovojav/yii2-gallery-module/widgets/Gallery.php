<?php

namespace sadovojav\gallery\widgets;

use Yii;
use yii\caching\DbDependency;
use yii\helpers\Html;
use sadovojav\gallery\models\Gallery as BaseGallery;
use yii\helpers\Url;
/**
 * Class Gallery
 * @package sadovojav\gallery\widgets
 */
class Gallery extends \yii\base\Widget
{
    /**
     * @var
     */
    public $galleryId;

    /**
     * @var bool
     */
    public $caption = false;

    /**
     * @var
     */
    public $template = null;

    public function run()
    {
        $dependency = new DbDependency();
        $dependency->sql = 'SELECT MAX(updated) FROM {{%gallery}}';

        $model = BaseGallery::getDb()->cache(function () {
            return BaseGallery::find()
                ->where('id = :id', [
                    ':id' => $this->galleryId
                ])
                ->active()
                ->one();
        }, Yii::$app->getModule('gallery')->queryCacheDuration, $dependency);

        if (is_null($model) || !count($model->files)) {
            return false;
        }

        if (!is_null($this->template)) {
            return $this->render($this->template, [
                'model' => $model,
                'models' => $model->files
            ]);
        } else {
            return $this->getDefaultGallery($model);
        }
    }

    /**
     * Get default gallery style image/caption
     * @param $model
     * @return string
     */
    private function getDefaultGallery($model)
    {
        $html = Html::beginTag('div', [
            'class' => 'content-gallery default gallery-' . $model->id,
        ]);

        foreach ($model->files as $value) {
            $html .= Html::beginTag('div', [
            'class' => 'col-sm-4 col-md-2 col-xs-6',
			'style' => 'margin-bottom:10px'
        ]);
		/*$html .= Html::beginTag('div', [
            'class' => 'thumbnail',
        ]);*/
		$html .= Html::beginTag('a', [
            'data-toggle' => 'lightbox',
			'id' => 'pop',
			'class' => 'lightbox',
			'data-gallery' => 'multiimages',
			'href' => Url::to(BACKEND. $value->src),
        ]);
            $html .= Html::img(Url::to(BACKEND .$value->src), [
                'alt' => $this->caption ? $value->caption : null,
                'class' => 'img-responsive img-thumbnail',
				'width' => 150,
				'height' => 112
            ]);

            if ($this->caption) {
                $html .= Html::tag('div', $value->caption, [
                    'class' => 'caption'
                ]);
            }
              $html .= Html::endTag('a');
           // $html .= Html::endTag('div');
			$html .= Html::endTag('div');
        }

        $html .= Html::endTag('div');

        return $html;
    }
}