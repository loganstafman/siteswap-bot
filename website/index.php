<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Siteswap Bot</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">Siteswap Bot</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#portfolio">Pre-Generated Siteswaps</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">About</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <svg height="300px">
											<?php include('img/unicycle.svg'); ?>
										</svg>
                    <div class="intro-text">
                        <span class="name">Siteswap Bot</span>
                        <hr class="star-light">
                        <div class="skills">www.siteswapbot.com/<input id="goToSiteswap" style="color:#2c3e50;" type="text" placeholder="Your Siteswap Here" autofocus>
												<a href="javascript:void(0)" onclick="goToPage()" class="btn btn-sm btn-outline ">Go</a></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Previously Generated Siteswaps</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row" id="siteswaps">
						<?php include("prev.php"); ?>
            </div>
						<div class="col-lg-8 col-lg-offset-2 text-center">
							<a href="javascript:void(0)" onclick="loadMoreSiteswaps();" class="btn btn-lg btn-outline">
								More
							</a>
						</div>
        </div>
    </section>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>This website is meant to help jugglers communicate over the web.  To create a gif of your own, simply choose the siteswap you want and type http://siteswapbot.com/your_siteswap into the url bar.  If it takes a few seconds, don't worry, this means you're the first to generate that siteswap on this site!</p>
                </div>
                <div class="col-lg-4">
                    <p>Don't know what a siteswap is? A siteswap is a mathematical notation by which one can represent juggling patterns.  There are lots of rules, but this site can serve as a nifty learning tool for those interested.</p>
                </div>
            </div>
        </div>
    </section>

        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
		<!-- jQuery -->
    <script src="js/jquery.js"></script>
		<script>
			var offset = 6;
			function loadMoreSiteswaps() {
				$.ajax({
					url: 'prev.php?l=6&o=' + offset
				}).done(function(data) {
					$("#siteswaps").append(data);
					offset += 6;
				});
			}
			function goToPage() {
				var ss = $("#goToSiteswap").val();
				window.location.href = "http://siteswapbot.com/" + ss;
			}
		</script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

</body>

</html>
