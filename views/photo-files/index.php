<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PhotoFilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Photo Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-files-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Photo Files', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'album_id',
            'album.name:text:Photo Album Name',
            'original_name',
            'changed_name',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
