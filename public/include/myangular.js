
var app = angular.module('myApp', ['ngSanitize','angularUtils.directives.dirPagination']);

app.controller('myCtrl', function($scope, $http) {
      $http.get(base_url+"quick_search/feach")
    .then(function (response) {
  
    $scope.json = response.data;
    });

       // $scope.firstname='fdsafdsa';
       // $scope.lasttname='fdsafdsa';
    $scope.insert=function(){
    
        console.log($scope.firstname);
        console.log($scope.lastname);
        
         $http({
        method : "POST",
        url : base_url+"quick_search/message",
         data: { "firstname": $scope.firstname, "lastname": $scope.lastname,"id":$scope.id },
           headers: {'Content-Type': 'application/json'}
    }).then(function mySucces(response) {
        $scope.myWelcome = response.data;
        if(response.data.success===true)
        {
              console.log(10);
              $scope.myWelcome=response.data.data;
        }else{
              $scope.myWelcome=response.data.data;
        }
          
        console.log(1);
    }, function myError(response) {
        $scope.myWelcome = response.statusText;
    console.log(0);
    });

};// END SCOPE INSERT.

// BEGIN SCOPE DELETE.

$scope.delete=function(id){
    console.log('delete fire:'+id);
    
var r = confirm("Are you sure you want to Permanently delete this order?");
if (r === true) {
     $http({
        method : "POST",
        url : base_url+"quick_search/delete_search",
         data: { "id":id }
    }).then(function mySucces(response) {
        if(response.data==='true')
        {
            $scope.msg = 'Success';
             $http.get(base_url+"quick_search/feach")
           .then(function (response) {$scope.json = response.data;});
        }else{
            $scope.msg = 'Error';
            
        }
        
    }, function myError(response) {
        $scope.msg = response.statusText;
    
    });
} else {
     $scope.msg = 'Cancel Delete';
}
 
};// END SCOPE DELETE

});//end controller




