<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\PhotoFiles;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PhotoAlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Photo Albums';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-album-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Photo Album', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            
            [
                'attribute'=>'name',
                'value'=>function($m){
                    $photoFiles = PhotoFiles::find()
                        ->where(['album_id' => $m->id])
                        ->limit(5)
                        ->all();
                    $n=1;
                    $table ="";
                    if ( !empty($photoFiles) ){
                        $table = "<table><tr><th>#</th><th>File Name</th></tr>";
                        foreach ($photoFiles as $file) {
                            $table .= "<tr><td>".$n++."</td><td><a href='/uploads/" . $file->changed_name . "' class='btn btn-info' target='_blank'><img width=50px src='/uploads/$file->changed_name' alt='$file->original_name'></a><a href='/photo-album/delete-file?id=" . $file->id . "' class='btn btn-danger' target='_blank'>X</a></td></tr>";
                        }
                        $table .= "</table>";
                        return $table;
                    } else {
                        return "No Photo Uloaded";
                    }
                },
                'format'=>'raw',
                "label"=>"Photo Files"

            ],

            ['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
