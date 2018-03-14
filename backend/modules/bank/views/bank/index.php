<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\bank\models\BankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Banks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class= "panel panel-default">
    <div class="panel-heading">
    <h2 class="panel-title"><?= Html::encode($this->title) ?></h2>
    </div>
    <div class="panel-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= Html::a('<i class="glyphicon glyphicon-plus"></i>'.Yii::t('app', 'Create Bank'), ['create'], [
        'class' => 'data-create btn btn-sm btn-success modal-slef',
        'data-toggle' => 'modal',
        'data-target' => '#create-modal',
        'data-url' => '/bank/bank/create',
        'data-title' => ''
    ]) ?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                'header'=>'编号'
            ],

//            'id',
//            'name',
            [
                'label' => '银行名称',
                'attribute' => 'name',
                'headerOptions' => ['width' => '300'],
            ],
//            'code',
            [
                'label' => '银行代码',
                'attribute' => 'code',
                'headerOptions' => ['width' => '200'],
            ],
//            'status',
//            'logo',
            [
                'label' => 'Logo',
                'attribute'=>'logo',
                'headerOptions' => ['width' => '300'],
                'value' => function ($model) {
                    return 'http://cc2.99caihong.net/uploads/banklogo'."$model->logo";
                },
                'format' => [
                    'image',
                    [
                        'width'=>'100',
                        'height'=>'50'
                    ]
                ],
            ],
            [
                'label' => '状态',
                'headerOptions' => ['width' => '150'],
                'value' =>  function ($model){
                    return $model->status == 1 ?'启用':'禁用';
                },
            ],
            // 'rgb',

            ['class' => 'yii\grid\ActionColumn',
                'header'=>'操作',
                'headerOptions' => ['width' => '250'],
                'template' => '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}&nbsp;&nbsp;',
                'buttons' => [

                    'view' => function ($url, $model, $key) {
                        return Html::a('查看',$url, [
                            'class' => 'data-view btn btn-primary btn-xs fa fa-eye',
                        ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('修改','#', [
                            'data-toggle' => 'modal',
                            'data-target' => '#update-modal',
                            'data-id' => $key,
                            'data-url' => $url,
                            'data-title' => '编辑',
                            'class' => 'data-update btn btn-warning btn-xs fa fa-wrench modal-slef',
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', $url,  [
                            'class' => 'btn btn-danger btn-xs fa fa-trash-o',
                            'data' => ['confirm' => '删除该条记录,是否继续操作？','method'=>'post']
                        ]);
                    },
                ],
            ],
        ],
            'filterSelector' => "select[name='".$dataProvider->getPagination()->pageSizeParam."'],input[name='".$dataProvider->getPagination()->pageParam."']",
            'pager' => [
                'class' => \common\widgets\LinkPager::className(),
                'options'=>['class' => 'pagination','style'=> "display:block;pull-right"],//关闭自带分页
                'template' => '{pageButtons} {customPage} {pageSize}', //分页栏布局
                'firstPageLabel'=>"首页",
                'prevPageLabel'=>'上一页',
                'nextPageLabel'=>'下一页',
                'lastPageLabel'=>'尾页',
                'pageSizeList' => [5, 10, 15,20], //页大小下拉框值
                'customPageWidth' => 60,            //自定义跳转文本框宽度
                'customPageBefore' => '  跳转到第 ',
                'customPageAfter' => ' 页 每页行数 ',
            ],
        ]); ?>
<?php Pjax::end(); ?></div>
</div>
<?php
Modal::begin([
    'options' => [
        'tabindex' => true
    ],
    'id' => 'create-modal',
    'header' => '<h4 class="modal-title" >操作</h4>',
    'footer' => '<a href="#" class="btn btn-default" data-dismiss="modal">关闭</a>',
]);

$js = <<<JS
        $(document).on('click', '.modal-slef', function () {
aUrl = $(this).attr('data-url');
aTitle = $(this).attr('data-title');
$($(this).attr('data-target')+" .modal-title").text(aTitle);
$.get(aUrl, {},
function (data) {
$('#create-modal').find('.modal-body').html(data);
}

);
});
JS;
$this->registerJs($js);
Modal::end();
Modal::begin([
    'options' => [
        'tabindex' => true
    ],
    'id' => 'update-modal',
    'header' => '<h4 class="modal-title" >操作</h4>',
    'footer' => '<a href="#" class="btn btn-default" data-dismiss="modal">关闭</a>',
]);

$js = <<<JS
$(document).on('click', '.modal-slef', function () {
    aUrl = $(this).attr('data-url');
    aTitle = $(this).attr('data-title');
    $($(this).attr('data-target')+" .modal-title").text(aTitle);
    $.get(aUrl, {},
        function (data) {
            $('#update-modal').find('.modal-body').html(data);
        }
    );
});
JS;
$this->registerJs($js);
Modal::end();

?>