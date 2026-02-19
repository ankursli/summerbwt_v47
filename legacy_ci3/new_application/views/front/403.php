<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>index</title>
    <style type="text/css">
        *, body{box-sizing: border-box;margin: 0;padding: 0;font-family: Arial;}
        img{width: auto;max-width: 100%;height:auto;}
        section{width: 100%;display: block;float: left;}
        div{display: block;}
        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-12 {
                position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }
        section.logo-main {
            padding-top: 30px;
        }
        .logo{max-width: 200px;}
        .content-main h1{
            font-size: 45px;
            display: block;            
            text-align: center;
            width: 100%;
            font-weight: bold;
            padding-bottom: 15px;
            color: #0066B3;
        }
        .content-main p{
            width: 100%;
            display: block;
            text-align: center;
            padding-bottom: 15px;
            font-size: 22px;
            color: #0066B3;

        }
        .homepage-button {
            width: 100%;
            display: block;
            text-align: center;
            padding: 35px 0;
        }
        a.home-btn {
            display: inline-block;
            text-align: center;
            padding: 10px 50px;
            font-size: 20px;
            text-decoration: none;
            color: #fff;
            text-transform: uppercase;
            background: #0066b3;
background: -moz-linear-gradient(top, #0066b3 1%, #59bded 100%);
background: -webkit-linear-gradient(top, #0066b3 1%,#59bded 100%);
background: linear-gradient(to bottom, #0066b3 1%,#59bded 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0066b3', endColorstr='#59bded',GradientType=0 );
            border-radius: 5px;
        }
        @media (min-width: 576px){
            .container {
                max-width: 540px;
            }
        }
        @media (min-width: 768px){
            .container {
                max-width: 720px;
            }
        }
        @media (min-width: 992px){
            .container {
                max-width: 960px;
            }
        }
		@media (min-width: 1200px) and (max-width: 1400px){
			.banner-main img{width:100%;max-width:880px;margin:0 auto;display:block;text-align:center;}
		}
        @media (min-width: 1200px){
            .container {
                width: 1170px;
                max-width: 1140px;
                margin: auto;
            }
        }
        
    </style>
    
</head>

<body>
    <div class="wrapper">
    	<section class="logo-main">
            <div class="container">
                <div class="row">
                    <div class="col-12">
        	           <img class="logo" src="<?php echo base_url('assets/image/logo.png');?>" alt="logo">
                    </div>
                </div>
            </div>
        </section>	
        <section class="banner-main">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                       <img class="banner" src="<?php echo base_url('assets/image/banner.jpg');?>" alt="banner">
                    </div>
                </div>
            </div>
        </section>
        <section class="content-main">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                       <h1>You're not permitted to see this page.</h1>
                       <p>Currently this service is not available in your country</p>
                    </div>
                </div>
            </div>
        </section>  	
    </div>
</body>
</html>
<?php die();?>
