app.controller('chartController',['$scope','$http',function($scope,$http)
{
	$scope.orderbyVariable= '';
	$scope.counterArray=[10,25,50,100,200,500];
	lineChartDataDetails = [];
	barChartDataDetails = [];
	pieChartDataDetails = [];

	// Slice model data tabel 
	$scope.perPageChange = function(getValue,getElement) 
	{
		switch (getElement) 
		{
			case 1:
				$scope.lineChartConcolatedData = [];
				$scope.lineChartConcolatedData = $scope.lineChartDataDetails.slice(0,getValue);
				break;
			case 2:
				$scope.barChartConcolatedData = [];
				$scope.barChartConcolatedData = $scope.barChartDataDetails.slice(0,getValue);
				break;
			case 3:
				$scope.pieChartConcolatedData = [];
				$scope.pieChartConcolatedData = $scope.pieChartDataDetails.slice(0,getValue);
				break;
			case 4:
				$scope.pieChartConcolatedModelData = [];
				$scope.pieChartConcolatedModelData = $scope.pieChartDataModelDetails.slice(0,getValue);
				break;
			case 5:
				$scope.retentionRateDataConcolatedData = [];
				$scope.retentionRateDataConcolatedData = $scope.retentionRateDataDetails.slice(0,getValue);
				break;
		}
	}

	// Sort Data in tables 
	$scope.filterVariable = '';
	$scope.reverse = false;
	$scope.sortBy = function(getElement)
	{
		switch(getElement)
		{
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

	$scope.day = [];
	$scope.lineChartData =[];
	$scope.month = [];
	$scope.barChartData = [];
	$scope.pieChartData=[];
	$scope.pieChartAgeGroupData=[];
	$scope.pieChartAgeGroupModelData=[];
	$scope.retentionData=[];
	
	$scope.j=0;
	for (var i=6;i>0;i--)
	{
	  $scope.day[$scope.j]= new Date(new Date().setDate(new Date().getDate()-i+1));
	  $scope.day[$scope.j]=$scope.day[$scope.j].getDate()+" "+ Month($scope.day[$scope.j].getMonth()+1);
	  $scope.j++;
	}

	$scope.CurrentDate = new Date();
	$scope.CurrentMonth = $scope.CurrentDate.getMonth()+1;
	for(var i=0;i<6;i++)
	{
  		$scope.month.push(Month($scope.CurrentMonth-i));
	}
	$scope.month=$scope.month.reverse();

	$http.get('linecharts.php').then(function(responce)
	{
		console.log(responce);
		if(responce.data.status == 200){
			for(var i=0;i<responce.data.data.length;i++){
		        $scope.lineChartData.push(responce.data.data[i].downloadsCountPerDay);
	      	}
	      	console.log($scope.lineChartData);
	      	renderLineChart();
		}
		else{

		}
	})

	$http.get('barcharts.php').then(function(responce)
	{
		console.log("bar chart");
		console.log(responce);
		if(responce.data.status == 200){
			for(var i=0;i<responce.data.data.length;i++){
		        $scope.barChartData.push(responce.data.data[i].downloadsCountPerMonth);
	      	}
	      	$scope.dataLength=$scope.barChartData.length-6;
	      	console.log($scope.dataLength);
	      	$scope.barChartData=$scope.barChartData.slice($scope.dataLength,$scope.length);
	      	renderBarChart();
	      
		}
		else{

		}
	})


	$http.get('getgenders.php').then(function(responce)
	{
		console.log(responce);
		if(responce.data.status == 200){
			$scope.pieChartData.push(responce.data.data[0].male);
	      	$scope.pieChartData.push(responce.data.data[0].female);
	      	$scope.pieChartData.push(responce.data.data[0].other);
	      	renderPieChart();
		}
		else{

		}
	})

	$http.get('ageGroups.php').then(function(responce){
		for(var i=0;i<responce.data.data.length;i++){
			if(responce.data.data[i].group==i){
			$scope.pieChartAgeGroupData.push(responce.data.data[i].count);
			$scope.pieChartAgeGroupModelData.push(responce.data.data[i].data);	
			}
		}
		// console.log("age group data");
		// console.log($scope.pieChartAgeGroupModelData[1]);
		renderAgeGroupPieChart();
		
	});

	$scope.retentionDataCount =[];
	$scope.retentiondays = [];
	$http.get('retentionRate.php').then(function(responce)
	{
		 // console.log("responce data is");
		 // console.log(responce.data.count);
		if(responce.data.status == 200){
			{
		        $scope.retentionDataCount.push(responce.data.count);
		        // $scope.retentionData.push(responce.data.data[0]);
	      	}
	      	//console.log($scope.retentionData[0].day1);
	      	$scope.retentiondays = $scope.retentionDataCount;
	      	console.log($scope.retentiondays);	
	      	renderBarChart1();
	      
		}
		else{

		}
	})
	
	function Month(getValue)
	{
	  switch(getValue)
	  {
	    case 1 :
	    return 'Jan';
	    break;
	    case 2 :
	    return 'Feb';
	    break;
	    case 3 :
	    return 'Mar';
	    break;
	    case 4 :
	    return 'Apr';
	    break;
	    case 5 :
	    return 'May';
	    break;
	    case 6 :
	    return 'Jun';
	    break;
	    case 7 :
	    return 'Jul';
	    break;
	    case 8 :
	    return 'Aug';
	    break;
	    case 9 :
	    return 'Sep';
	    break;
	    case 10 :
	    return 'Oct';
	    break;
	    case 11 :
	    return 'Nov';
	    break;
	    case 12 :
	    return 'Dec';
	    break;
	  }
	}

	function renderLineChart() 
	{
	   var data = {labels: $scope.day,
	        datasets: 
	        [{
	            label: 'downloads',
	            data: $scope.lineChartData,
	            backgroundColor:['#E4F1F0'],
	            borderColor:['#AEADC2'],
	            borderWidth:4
	        }]
        };

	    var canvas = document.getElementById("myAreaChart");
	    var ctx = canvas.getContext("2d");
	    var myNewChart = new Chart(ctx, 
	    {
		      type: 'line',
		      data: data,
		      gridLines:{display: false},
			  options: {legend:{display: false}}
	    });

	    $scope.addOnClick = function(evt) 
	    {
	    	  console.log($scope.value);
		      var activePoints = myNewChart.getElementsAtEvent(evt);
		      if (activePoints[0])
		       {
			        var chartData = activePoints[0]['_chart'].config.data;
			        var idx = activePoints[0]['_index'];
			        var label = chartData.labels[idx];
			        var value = chartData.datasets[0].data[idx];
			        $scope.value = idx;
			        console.log('linechartdetails.php?id='+$scope.value);

			        $http.get('linechartdetails.php?id='+$scope.value).then(function(responce)
			        {
			        	$scope.lineChartDataDetails = responce.data.data;
			        	$scope.lineChartConcolatedData = $scope.lineChartDataDetails.slice(0,10);
			        	console.log($scope.lineChartConcolatedData);

			        }) 
		      }
	    };
 	}
 	function renderBarChart() {
 		console.log($scope.barChartData);
	   var data = {labels: $scope.month,
	        datasets: [{
	            label: 'downloads',
	            data: $scope.barChartData,
	            backgroundColor: [
	                '#F7464A',
	                '#46BFBD',
	                '#FDB45C',
	                '#37464A',
	                '#46B3BD',
	                '#3DB45C'
	            ],
	            borderColor: [
	                'rgba(255,99,132,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)',
	                'rgba(255, 159, 64, 1)'
	            ],
	            borderWidth: 1,
	            
	        }],

        };

	    var canvas = document.getElementById("myBarChart");
	    var ctx = canvas.getContext("2d");
	    var myNewChart = new Chart(ctx, {
	      type: 'bar',
	      data: data,
	      gridLines: { display: false},
		  options: {legend:{display: false}}
	    });

	    $scope.addOnClickOnBar = function(evt) {
	      var activePoints = myNewChart.getElementsAtEvent(evt);
	      if (activePoints[0]) {
	        var chartData = activePoints[0]['_chart'].config.data;
	        var idx = activePoints[0]['_index'];

	        var label = chartData.labels[idx];
	        var value = chartData.datasets[0].data[idx];

	        var url = "http://example.com/?label=" + label + "&value=" + value;
	        //console.log(url);
	        
	        $scope.barvalue = idx;
	        $http.get('barchartdetails.php?id='+$scope.barvalue).then(function(responce){
	        	$scope.barChartDataDetails = responce.data.data;
	        	$scope.barChartConcolatedData = $scope.barChartDataDetails.slice(0,10);
	        	console.log($scope.barChartConcolatedData);
	        	console.log('barchartdetails.php?id='+$scope.barvalue);

	        })
	    	
	       
	      }
	    };
 	}

 	function renderBarChart1() {
 		
 		$scope.val = $scope.retentiondays[0];
 		// $scope.val = [10,20,30,40,50,60];
 		console.log($scope.val);
 		// console.log($scope.retentionData[0]);
	   var data = {labels:['firstday','secondday','thirdday','fourthday','fifthday','sixthday'],
		           datasets: [{
		           data:$scope.val ,
		           backgroundColor: ['#F7464A','#46BFBD','#FDB45C','#974444','#46B399','#FDB422'],
		           borderColor: ['rgba(255,99,132,1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)',
		                		  'rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)','rgba(255, 159, 64, 1)'
		            			 ],
		           borderWidth: 1    
	        }],
        };

	    var canvas = document.getElementById("myBarChart1");
	    var ctx = canvas.getContext("2d");
	    var myNewChart = new Chart(ctx, {
										      type: 'bar',
										      data: data,
										      gridLines: {display: false},
											  options: {legend:{display: false}}
	   							   });

	    $scope.addOnClickOnBar1 = function(evt) {
	    	// console.log($scope.value);
		      var activePoints = myNewChart.getElementsAtEvent(evt);
		      if (activePoints[0]) {
			        var chartData = activePoints[0]['_chart'].config.data;
			        var idx = activePoints[0]['_index'];
			        $scope.barvalue = idx;
  
			       
			        $scope.pievalue = idx;
		        	$http.get('retentionRateData.php?id='+$scope.pievalue).then(function(responce){
		            $scope.retentionRateDataDetails = responce.data.data;
		            $scope.retentionRateDataConcolatedData = $scope.retentionRateDataDetails.slice(0,10);
		        	console.log( $scope.retentionRateDataConcolatedData);
		        	console.log(responce.data);
		        	// console.log('piechartdetails.php?id='+$scope.barvalue);

	        })
		       
		      }
	    };
 	}

 	function renderPieChart() {
	    var data = {datasets: [{data: $scope.pieChartData,
	                backgroundColor: ["#F7464A","#46BFBD","#FDB45C"]}],
	                labels: ["Male","Female","Undefined"]
	               };

	    var canvas = document.getElementById("myPieChart");
	    var ctx = canvas.getContext("2d");
	    var myNewChart = new Chart(ctx, {
	      type: 'pie',
	      data: data
	    });

	    $scope.addOnClickOnPie = function(evt) {
	      var activePoints = myNewChart.getElementsAtEvent(evt);
	      if (activePoints[0]) {
	        var chartData = activePoints[0]['_chart'].config.data;
	        var idx = activePoints[0]['_index'];

	        var label = chartData.labels[idx];
	        var value = chartData.datasets[0].data[idx];

	        var url = "http://example.com/?label=" + label + "&value=" + value;
	        //console.log(url);
	       // console.log("hello");
	        $scope.pievalue = idx;
	        $http.get('piechartdetails.php?id='+$scope.pievalue).then(function(responce){
	        	$scope.pieChartDataDetails = responce.data.data;
	        	$scope.pieChartConcolatedData = $scope.pieChartDataDetails.slice(0,10);
	        	console.log($scope.pieChartConcolatedData);
	        	console.log('piechartdetails.php?id='+$scope.barvalue);

	        })
	       
	      }
	    };
	 }

	function renderAgeGroupPieChart() {
	    var data = {datasets: [{data: $scope.pieChartAgeGroupData,
	                backgroundColor: ["#F7464A","#46BFBD","#FDB444","#F77717","#46BF1F","#FDD111"]}],
	                labels: ["16-24","25-34","35-44","45-54","55-64","65+","Undefined"]
	               };

	    var canvas = document.getElementById("agePieChart");
	    var ctx = canvas.getContext("2d");
	    var myNewChart1 = new Chart(ctx, {
	      type: 'doughnut',
	      data: data
	    });

	    $scope.addOnClickOnPie1 = function(evt) {
	      var activePoints = myNewChart1.getElementsAtEvent(evt);
	      if (activePoints[0]) {
	        var chartData = activePoints[0]['_chart'].config.data;
	        var idx = activePoints[0]['_index'];

	        var label = chartData.labels[idx];
	        var value = chartData.datasets[0].data[idx];

	        var url = "http://example.com/?label=" + label + "&value=" + value;
	        //console.log(url);
	        
	        $scope.pievalue = idx;
	        // console.log($scope.pieChartAgeGroupModelData[idx]);
	        $scope.pieChartDataModelDetails = $scope.pieChartAgeGroupModelData[idx];
	       	$scope.pieChartConcolatedModelData = $scope.pieChartDataModelDetails.slice(0,10);
	       	// console.log($scope.pieChartConcolatedModelData);
	        // 	console.log($scope.pieChartConcolatedData);
	        // 	console.log('piechartdetails.php?id='+$scope.barvalue);

	        // })
	       
	      }
	    };
	 }


}]);

app.directive('exportToCsvDayUsers',function(){
	  	return {
	    	restrict: 'A',
	    	link: function (scope, element, attrs) {
	    		var el = element[0];
		        element.bind('click', function(e){
		        	var table = document.getElementById('daydataTable');
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
			            download:'daydataTotalDownloads.csv'
			        }).appendTo('body')
			        a[0].click()
			        a.remove();
		        });
	    	}
	  	}
	});
app.directive('exportToCsvMonthUsers',function(){
	  	return {
	    	restrict: 'A',
	    	link: function (scope, element, attrs) {
	    		var el = element[0];
		        element.bind('click', function(e){
		        	var table = document.getElementById('monthdataTable');
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
			            download:'monthdataTotalDownloads.csv'
			        }).appendTo('body')
			        a[0].click()
			        a.remove();
		        });
	    	}
	  	}
	});
app.directive('exportToCsvGenderUsers',function(){
	  	return {
	    	restrict: 'A',
	    	link: function (scope, element, attrs) {
	    		var el = element[0];
		        element.bind('click', function(e){
		        	var table = document.getElementById('genderdataTable');
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
			            download:'genderdataTotalDownloads.csv'
			        }).appendTo('body')
			        a[0].click()
			        a.remove();
		        });
	    	}
	  	}
	});