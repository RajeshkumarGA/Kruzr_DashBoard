app.controller('tableCreateController',['$scope','$http',function($scope,$http){
	$scope.loadingImg = true;
	$scope.counterArray=[10,25,50,100,200,500];
	$scope.perPageChange = function(getValue) {
		$scope.Data = [];
		$scope.Data= $scope.data.slice(0,getValue);
		
	}
	$scope.showTables = function(getUrl){
		$scope.dataRows = [];
		$scope.dataHeaders = [];
		$scope.dataColumns = [];
		$scope.data = [];
		$scope.Data = [];
		$scope.eachColumn = [];
		$http.get(getUrl).then(function(responce){
			$scope.readData = responce.data;  									//gets in string
					$scope.dataRows = $scope.readData.split(/\n/); 						// split in array
					for(var i=1;i<$scope.dataRows.length;i++){
						$scope.dataColumns[i] = $scope.dataRows[i].split(',');
						$scope.dataObject ={
							'name' : $scope.dataColumns[i][1],
							'email': $scope.dataColumns[i][3],
							'phone': $scope.dataColumns[i][12],
							'gender': $scope.dataColumns[i][8],
							'loginmode': $scope.dataColumns[i][10],
							'createddate': $scope.dataColumns[i][17]
						}
						$scope.data.push($scope.dataObject);
					}
					$scope.Data = $scope.data.slice(0,10);
		});
	}
	$scope.filterVariable = '';
	$scope.reverse = false;
	$scope.sortBy = function(getElement){
		switch(getElement){
			case 1 :
			$scope.filterVariable = 'name';
			if($scope.reverse) $scope.reverse = false;
			else $scope.reverse = true;
			break; 
			case 2 :
			$scope.filterVariable = 'email';
			if($scope.reverse) $scope.reverse = false;
			else $scope.reverse = true;
			break; 
			case 3 :
			$scope.filterVariable = 'phone';
			if($scope.reverse) $scope.reverse = false;
			else $scope.reverse = true;
			break; 
			case 4 :
			$scope.filterVariable = 'gender';
			if($scope.reverse) $scope.reverse = false;
			else $scope.reverse = true;
			break; 
			case 5 :
			$scope.filterVariable = 'loginmode';
			if($scope.reverse) $scope.reverse = false;
			else $scope.reverse = true;
			break; 
			case 6 :
			$scope.filterVariable = 'createddate';
			if($scope.reverse) $scope.reverse = false;
			else $scope.reverse = true;
			break; 
		}
	}

}]);