<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <base href="{{ URL::to('/') }}" />
    <title>
        @yield('metaTitle')
        | {{ Config::get('app.siteName') }}
    </title>
    
    @if(Config::get('site.allowRobots'))
        <meta name="robots" content="noindex, nofollow" />
    @endif
    
    <meta name="keywords" content="@yield('metaKeywords')" />
    <meta name="description" content="@yield('metaDescription')" />
    
    <link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
    <script src="js/libs/modernizr-2.5.3.min.js"></script>
</head>


<body>
    <header>
        <div class="wrapper">
            <h1><a href="{{ URL::to('/') }}">Gen &amp; Send</a></h1>
            <h3>A Password Creation &amp; Push Application</h3>
        </div>
    </header>
    <div id="notices"></div>
    
    <div role="main" id="main">
        <!-- All hail the glorious source code! Well, okay, it's not *that* glorious, but still, nice one for checking. +1 Internets for you. -->
        <div id="gensend">
            @yield('content')
            
            <div class="footnotes">
                @if(Config::get('site.isSSL'))
                <p>
                    <strong>This page is secure.</strong>
                </p>
                <p>
                    All data on this page is encrypted and sent over SSL.
                </p>
                @endif
                <p>
                    Source code for these tools can be found on <a href="{{ Config::get('gensend.githubUrl') }}">Github</a>
                </p>
            </div>
        </div>
    </div>
    
    <!-- To err is human... to really foul up requires the root password. -->
    <footer>
        <div class="wrapper">
            <p>Powered by <a href="{{ Config::get('gensend.url') }}">Gen&amp;Send</a> - Copyright &copy; All Rights Reserved.</p>
            <div id="footer_menu">
                <ul id="footer_menu" class="footer_menu">
                    <li><a href="{{ URL::to('/') }}">Home</a></li>
                    <li><a href="{{ URL::to('/gen') }}">Generate</a></li>
                    <li><a href="{{ URL::to('/send') }}">Send</a></li>
                    <li class="last"><a href="{{ URL::to('/about') }}">About</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>
    
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>
</body>
</html>