
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<div ng-controller="mycaruselCtrl" style=" margin-left: 500px;">
    <span class="glyphicon glyphicon-chevron-left" ng-click="prev()"></span>
    <img ng-src="<%image%>" width="400px">
    <span class="glyphicon glyphicon-chevron-right" ng-click="next()"></span>
</div>