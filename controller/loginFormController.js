app1.controller('loginFormController', ['$scope','$window','$http',function($scope,$window,$http){
	$scope.login = function(){
		$http({
			url: 'admin.php',
	        method: "POST",
	        data: { 'userName' : $scope.loginUserName,'password':$scope.loginPassword }
	    }).then(function(responce){
			if(responce.data.status==200){
				$window.location.href='admin.html';
			}
			else{
				//alert($scope.loginUserName);
				alert(responce.data.msg);
			}
		});
	}
}]);