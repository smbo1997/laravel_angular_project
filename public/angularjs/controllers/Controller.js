app.controller("myCtrl", function($scope,$http) {
    $scope.tableData = [];
    $scope.addData = function (data) {
        if($scope.firstname && $scope.lastname && $scope.age){
            $http.post('/insertdata',
                {
                    productname: $scope.firstname,
                    productsize: $scope.lastname,
                    price: $scope.age

                })
                .success(function(response) {
                    $scope.tableData.push({'firstname':$scope.firstname,'lastname':$scope.lastname,'age':$scope.age,'id':response.id});
                    $scope.firstname = '';
                    $scope.lastname = '';
                    $scope.age = '';
            })

        }

    };

    $scope.deleteData = function (data,index) {
        $http.post('/deleteproduct',
            {
                productid: data,

            })
            .success(function(response) {
                if(response.data == true){
                    $scope.tableData.splice(index,1);
                }

            })

    }

    $scope.update = function (data,index) {
         $scope.upindex=index;
         $scope.uname=data.firstname;
         $scope.lname=data.lastname;
         $scope.ages=data.age;
         $scope.productid=data.id;
    }
    
    $scope.updatedData = function (productid,data) {
        var localData=$scope.tableData[$scope.upindex];
        $http.post('/updateproduct',
            {
                productid: productid,
                productname:$scope.uname,
                productsize:$scope.lname,
                price:$scope.ages
            })
            .success(function (response) {
                if(response.data == true){
                    localData.firstname=$scope.uname;
                    localData.lastname=$scope.lname;
                    localData.age=$scope.ages;
                }
            })
    }



});


app.controller('CarouselCtrl',function ($scope) {
    $scope.myInterval = 3000;
    $scope.slides=[];
    var images = angular.element(document.querySelector('#image')).find('img');
    angular.forEach(images, function(key,value) {
        $scope.slides.push({'image':key.src});
    });
});


app.controller('mycaruselCtrl',function($scope,$interval){
   $scope.data =[
       {
           image: '/images/download1.jpg'
       },
       {
           image: '/images/download2.jpg'
       },
       {
           image: '/images/download3.jpg'
       },
       {
           image: '/images/download4.jpg'
       }
   ]

    var count=0;
    $scope.image = $scope.data[count].image;
    $scope.next = function () {
            if(count==$scope.data.length - 1) count=-1;
                $scope.image = $scope.data[++count].image;

    }

    $scope.prev = function () {
        if(count==0) count = $scope.data.length;
        $scope.image = $scope.data[--count].image;
    }
    $interval($scope.next,3500)
});


app.controller('fileCtrl',function ($scope) {
    $scope.uploadimages =[];
    $scope.Upload  = function (event) {
        var files = event.target.files[0];
        if(files){
            var reader= new FileReader();
            reader.readAsDataURL(files);
            reader.onload = function(){
                $scope.uploadimages.push({'images':reader.result})
                $scope.$apply();
            };
            $scope.file="";
        }
    }

})

