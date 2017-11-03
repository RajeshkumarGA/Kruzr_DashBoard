
app1.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl : "views/login.html",
        controller: 'loginFormController'
    })
   
});

app.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl : "views/dashboard.html",
        controller: 'dashboardController'
    })
    .when("/chart", {
        templateUrl : "views/charts.html",
        controller: 'chartController'
    })
    .when("/tables", {
        templateUrl : "views/table.html"
    });
});