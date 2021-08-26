<?php
use app\easyii\helpers\Image;
use app\easyii\modules\gallery\api\Gallery;
use app\easyii\modules\page\api\Page;
use yii\helpers\Html;
use yii\helpers\Url;

$page = Page::get('page-gallery');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>
<h1><?= $page->seo('h1', $page->title) ?></h1>
<br/>

<?php foreach(Gallery::cats() as $album) : ?>
    <a class="center-block" href="<?= Url::to(['gallery/view', 'slug' => $album->slug]) ?>">
        <?= Html::img(Image::thumb($album->image, 160, 120)) ?>
        <br><br>
        <?= $album->title ?>
    </a>
    <br/>
<?php endforeach; ?>