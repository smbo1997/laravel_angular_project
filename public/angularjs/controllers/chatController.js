app.controller('chatCtrl',function ($scope,$http,$interval) {

    $scope.getmessages = function (event) {
        angular.element('.chat').empty();
        angular.element('.sendbtn').removeAttr("disabled");
        angular.element('.myfileinput').removeAttr("disabled");
        var userid = $(event.target).attr("id");
        $scope.to_user_id = userid;
        var username = $(event.target).attr("user-name");
        var currentuser = angular.element('.currentuser').attr('id');
        var html = '';
        $interval(getnotreadmessages, 5000);
        $http.post('/getmessages',
            {
                userid:userid,

            })
            .success(function (response) {
                    if(response.messages){
                        angular.forEach(response.messages, function(value, key) {
                            if(value.from_user == userid){
                            html += '<li class="left clearfix">'+
                                    '<span class="chat-img pull-left" style="margin-top: 10px;">'+
                                    '<strong class="primary-font1">'+value.name+'</strong>'+
                                    '</span>'+
                                    '<div class="chat-body clearfix">'+
                                   '<div class="header">'+
                                    '<strong class="primary-font1">'+value.name+'</strong>'+
                                   '<small class="pull-right text-muted"><i class="fa fa-clock-o"></i>'+value.created_at+'</small>'+
                                   '</div>'+
                                   '<p>'+ value.content+'</p>'+
                                   '</div>'+
                                   '</li>';
                            }

                            if(value.from_user == currentuser){
                                 html +=
                                    '<li class="right clearfix">'+
                                    '<span class="chat-img pull-right" style="margin-top: 10px;">'+
                                    '<strong class="primary-font" >'+value.name+'</strong>'+
                                    '</span>'+
                                    '<div class="chat-body clearfix">'+
                                    '<div class="header">'+
                                    '<strong class="primary-font">'+value.name+'</strong>'+
                                    '<small class="pull-right text-muted">' +
                                    '<i class="fa fa-clock-o">' +
                                    '</i>'+ value.created_at +'</small>'+
                                    '</div>'+
                                    '<p>'+ value.content+
                                    '</p>'+
                                    '</div>'+
                                    '</li>';
                            }
                        });
                        angular.element('.chat').append(html);
                    }
            });

    }

    $scope.sendmessage = function (event) {
        var content = $scope.content;
        var userid =  $scope.to_user_id;
        var currentusername =  $(event.target).attr("currentusername");
        var html = '';
        var image =  $scope.uploadimage;
        if(image){
            var imagename = '';
            angular.forEach(image, function(value, key) {
                 imagename = value.images;
            });
        }

        if(content){
            $http.post('/sendmessage',
                {
                    contents:content,
                    userid:userid

                })
                .success(function (response) {
                    if(response.data == true){
                        var t = new Date();
                        var h = t.getHours();
                        var m = t.getMinutes();
                        if (m < 10)
                            m = '0' + m;
                        var y = t.getFullYear();
                        var M = t.getMonth();
                        if (M < 10)
                            M = '0' + M;
                        var d = t.getDate();
                        if (d < 10)
                            d = '0' + d;
                        var s = t.getSeconds();
                        if (s < 10)
                            s = '0' + s;
                        if(image){



                                html =
                                    '<li class="right clearfix">'+
                                    '<span class="chat-img pull-right" style="margin-top: 10px;">'+
                                    '<strong class="primary-font" >'+currentusername+'</strong>'+
                                    '</span>'+
                                    '<div class="chat-body clearfix">'+
                                    '<div class="header">'+
                                    '<strong class="primary-font">'+currentusername+'</strong>'+
                                    '<small class="pull-right text-muted">' +
                                    '<i class="fa fa-clock-o">' +
                                    '</i>'+ y + '-' + M + '-' + d + ' ' + h + ':' + m + ':' + s +'</small>'+
                                    '</div>'+
                                    '<p>'+ content+
                                    '</p>'+
                                    '<img src="'+imagename+'">'+
                                    '</div>'+
                                    '</li>';


                        }else{
                            html =
                                '<li class="right clearfix">'+
                                '<span class="chat-img pull-right" style="margin-top: 10px;">'+
                                '<strong class="primary-font" >'+currentusername+'</strong>'+
                                '</span>'+
                                '<div class="chat-body clearfix">'+
                                '<div class="header">'+
                                '<strong class="primary-font">'+currentusername+'</strong>'+
                                '<small class="pull-right text-muted">' +
                                '<i class="fa fa-clock-o">' +
                                '</i>'+ y + '-' + M + '-' + d + ' ' + h + ':' + m + ':' + s +'</small>'+
                                '</div>'+
                                '<p>'+ content+
                                '</p>'+
                                '</div>'+
                                '</li>';
                        }

                        angular.element('.chat').append(html);
                        $scope.content = '';
                    }
                });
        }

    }

    getnotreadmessages = function () {
        var id = $scope.to_user_id;
       if(id){
           $http.post('/getnotreadmessages',
               {
                   userid:id,

               }).success(function (response) {
                        if(response.message.length>0){
                            angular.forEach(response.message, function(value, key) {
                                var content =
                                    '<li class="left clearfix">'+
                                    '<span class="chat-img pull-left" style="margin-top: 10px;">'+
                                    '<strong class="primary-font1">'+value.name+'</strong>'+
                                    '</span>'+
                                    '<div class="chat-body clearfix">'+
                                    '<div class="header">'+
                                    '<strong class="primary-font1">'+value.name+'</strong>'+
                                    '<small class="pull-right text-muted"><i class="fa fa-clock-o"></i>'+value.created_at+'</small>'+
                                    '</div>'+
                                    '<p>'+ value.content+'</p>'+
                                    '</div>'+
                                    '</li>';
                                angular.element('.chat').append(content);
                            });

                        }
           });
       }
    }
    
    $scope.imageinchat = function (event) {
        var files = event.target.files[0];
        $scope.uploadimage = [];
        if(files){
            var reader= new FileReader();
            reader.readAsDataURL(files);
            reader.onload = function(){
                $scope.uploadimage.push({'images':reader.result})
                $scope.$apply();
            };
            $scope.file="";
        }
    }
});