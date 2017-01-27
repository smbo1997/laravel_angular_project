
app.config(function($routeProvider){
    $routeProvider
        .when("/mycarusel", {
            templateUrl : "/mycarusel",

        })
        .when("/bootstrapcarusel", {
            templateUrl : "/bootstrapcarusel"
        })
    .otherwise({redirectTo: '/mycarusel'});
});