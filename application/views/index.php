<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" type="text/css" href="/css/style.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>
		<!--[if lt IE 9]> 
         <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
        <![endif]-->
        <!--[if IE]>
          <link rel="stylesheet" href="/css/ie.css" type="text/css" media="screen">
        <![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	   <script src="http://fotoramajs.com/fotorama/jsfiddle/fotorama.js"></script>
	</head>
	<body>
		<div id="top_line"></div>
		<div id="wrap">
	<!-- wrap -->	
		<!-- header -->
			<header  role="banner">
				<div class="header_logo">
					<a href="/" title="Uniflair">
						<img src="/image/logo.png" alt="Uniflair" />
					</a>
				</div>
				<div class="contact_data">
					<ul>
						<li>+39 049 5388211</li>
						<li>+39 049 5388211</li>
						<li>info@uniflair.com</li>
					</ul>
				</div>
				<div class="search">
					<form method="post" action="/search.html" role="search">
						<input type="image" name="submit" id="submit" src="/image/search_icon.png" src="/image/search_icon.png"  onmouseover="this.src='/image/search_icon_hover.png'" onmouseout="this.src='/image/search_icon.png'"/>
						<input type="text" name="name" class="search_field"/>
					</form>
				</div>
			</header>
		<!-- header end-->
		<!-- nav -->
			<nav id="main_menu" role="navigation">
				<ul>
					<li><a href="/about.html" title="О нас">О нас</a></li>
					<li><a href="/products.html" title="Продукты и Системы">Продукты и Системы</a></li>
					<li><a href="/documentation.html" title="Документация">Документация</a></li>
					<li><a href="/whereToBuy.html" title="Где купить">Где купить</a></li>
				</ul>
			</nav>
		<!-- nav end -->
		<!-- content -->
            <?=($contentBlock=='products'?'<div class="active_block"></div>':'');?>
			<div id="content">
				<?php $this->load->view('content/'.$contentBlock);?>
			</div>
		<!-- content end-->
		<!-- footer -->
			<footer role="contentinfo">
				<div class="footer_logo">
					<a href="#" title="Schneider electric">
						<img src="/image/sch_logo.png" alt="" />
					</a>
				</div>
				<div class="footer_content">
					<p>Copyright © <?=date('Y');?> - Uniflair - All rights reserved</p>
				</div>
				<div class="by">
					<p>Powered by </p><a href="http://hiqe.ru/" target="_blank" title="hige"></a>
				</div>
			</footer>
		<!-- footer end-->
		</div>
	<!-- wrap  end -->
	<script>
	$(function () {
		if (document.location.host.match('fotoramajs')) {
			$('#download').show();
		}
	});
    </script>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter22672402 = new Ya.Metrika({id:22672402,
                        webvisor:true,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true});
            } catch(e) { }
        });
    
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
    
        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="//mc.yandex.ru/watch/22672402" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
	</body>
</html>