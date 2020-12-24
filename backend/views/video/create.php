<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Video */

$this->title = 'Create Video';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="d-flex flex-column align-items-center">
        <div class="upload-icon">
            <i class="fas fa-upload"></i>
        </div>
        <div class="p-4 text-center">
            <p class="m-0">Select File to Upload</p>
            <p class="text-muted"> Your videos will be private until you publish them.</p>
        </div>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
        <?= $form->errorSummary($model)?>
        <button class="btn btn-primary upload-button">
            Select File
            <input type="file" name="video" id="videoFile">
        </button>
        <?php ActiveForm::end()?>
    </div>

</div>
