<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel wechat\modules\wechat\models\WechatSendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Wechat Sends');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wechat-send-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Wechat Send'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'url:url',
            'template_id',
            'first_value',
            // 'first_color',
            // 'keyword1_value',
            // 'keyword1_color',
            // 'keyword2_value',
            // 'keyword2_color',
            // 'keyword3_value',
            // 'keyword3_color',
            // 'keyword4_value',
            // 'keyword4_color',
            // 'keyword5_value',
            // 'keyword5_color',
            // 'keyword6_value',
            // 'keyword6_color',
            // 'remark_value',
            // 'remark_color',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
