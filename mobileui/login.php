<!doctype html>
<html>

<head>
    <meta name="ac:route" content="/mobile-login">
    <meta name="ac:base" content="/exp">
    <base href="/exp/mobileui/">
    <script src="../dmxAppConnect/dmxAppConnect.js"></script>
    <meta charset="UTF-8">
    <title>Outlay Mobile Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#0134d4">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;1,300;1,400;1,600&display=swap" rel="stylesheet">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="../bootstrap/5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../fontawesome5/css/all.min.css" />
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/moment.js/2/moment-with-locales.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="../dmxAppConnect/dmxNotifications/dmxNotifications.css" />
    <script src="../dmxAppConnect/dmxNotifications/dmxNotifications.js" defer=""></script>
    <script src="../dmxAppConnect/dmxBrowser/dmxBrowser.js" defer=""></script>
</head>

<body is="dmx-app" id="login">
    <div is="dmx-browser" id="browser1"></div>
    <dmx-notifications id="notifies1"></dmx-notifications>


    <div id="appCapsule">
        <div class="section mt-2 text-center">
            <h1>OUTLAY</h1>
            <h4>Log In</h4>
        </div>
        <div class="section mb-5 p-2">
            <form novalidate="novalidate" id="auth-form" is="dmx-serverconnect-form" action="../dmxConnect/api/AccessControl/Login.php" dmx-on:success="notifies1.success('Succesfully Logged In');browser1.goto('mobile-dashboard.php')"
                dmx-on:unauthorized="notifies1.danger('Invalid Login')" method="post">
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="email1">Username</label>
                                <input type="text" class="form-control" autocomplete="off" id="email1" name="username" placeholder="Username">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Password</label>
                                <input type="password" class="form-control" name="password" id="password1" placeholder="Password">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-links mt-2">
                    <div>
                        <a href="app-register.html">Register Now</a>
                    </div>
                    <div><a href="app-forgot-password.html" class="text-muted">Forgot Password?</a></div>
                </div>

                <div class="form-button-group  transparent">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Log in <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span>
                    </button>
                </div>

            </form>
        </div>

    </div>

    <!-- Bootstrap-->
    <script src="assets/js/lib/popper.min.js"></script>
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>
    <!-- Base Js File -->


    <script src="../bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>