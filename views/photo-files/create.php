<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PhotoFiles */

$this->title = 'Create Photo Files';
$this->params['breadcrumbs'][] = ['label' => 'Photo Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-files-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
