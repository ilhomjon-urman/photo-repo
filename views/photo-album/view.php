<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\PhotoFiles;


/* @var $this yii\web\View */
/* @var $model app\models\PhotoAlbum */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Photo Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="photo-album-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

    <div class="col-xs-12 col-md-12">
        <?php
            if (!$model->isNewRecord) {
                echo Html::a('<i class="fa fa-upload"> Add Photo</i>', ['upload', 'id' => $model->id], ['class' => 'btn btn-info']);
            }

            echo "<br><br>"; 

            $photoFiles = PhotoFiles::find()
                ->where(['album_id' => $model->id])
                ->limit(5)
                ->all();
            if ( !empty($photoFiles) ){
                foreach ($photoFiles as $file) {
                    echo "<div style='margin:10px;' class='float-right'><a href='/uploads/" . $file->changed_name . "' class='btn btn-info' target='_blank'><img width=50px src='/uploads/$file->changed_name' alt='$file->original_name'></a><a href='/photo-album/delete-file?id=" . $file->id . "' class='btn btn-danger' target='_blank'>X</a></div>";
                }
            }

        ?>
    </div>

</div>
