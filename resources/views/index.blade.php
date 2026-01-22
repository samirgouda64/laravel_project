<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title> Workzen Technologies </title>
    <link rel="icon" type="image/png" sizes="36x36" href="{{ asset('assets/icons/workgen_icon2.png') }}" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.min.css">

<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">

	<?php
	$CssInst = "";
	$DomainCssArr = [];
	$SkinColor = 'linear-gradient(to right,rgb(31, 131, 138),rgb(31, 128, 135),rgb(35, 138, 146))';
	$ContentColor =  'rgb(22, 104, 110)';
	$IndexLogoWidth = '100%';
	$IndexLogoHeight =  '60px';
	$IndexMobileLogoWidth = '100%';
	$LogoHeight =  '150px';
	$LogoWidth = '100%';
	$IndexTitleFontSize ='100%';
    $supportEmail = 'erp-support@workzenindia.in';
    $copyrightText = 'Design & Developed By Workzen Technologies Pvt. Ltd, India';
?>
    <style>
        .marquee {
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            box-sizing: border-box;
            background: linear-gradient(90deg, #FFD700, #FFD700);
            color: black;
            padding: 1rem 0;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .marquee div {
            display: inline-block;
            padding-left: 100%;
            animation: marquee 15s linear infinite;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        :root {
            --skin-color:
                <?= $SkinColor ?>
            ;
            --content-color:
                <?= $ContentColor ?>
            ;
            --log-width:
                <?= $IndexLogoWidth ?>
            ;
            --logo-height:
                <?= $IndexLogoHeight ?>
            ;
            --mobile-logo-width:
                <?= $IndexMobileLogoWidth ?>
            ;
            --title-font-size:
                <?= $IndexTitleFontSize ?>
            ;
        }
    </style>
	<style>
		body::-webkit-scrollbar {
			display: none;
		}
	</style>
</head>

<body>
	<div class="main-box">

		<div class="main-box2">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12 col-lg-12 col-md-12">
						<div class="content-box">
							<div class="content-box-left">

								<form class="login-form" id="loginform" name="loginform">
                                     @csrf 
									<input type="hidden" name="shapassword" />
									<input type="hidden" name="key" />
									<div class="ico-box">
										<span>
                                            <img src="{{ asset('assets/icons/workgen_icon2.png') }}" 
                                            alt="WorkZen Icon" style="width:40px; height:90px;">
                                        </span>
									</div>
									<a href="index.php">
										<!-- <div class="col-sm-4">
											<img src="{{ asset('assets/icons/workgen_icon.png') }}">
										</div> -->
										<div class="col-sm-12">
											<h2 class="org-title">Workzen Technologies</h2>
										</div>
									</a>
									<div id="showerror"
										style="color:red;font-size:12px;font-weight:bold;text-align:center;">
										<span></span>
									</div>
									<div class="fild">
										<span><i class="fa fa-user" aria-hidden="true"></i></span>
										<input type="text" id="username" name="username" placeholder="User Name">
									</div>
									<div class="fild">
										<span><i class="fa fa-key" aria-hidden="true"></i></span>
										<input type="password" id="password" name="password" placeholder="Password">
									</div>
									<div class="fild">
										<span><i class="fa fa-building" aria-hidden="true"></i></span>
										<select id="cmbCompany" name="cmbCompany">
											<option value=''>Company</option>
                                                <?php
                                                    foreach ($company_name as $key=>$value)
                                                    {
                                                        echo '<option value="'.$value->company_code.'">'.$value->company_name.'</option>';
                                                    }
                                                ?>
										</select>
									</div>
									<button type="submit" id="btnLogIn" name="btnLogIn">Login</button>
									<a href="forgotPassword.php">Forget Password ?</a>
								</form>&nbsp;
								<div class='col-sm-12 col-lg-12 col-md-12'>
									<center>
										<p style='color:white;font-size:13px'>Any Issues? Please Contact ERP
                                        <br><b><?php echo $supportEmail ?></b></p>
									</center>
								</div>

							</div>
						<div class="content-box-right">
                            <div class="flexslider left">
                                <ul class="slides">
                                    @foreach($sliders as $slider)
                                        <li>
                                            <img src="{{ asset($slider->image_path) }}" alt="Slider">
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-12 col-md-12">
					<p><?php echo $copyrightText ?></p>
				</div>
			</div>
		</div>
	</div>

	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.bundle.min.js'></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.2.0/jquery.flexslider-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script type="text/javascript">
		$('.flexslider').flexslider({
			animation: "slide",
			controlNav: true,        // show dots
            directionNav: true,      // show next/prev arrows
            slideshowSpeed: 4000,    // 4 seconds per slide
            animationSpeed: 600 
		});
		$(document).ready(function () {

            function login(){

                var username = $('#username').val();
                var password = $('#password').val();
                var company = $('#cmbCompany').val();
                let token    = $('input[name="_token"]').val();
                
                $.ajax({
                    url:'/postLogin',
                    type:'POST',
                    data:{
                        username:username,
                        password:password,
                        company:company,
                        _token:token
                    },
                    success:function(result){
                        if(result.dbStatus ==  'SUCCESS'){
                            toastr.success(result.dbMessage);
                            window.location.href = result.redirect_url;
                        } else if (result.dbStatus == 'FAILURE'){
                            toastr.error(result.dbMessage);
                        }
                    },
                    error: function () {
				        toastr.error('Unable to process please contact support');
                    }
                })
            }

            $('#loginform').on('submit', function(e){
                e.preventDefault();
                login();
            })

		});
	</script>

</body>