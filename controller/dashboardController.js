app.controller('dashboardController',['$scope','$http',function($scope,$http){
	$scope.loadingImg = false;
	$scope.dailyDownloadsCount = 20;
	$scope.totalDownloadsCount = 3000;
	$scope.activeUsersCount = 300;
	$scope.counterArray=[10,25,50,100,200,500,1000,2000,3000,4000];
	$scope.perPageChange = function(getValue,getElement) {
		switch (getElement) {
			case 1:
			$scope.dailyDownloadsConcolatedData = [];
			$scope.dailyDownloadsConcolatedData = $scope.dailyDownloadsData.slice(0,getValue);
			break;
			case 2:
			$scope.totalDownloadsConcolatedData = [];
			$scope.totalDownloadsConcolatedData = $scope.totalDownloadsData.slice(0,getValue);
			break;
			case 3:
			$scope.activeUsersConcolatedData = [];
			$scope.activeUsersConcolatedData = $scope.activeUsersData.slice(0,getValue);
			break;
			case 4:
			$scope.weeklyActiveUsersConcolatedData = [];
			$scope.weeklyActiveUsersConcolatedData = $scope.weeklyActiveUsersData.slice(0,getValue);
			break;
			case 5:
			$scope.monthlyActiveUsersConcolatedData = [];
			$scope.monthlyActiveUsersConcolatedData = $scope.monthlyActiveUsersData.slice(0,getValue);
			break;
			case 6:
			$scope.dailyActiveUsersConcolatedData = [];
			$scope.dailyActiveUsersConcolatedData = $scope.dailyActiveUsersData.slice(0,getValue);
			break;
		}
	}
	$http.get('dailydownloads.php').then(function(responce){
		if(responce.data.status == 200){
			$scope.dailyDownloadsCount = responce.data.count;
			$scope.dailyDownloadsData = responce.data.data;
			$scope.dailyDownloadsConcolatedData = $scope.dailyDownloadsData.slice(0,10);
			// console.log($scope.dailyDownloadsData);
		}
		else{
			console.log(responce.data.msg);
		}
	});
	$http.get('totaldownloads.php').then(function(responce){
		if(responce.data.status == 200){
			$scope.totalDownloadsCount = responce.data.count;
			$scope.totalDownloadsData = responce.data.data;
			$scope.totalDownloadsConcolatedData = $scope.totalDownloadsData.slice(0,10);
			// console.log($scope.totalDownloadsData);
		}
		else{
			console.log(responce.data.msg);
		}
	});
	$http.get('activeusers.php').then(function(responce){
		if(responce.data.status == 200){
			$scope.activeUsersCount = responce.data.count;
			$scope.activeUsersData = responce.data.data;
			$scope.activeUsersConcolatedData = $scope.activeUsersData.slice(0,10);
			// console.log($scope.activeUsersData);
		}
		else{
			console.log(responce.data.msg);
		}
	});
	$http.get('WAU.php').then(function(responce){
		if(responce.data.status == 200){
			$scope.weeklyActiveUsersCount = responce.data.count;
			$scope.weeklyActiveUsersData = responce.data.data;
		    $scope.weeklyActiveUsersConcolatedData = $scope.weeklyActiveUsersData.slice(0,10);
		 //    console.log("this is weekly");
			// console.log($scope.weeklyActiveUsersData);
		}
		else{
			console.log(responce.data.msg);
		}
	});
	$http.get('MAU.php').then(function(responce){
		if(responce.data.status == 200){
			$scope.monthlyActiveUsersCount = responce.data.count;
			$scope.monthlyActiveUsersData = responce.data.data;
		    $scope.monthlyActiveUsersConcolatedData = $scope.monthlyActiveUsersData.slice(0,10);
		 //    console.log("this is monthly");
			// console.log($scope.monthlyActiveUsersConcolatedData);
		}
		else{
			console.log(responce.data.msg);
		}
	});
	$http.get('DAU.php').then(function(responce){
		if(responce.data.status == 200){
			$scope.dailyActiveUsersCount = responce.data.count;
			$scope.dailyActiveUsersData = responce.data.data;
		    $scope.dailyActiveUsersConcolatedData = $scope.dailyActiveUsersData.slice(0,10);
		    console.log("this is daily");
			console.log($scope.dailyActiveUsersConcolatedData);
		}
		else{
			console.log(responce.data.msg);
		}
	});

	$scope.filterVariable = '';
	$scope.reverse = false;
	$scope.sortBy = function(getElement){
		switch(getElement){
			case 1 :
			$scope.filterVariable = 'userName';
			if($scope.reverse) $scope.reverse = false;
			else $scope.reverse = true;
			break;
			case 2 :
			$scope.filterVariable = 'userEmail';
			if($scope.reverse) $scope.reverse = false;
			else $scope.reverse = true;
			break;
			case 3 :
			$scope.filterVariable = 'userPhone';
			if($scope.reverse) $scope.reverse = false;
			else $scope.reverse = true;
			break;
			case 4 :
			$scope.filterVariable = 'userGender';
			if($scope.reverse) $scope.reverse = false;
			else $scope.reverse = true;
			break;
			case 5 :
			$scope.filterVariable = 'userCreatedDate';
			if($scope.reverse) $scope.reverse = false;
			else $scope.reverse = true;
			break;
		}
	}
	

}]);

// Active Users Csv
app.directive('exportToCsvActiveUsers',function(){
	  	return {
	    	restrict: 'A',
	    	link: function (scope, element, attrs) {
	    		var el = element[0];
		        element.bind('click', function(e){
		        	var table = document.getElementById('dataTableActiveUsers');
		        	var csvString = '';
		        	for(var i=0; i<table.rows.length;i++){
		        		var rowData = table.rows[i].cells;
		        		for(var j=0; j<rowData.length;j++){
		        			csvString = csvString + rowData[j].innerHTML + ",";
		        		}
		        		csvString = csvString.substring(0,csvString.length - 1);
		        		csvString = csvString + "\n";
				    }
		         	csvString = csvString.substring(0, csvString.length - 1);
		         	var a = $('<a/>', {
			            style:'display:none',
			            href:'data:application/octet-stream;base64,'+btoa(unescape(encodeURIComponent(csvString))),
			            download:'dataTableActiveUsers.csv'
			        }).appendTo('body')
			        a[0].click()
			        a.remove();
		        });
	    	}
	  	}
	});

// Total Downlodes csv
app.directive('exportToCsvTotalDownloads',function(){
	  	return {
	    	restrict: 'A',
	    	link: function (scope, element, attrs) {
	    		var el = element[0];
		        element.bind('click', function(e){
		        	var table = document.getElementById('dataTableTotalUsers');
		        	var csvString = '';
		        	for(var i=0; i<table.rows.length;i++){
		        		var rowData = table.rows[i].cells;
		        		for(var j=0; j<rowData.length;j++){
		        			csvString = csvString + rowData[j].innerHTML + ",";
		        		}
		        		csvString = csvString.substring(0,csvString.length - 1);
		        		csvString = csvString + "\n";
				    }
		         	csvString = csvString.substring(0, csvString.length - 1);
		         	var a = $('<a/>', {
			            style:'display:none',
			            href:'data:application/octet-stream;base64,'+btoa(unescape(encodeURIComponent(csvString))),
			            download:'dataTotalDownloads.csv'
			        }).appendTo('body')
			        a[0].click()
			        a.remove();
		        });
	    	}
	  	}
	});

// Daily active users csv downlode
app.directive('exportToCsvDailyActiveUsers',function(){
	  	return {
	    	restrict: 'A',
	    	link: function (scope, element, attrs) {
	    		var el = element[0];
		        element.bind('click', function(e){
		        	var table = document.getElementById('dataTableDailyActiveUsers');
		        	var csvString = '';
		        	for(var i=0; i<table.rows.length;i++){
		        		var rowData = table.rows[i].cells;
		        		for(var j=0; j<rowData.length;j++){
		        			csvString = csvString + rowData[j].innerHTML + ",";
		        		}
		        		csvString = csvString.substring(0,csvString.length - 1);
		        		csvString = csvString + "\n";
				    }
		         	csvString = csvString.substring(0, csvString.length - 1);
		         	var a = $('<a/>', {
			            style:'display:none',
			            href:'data:application/octet-stream;base64,'+btoa(unescape(encodeURIComponent(csvString))),
			            download:'dataTableDailyActiveUsers.csv'
			        }).appendTo('body')
			        a[0].click()
			        a.remove();
		        });
	    	}
	  	}
	});

// Weekly active users csv downlode
app.directive('exportToCsvWeeklyActiveUsers',function(){
	  	return {
	    	restrict: 'A',
	    	link: function (scope, element, attrs) {
	    		var el = element[0];
		        element.bind('click', function(e){
		        	var table = document.getElementById('dataTableWeeklyActiveUsers');
		        	var csvString = '';
		        	for(var i=0; i<table.rows.length;i++){
		        		var rowData = table.rows[i].cells;
		        		for(var j=0; j<rowData.length;j++){
		        			csvString = csvString + rowData[j].innerHTML + ",";
		        		}
		        		csvString = csvString.substring(0,csvString.length - 1);
		        		csvString = csvString + "\n";
				    }
		         	csvString = csvString.substring(0, csvString.length - 1);
		         	var a = $('<a/>', {
			            style:'display:none',
			            href:'data:application/octet-stream;base64,'+btoa(unescape(encodeURIComponent(csvString))),
			            download:'dataTableWeeklyActiveUsers.csv'
			        }).appendTo('body')
			        a[0].click()
			        a.remove();
		        });
	    	}
	  	}
	});

// Monthly active users csv downlode
app.directive('exportToCsvMonthlyActiveUsers',function(){
	  	return {
	    	restrict: 'A',
	    	link: function (scope, element, attrs) {
	    		var el = element[0];
		        element.bind('click', function(e){
		        	var table = document.getElementById('dataTableMonthlyActiveUsers');
		        	var csvString = '';
		        	for(var i=0; i<table.rows.length;i++){
		        		var rowData = table.rows[i].cells;
		        		for(var j=0; j<rowData.length;j++){
		        			csvString = csvString + rowData[j].innerHTML + ",";
		        		}
		        		csvString = csvString.substring(0,csvString.length - 1);
		        		csvString = csvString + "\n";
				    }
		         	csvString = csvString.substring(0, csvString.length - 1);
		         	var a = $('<a/>', {
			            style:'display:none',
			            href:'data:application/octet-stream;base64,'+btoa(unescape(encodeURIComponent(csvString))),
			            download:'dataTableMonthlyActiveUsers.csv'
			        }).appendTo('body')
			        a[0].click()
			        a.remove();
		        });
	    	}
	  	}
	});

//Retention rate csv downlode
app.directive('exportToCsvRetentionRate',function(){
	  	return {
	    	restrict: 'A',
	    	link: function (scope, element, attrs) {
	    		var el = element[0];
		        element.bind('click', function(e){
		        	var table = document.getElementById('dataTableRetentionRate');
		        	var csvString = '';
		        	for(var i=0; i<table.rows.length;i++){
		        		var rowData = table.rows[i].cells;
		        		for(var j=0; j<rowData.length;j++){
		        			csvString = csvString + rowData[j].innerHTML + ",";
		        		}
		        		csvString = csvString.substring(0,csvString.length - 1);
		        		csvString = csvString + "\n";
				    }
		         	csvString = csvString.substring(0, csvString.length - 1);
		         	var a = $('<a/>', {
			            style:'display:none',
			            href:'data:application/octet-stream;base64,'+btoa(unescape(encodeURIComponent(csvString))),
			            download:'dataTableRetentionRate.csv'
			        }).appendTo('body')
			        a[0].click()
			        a.remove();
		        });
	    	}
	  	}
	});

//Age Group csv downlode
app.directive('exportToCsvAgeGroup',function(){
	  	return {
	    	restrict: 'A',
	    	link: function (scope, element, attrs) {
	    		var el = element[0];
		        element.bind('click', function(e){
		        	var table = document.getElementById('dataTableAgeGroup');
		        	var csvString = '';
		        	for(var i=0; i<table.rows.length;i++){
		        		var rowData = table.rows[i].cells;
		        		for(var j=0; j<rowData.length;j++){
		        			csvString = csvString + rowData[j].innerHTML + ",";
		        		}
		        		csvString = csvString.substring(0,csvString.length - 1);
		        		csvString = csvString + "\n";
				    }
		         	csvString = csvString.substring(0, csvString.length - 1);
		         	var a = $('<a/>', {
			            style:'display:none',
			            href:'data:application/octet-stream;base64,'+btoa(unescape(encodeURIComponent(csvString))),
			            download:'dataTableAgeGroup.csv'
			        }).appendTo('body')
			        a[0].click()
			        a.remove();
		        });
	    	}
	  	}
	});

