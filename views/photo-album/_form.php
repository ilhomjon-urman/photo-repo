<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PhotoAlbum */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photo-album-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">

        <div class="col-xs-12 col-md-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
