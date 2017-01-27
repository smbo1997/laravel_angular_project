var app = angular.module("myApp", ["ngRoute","ui.bootstrap","ngFileUpload"],function($interpolateProvider){
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});
