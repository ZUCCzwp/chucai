'use strict';
app.controller('serveDetail1Ctrl', ['$scope','$rootScope','$http','$stateParams','$localStorage','$sessionStorage','$state','toaster','$timeout','$location',function($scope,$rootScope,$http,$stateParams,$localStorage,$sessionStorage,$state,toaster,$timeout,$location) {
    //弹窗
    $scope.mPop={
        content:{
            type: 'success',
            title: '通知',
            text: 'Message',
            dataout:2000
        },
        launch:function () {
            toaster.pop($scope.mPop.content.type, $scope.mPop.content.title, $scope.mPop.content.text,$scope.mPop.content.dataout);
        },
        info:function (text) {
            $scope.mPop.content.type='success';
            $scope.mPop.content.text=text;
            $scope.mPop.launch();
        },
        err:function (text) {
            $scope.mPop.content.type='error';
            $scope.mPop.content.text=text;
            $scope.mPop.launch();
        }

    };
    $scope.id = $stateParams.id;
    $scope.item = [];
    $http.post('/order/order-api/index',{
        token:$sessionStorage.token,
        start_page:0,
        pages:100,
        type:1
    }).success(function (data) {
        var arr = data.data.list;
        angular.forEach(arr,function (val) {
            if(val.id == $scope.id){
                $scope.item = val;
            }
        });
    });

    //取消订单
    $scope.xQIsShow = false;
    $scope.showChangeXq = function (boo) {
        $scope.xQIsShow = boo;
    };
    $scope.orderDel = function () {
        $http.post('/order/order-api/delete',{
            token:$sessionStorage.token,
            id: $scope.id
        }).success(function () {
            $state.go("layout.mobile.serve.dfk");
        });
    };
}])
;