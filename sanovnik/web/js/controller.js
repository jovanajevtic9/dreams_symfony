
var app = angular.module('myApp', []);

app.controller('myCtrl', function($scope,$http) {



    $scope.brLike = 0;


    $scope.lajkuj = function (){

        $scope.brLike++;
        $scope.isDisabled=true;

    }
});