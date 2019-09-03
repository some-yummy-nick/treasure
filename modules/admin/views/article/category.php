<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
    <?= Html::dropDownList('category', $selectedCategory,$categories,['class'=>'form-control']) ?>

    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
