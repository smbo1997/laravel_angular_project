
<style >
    #slides_control > div{
        height: 200px;
    }
    img{
        margin:auto;
        width: 400px;
    }
    #slides_control {
        position:absolute;
        width: 400px;
        left:50%;
        top:75px;
        margin-left:-200px;
    }
</style>
<div>
    <div style="display:none" id="image">
        <img src="{{URL::asset('/images/download1.jpg')}}">
        <img src="{{URL::asset('/images/download2.jpg')}}">
        <img src="{{URL::asset('/images/download3.jpg')}}">
        <img src="{{URL::asset('/images/download4.jpg')}}">
    </div>
    <div ng-controller="CarouselCtrl" id="slides_control">
        <div>
            <carousel interval="myInterval">
                <slide ng-repeat="slide in slides" active="slide.active">
                    <img ng-src="<%slide.image%>">
                    <div class="carousel-caption">
                        <h4>Slide <%$index+1%></h4>
                    </div>
                </slide>
            </carousel>
        </div>
    </div>
</div>