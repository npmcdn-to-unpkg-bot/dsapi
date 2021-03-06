<html ng-app="myApp" class="ng-scope">
<head>
    <meta charset="utf-8" content="text/html" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="no" name="msapplication-tap-highlight">
    <meta content="" name="description">
    <meta content="catcom" name="author">
    <title>USPORT - Vừa nhanh vừa hot</title>
    <!-- Favicons-->
    <link sizes="16x16" href="favicon.ico" rel="icon">
    <link href="/images/logo.png" sizes="60x60" rel="/apple-touch-icon-precomposed">
    <link href="/images/logo.png" rel="/apple-touch-icon-precomposed">

    <meta content="uSport" property="og:title">
    <meta content="Fast and Furious" property="og:description">
    <meta content="website" property="og:type">
    <meta content="http://dsng.com/" property="og:url">
    <!-- Font Awesome-->
    <link href="/app/css/ionicons.min.css" rel="stylesheet">
    <!-- Theme style-->
    <link href="/app/css/usport.css" rel="stylesheet">
    <link href="/app/css/main.css" rel="stylesheet">
    <link href="/app/bower_components/ngprogress/ngProgress.css" rel="stylesheet">
    <base href="http://dsng.com/" />
</head>
<body data-spy="scroll" data-target=".scrollspy" ng-controller="rootCtrl">

<!-- Fixed navbar-->
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            <a ui-sref="home" href="" class="navbar-brand"><img src="/app/images/logo.png"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" menu>

        </div>
    </div>
</div>
<!-- Footer-->
<div ui-view></div>
<!-- <div class="new-post">
    <div class="new-inner"><a ng-click="selectCate()" href="javascript:;" class="icon ion-edit"></a></div>
</div> -->

<script src="/app/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/app/bower_components/jquery-bridget/jquery-bridget.js"></script>
<script src="/app/bower_components/ev-emitter/ev-emitter.js"></script>
<script src="/app/bower_components/desandro-matches-selector/matches-selector.js"></script>
<script src="/app/bower_components/fizzy-ui-utils/utils.js"></script>
<script src="/app/bower_components/get-size/get-size.js"></script>
<script src="/app/bower_components/outlayer/item.js"></script>
<script src="/app/bower_components/outlayer/outlayer.js"></script>
<script src="/app/bower_components/masonry/masonry.js"></script>
<script src="/app/bower_components/imagesloaded/imagesloaded.js"></script>
<script src="/app/bower_components/angular/angular.js"></script>
<script src="/app/bower_components/angular-cookies/angular-cookies.js"></script>
<script src="/app/bower_components/angular-masonry/angular-masonry.js"></script>
<script src="/app/bower_components/angular-route/angular-route.js"></script>
<script src="/app/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/app/bower_components/moment/moment.js"></script>
<script src="/app/bower_components/angular-moment/angular-moment.js"></script>
<script src="/app/bower_components/moment/locale/vi.js"></script>
<script src="/app/js/ng-infinite-scroll.min.js"></script>
<script src="/app/bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>
<script src="/app/bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>
<script src="/app/bower_components/angular-loading-overlay/dist/angular-loading-overlay.js"></script>
<script src="/app/bower_components/ngprogress/build/ngprogress.min.js"></script>
<script src="/app/js/jwplayer/jwplayer.js"></script>
<script>jwplayer.key="aWeoAbEahWUDi/nJtqR1F2oV6J1IPWiKNVNECg==";</script>
<script src="/app/bower_components/ng-jwplayer/jwplayer.min.js"></script>
<script src="/app/bower_components/ng-flow/dist/ng-flow-standalone.min.js"></script>
<script src="/app/bower_components/flow.js/dist/flow.js"></script>
<script src="/app/bower_components/ng-flow/dist/ng-flow.min.js"></script>
<script src="/app/bower_components/angulartics/dist/angulartics.min.js"></script>
<script src="/app/bower_components/angulartics-google-analytics/dist/angulartics-google-analytics.min.js"></script>
<script src="/app/bower_components/angular-ui-utils/ui-utils.js"></script>
<script src="/app/bower_components/angular-scroll-glue/src/scrollglue.js"></script>
<script src="/app/bower_components/ngstorage/ngStorage.min.js"></script>
<!-- <script src="/app/bower_components/angular-easyfb/build/angular-easyfb.min.js"></script> -->
<!-- <script src="/app/bower_components/angular-local-storage/dist/angular-local-storage.min.js"></script> -->
<script src="/app/js/perfect-scrollbar.min.js"></script>
<script src="/app/js/main.js"></script>
<script src="/app/js/app.js"></script>
<!--  -->
<script src="/app/js/controllers.js"></script>
<script src="/app/js/services.js"></script>
<script src="/app/js/filters.js"></script>
<script src="/app/js/directives.js"></script>
<!--Controllers-->
<script src="/app/js/controllers/post.js"></script>
<script src="/app/js/controllers/user.js"></script>
<script src="/app/js/controllers/search.js"></script>
<script src="/app/js/controllers/chat.js"></script>
<script src="/app/js/models/post.js"></script>
<script src="/app/js/models/user.js"></script>
<script src="/app/js/models/search.js"></script>
<script src="/app/js/lightbox.min.js"></script>

<!--Az-->
<script src="/app/js/az/socket.io.js" type="text/javascript"></script>
<script src="/app/js/az/jsencrypt.js" type="text/javascript"></script>
<script src="/app/js/az/azstack_sdk-1.2.js" type="text/javascript"></script>

<script>/*(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');ga('create','UA-68380363-2','auto');ga('send','pageview');*/</script>
<script type="text/javascript">/*$(document).ready(function(){$.ajaxSetup({cache:true});$.getScript('//connect.facebook.net/en_US/sdk.js',function(){FB.init({appId:'1184650714881453',version:'v2.6'});});});*/</script>
<script type="text/javascript">/*function b(){var a=document.createElement("script");a.src="/__browser_check/public/b2f79ab.js";document.body.appendChild(a);var c=!1;a.onload=a.onreadystatechange=function(){if(!(c||this.readyState&&"loaded"!==this.readyState&&"complete"!==this.readyState)){c=!0;var d=document.createElement("script");d.src="/__browser_check/script.js";document.body.appendChild(d);a.onload=a.onreadystatechange=null}}}
-1==document.cookie.indexOf("f942ca9=")&&(window.addEventListener?window.addEventListener("load",b,!1):window.attachEvent?window.attachEvent("onload",b):window.onload=b);*/</script>
</body>
</html>