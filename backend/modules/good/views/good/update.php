<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\good\models\Good */

$this->title = Yii::t('app', 'Update Good:', [
    'modelClass' => 'Good',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Goods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="good-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
