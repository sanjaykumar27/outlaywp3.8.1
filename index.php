<?php 

require('dmxConnectLib/dmxConnect.php');

$app = new \lib\App();

$app->exec(<<<'JSON'
{
	"steps": [
		"Connections/ConnCS",
		"SecurityProviders/SecurityCS",
		{
			"module": "auth",
			"action": "restrict",
			"options": {"permissions":"Active","loginUrl":"login.html","forbiddenUrl":"login.html","provider":"SecurityCS"}
		}
	]
}
JSON
, TRUE)
?>

<!doctype html>
<html is="dmx-app" lang="en">

<head>
    <meta name="ac:route" content="/">
    <base href="/">
    <script src="dmxAppConnect/dmxAppConnect.js"></script>
    <meta charset="utf-8" />
    <title>Expense Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-control" content="public">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome5/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/moment.js/2/moment-with-locales.min.js"></script>
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundlec7e5.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/global/plugins.bundlec7e5.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/prismjs/prismjs.bundlec7e5.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundlec7e5.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/header/base/lightc7e5.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/header/menu/lightc7e5.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/brand/darkc7e5.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/aside/darkc7e5.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/logos/favicon.ico" />
    <script src="dmxAppConnect/dmxRouting/dmxRouting.js" defer=""></script>
    <script src="dmxAppConnect/dmxStateManagement/dmxStateManagement.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxBootstrap4TableGenerator/dmxBootstrap4TableGenerator.css" />
    <script src="dmxAppConnect/dmxBootstrap4Collapse/dmxBootstrap4Collapse.js" defer=""></script>
    <script src="assets/js/custom.js" defer=""></script>
    <script src="dmxAppConnect/dmxFormatter/dmxFormatter.js" defer=""></script>
    <script src="dmxAppConnect/dmxBootstrap4Tooltips/dmxBootstrap4Tooltips.js" defer=""></script>
    <script src="dmxAppConnect/dmxBootstrap4PagingGenerator/dmxBootstrap4PagingGenerator.js" defer=""></script>
    <script src="dmxAppConnect/dmxBootstrap4Modal/dmxBootstrap4Modal.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxDropzone/dmxDropzone.css" />
    <script src="dmxAppConnect/dmxDropzone/dmxDropzone.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxNotifications/dmxNotifications.css" />
    <script src="dmxAppConnect/dmxNotifications/dmxNotifications.js" defer=""></script>
    <script src="dmxAppConnect/dmxCharts/Chart.min.js" defer=""></script>
    <script src="dmxAppConnect/dmxCharts/dmxCharts.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/daterangepicker.min.css" />
    <script src="dmxAppConnect/dmxDatePicker/daterangepicker.min.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxDatePicker/dmxDatePicker.css" />
    <script src="dmxAppConnect/dmxDatePicker/dmxDatePicker.js" defer=""></script>
    <script src="dmxAppConnect/dmxBootstrap4Toasts/dmxBootstrap4Toasts.js" defer=""></script>
    <script src="dmxAppConnect/dmxBrowser/dmxBrowser.js" defer=""></script>
    <script src="dmxAppConnect/dmxSummernote/dmxSummernote.js" defer=""></script>
    <script src="js/custom.js" defer=""></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="manifest" href="manifest.json">
    <meta name="apple-mobile-web-app-status-bar" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" href="img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/icons/android/android-launchericon-144-144.png">
    <link rel="apple-touch-icon" sizes="167x167" href="assets/icons/android/android-launchericon-192-192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/icons/android/android-launchericon-512-512.png">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="dmxAppConnect/dmxPreloader/dmxPreloader.css" />
    <script src="dmxAppConnect/dmxPreloader/dmxPreloader.js" defer=""></script>
    <script src="dmxAppConnect/dmxSmoothScroll/dmxSmoothScroll.js" defer=""></script>
    <script src="dmxAppConnect/dmxBootstrap4Alert/dmxBootstrap4Alert.js" defer=""></script>
    <link rel="stylesheet" href="dmxAppConnect/dmxAutocomplete/dmxAutocomplete.css" />
    <script src="dmxAppConnect/dmxAutocomplete/dmxAutocomplete.js" defer=""></script>
    <script src="dmxAppConnect/dmxBootstrap4Navigation/dmxBootstrap4Navigation.js" defer=""></script>
    <script src="dmxAppConnect/dmxBootstrap5Navigation/dmxBootstrap5Navigation.js" defer=""></script>
    <script src="dmxAppConnect/dmxBootstrap5Modal/dmxBootstrap5Modal.js" defer=""></script>
</head>

<body id="index" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <dmx-notifications id="notif"></dmx-notifications>
    <dmx-serverconnect id="scCurrentMonthTotal" url="dmxConnect/api/Dashboard/CurrentMonth.php" dmx-param:crstartdate="varStartDate.value" dmx-param:crenddate="varEndDate.value"></dmx-serverconnect>
    <dmx-value id="varPreviousLast" dmx-bind:value="'<?php echo date('Y-m-d', mktime(0, 0, 0, date('m'), 0)) ?>'"></dmx-value>
    <dmx-value id="varPreviousFirst" dmx-bind:value="'<?php echo date('Y-m-d', mktime(0, 0, 0, date('m')-1, 1))?>'"></dmx-value>
    <dmx-value id="varStartDate" dmx-bind:value="'<?php echo date('Y-m-01') ?>'"></dmx-value>
    <dmx-value id="varEndDate" dmx-bind:value="'<?php echo date('Y-m-t') ?>'"></dmx-value>
    <div id="crTheme" is="dmx-if" dmx-bind:condition="scGetTheme.data.getTheme.main_theme == 'Dark'">
        <link href="assets/css/dark.css" rel="stylesheet" type="text/css" />
    </div>
    <dmx-serverconnect id="scGetTheme" url="dmxConnect/api/AccessControl/getTheme.php"></dmx-serverconnect>
    <dmx-serverconnect id="scChangeTheme" noload="noload" url="dmxConnect/api/Other/Theme/ColorTheme.php" dmx-on:success="scGetTheme.load();notifies1.success('Theme Changed')"></dmx-serverconnect>
    <dmx-smooth-scroll id="scroll1"></dmx-smooth-scroll>
    <dmx-serverconnect id="scMonthlyReport" url="dmxConnect/api/Dashboard/getMonthlyExpenseDashboard.php" onsuccess="MonthlyGraph();"></dmx-serverconnect>
    <!-- dmx-on:unauthorized="browser1.goto('auth')" -->
    <dmx-serverconnect id="scMostPurchasedItem" url="dmxConnect/api/Dashboard/getTop5Items.php" onsuccess="MonthlyGraph();"></dmx-serverconnect>
    <dmx-serverconnect id="scLogout" url="dmxConnect/api/AccessControl/logout.php" noload="noload"></dmx-serverconnect>
    <!-- <dmx-serverconnect id="scVerify" url="dmxConnect/api/AccessControl/scVerify.php" dmx-on:unauthorized="browser1.goto('login.php')"></dmx-serverconnect> -->
    <dmx-serverconnect id="scItemLists" url="dmxConnect/api/Common/getItems.php" dmx-on:unauthorized="browser1.goto('login.php')" noload></dmx-serverconnect>
    <dmx-serverconnect id="scAccountList" url="dmxConnect/api/Common/getAccountList.php" noload></dmx-serverconnect>
    <dmx-serverconnect id="scPaymentMethods" url="dmxConnect/api/Common/getPaymentMethods.php" noload></dmx-serverconnect>
    <dmx-serverconnect id="scUnits" url="dmxConnect/api/Common/getUnits.php" noload></dmx-serverconnect>
    <dmx-serverconnect id="scCategories" url="dmxConnect/api/Common/getItemCategory.php" noload></dmx-serverconnect>
    <dmx-preloader id="preloader1" preview="true" spinner="circle" color="#d482b3" bgcolor="#000000e3" size="80"
        dmx-show="scVerify.state.executing || scMostPurchasedItem.state.executing || scMonthlyReport.state.executing || routeExpenseList.scExpenseList.state.executing || routeExpenseList.scGetItems.state.executing || routeExpenseList.scCategories.state.executing || routeCreateExpense.scItemLists.state.executing || routeCreateExpense.scPaymentMethods.state.executing || routeCreateExpense.scUnits.state.executing || routeCreateExpense.scCategories.state.executing || routeCreateExpense.scInvoiceID.state.executing || scChangeTheme.state.executing || routeExpenseList.scGenerateGraph.state.executing || routeAccountList.scGetAccountList.state.executing || routeAccounDetails.scGetAccountDetail.state.executing">
    </dmx-preloader>
    <div is="dmx-browser" id="browser1"></div>
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">
            <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
                <div class="brand flex-column-auto" id="kt_brand">
                    <a href="javascript:void(0)" class="brand-logo">
                        <img alt="Logo" src="assets/media/logos/logo-light.png" />
                    </a>
                    <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                        <span class="svg-icon svg-icon svg-icon-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                        fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                                    <path
                                        d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                                </g>
                            </svg>
                        </span>
                    </button>
                </div>
                <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                    <div id="kt_aside_menu" class="aside-menu" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
                        <ul class="menu-nav">
                            <li class="menu-item" aria-haspopup="true">
                                <a href="./" class="menu-link d-flex align-items-center">
                                    <span class="menu-icon">
                                        <i class="fas fa-chart-line menu-fa-icon fa-fw"></i>
                                    </span>
                                    <span class="menu-text font-weight-bold">DASHBOARD</span>
                                </a>
                            </li>
                            <li class="menu-section">
                                <h4 class="h6 text-dark-65">MAIN MENU</h4>
                                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle d-flex align-items-center">
                                    <span class="menu-icon">
                                        <i class="fas fa-rupee-sign menu-fa-icon fa-fw"></i>
                                    </span>
                                    <span class="menu-text">Expense</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="./expense/quick" internal class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Quick Expense</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="./expense/create" internal class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">New Expense</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="./expense/list" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Expense List</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle d-flex align-items-center">
                                    <span class="menu-icon">
                                        <i class="fas fa-hammer menu-fa-icon fa-fw"></i>
                                    </span>
                                    <span class="menu-text">Master</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="./master/items" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Item List</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="./account/list" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Account List</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle d-flex align-items-center">
                                    <span class="menu-icon">
                                        <i class="fas fa-user-shield menu-fa-icon fa-fw"></i>
                                    </span>
                                    <span class="menu-text">Insurance</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="./insurance/list" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Life / Health</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle d-flex align-items-center">
                                    <span class="menu-icon">
                                        <i class="fas fa-user-shield menu-fa-icon fa-fw"></i>
                                    </span>
                                    <span class="menu-text">Goals</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="./targetList" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Goals</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle d-flex align-items-center">
                                    <span class="menu-icon">
                                        <i class="fas fa-wallet menu-fa-icon fa-fw"></i>
                                    </span>
                                    <span class="menu-text">Loans / EMI</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="./emi/list" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">EMI's</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle d-flex align-items-center">
                                    <span class="menu-icon">
                                        <i class="fas fa-wallet menu-fa-icon fa-fw"></i>
                                    </span>
                                    <span class="menu-text">Investment</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="./investment/funds" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Mutual Funds</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <div id="crDashboardItems" is="dmx-if" dmx-bind:condition="browser1.location.pathname == '/'">
                        <div class="subheader py-2 py-lg-4 mr-3 subheader-solid" id="kt_subheader">
                            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                <div class="d-flex align-items-center flex-wrap mr-2">
                                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-icon btn-primary " dmx-on:click="scMonthlyReport.load();scMostPurchasedItem.load({});scCurrentMonthTotal.load({})"><i class="flaticon-diagram"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column-fluid pt-2">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xl-3 col-6">
                                        <div class="card card-custom bg-success card-stretch gutter-b">
                                            <div class="card-body p-5">
                                                <a href="#" class="card-title font-weight-bolder text-white font-size-h6 mb-2 text-hover-state-dark d-block">Balance</a>
                                                <div class="font-weight-bold text-white font-size-sm">
                                                    <span class="font-size-h1 mr-2 font-weight-bolder ">₹ 54,000</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-3 col-12 pr-2">
                                        <div class="card card-custom bgi-no-repeat card-stretch gutter-b"
                                            style="background-position: right top; background-size: 30% auto; background-image: url(https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/svg/shapes/abstract-1.svg)">
                                            <div class="card-body">
                                                <i class="fa fa-inr fa-2x"></i>
                                                <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">₹
                                                    {{scMostPurchasedItem.data.TotalExpense.Total}}</span>
                                                <span class="font-weight-bold text-muted font-size-sm">Total Expense</span>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-3 col-6 pr-2">
                                        <div class="card card-custom bgi-no-repeat card-stretch gutter-b"
                                            style="background-position: right top; background-size: 30% auto; background-image: url(https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/svg/shapes/abstract-1.svg)">
                                            <div class="card-body p-5">
                                                <a href="#" class="card-title font-weight-bolder  font-size-h6 mb-2 text-hover-state-dark d-block">Current Month</a>
                                                <div class="font-weight-bold  font-size-sm">
                                                    <span class="font-size-h1 mr-2 font-weight-bolder ">₹ {{scCurrentMonthTotal.data.Total.TotalAmount}}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-6">
                                        <div class="card card-custom bg-info card-stretch gutter-b">
                                            <div class="card-body p-5">
                                                <a href="#" class="card-title font-weight-bolder text-white font-size-h6 mb-2 text-hover-state-dark d-block">Investment</a>
                                                <div class="font-weight-bold text-white font-size-sm">
                                                    <span class="font-size-h1 mr-2 font-weight-bolder ">₹ 54,000</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <div class="card card-custom bg-danger bgi-no-repeat card-stretch gutter-b"
                                            style="background-position: right top; background-size: 30% auto; background-image: url(https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/svg/shapes/abstract-3.svg)">
                                            <div class="card-body p-5">
                                                <a href="#" class="card-title text-white font-weight-bolder font-size-h6 mb-2 text-hover-state-dark d-block ">Liabilities</a>
                                                <div class="font-weight-bold text-muted font-size-sm">
                                                    <span class="text-white font-weight-bolder font-size-h1 mr-2">₹ 1,50,000</span></div>
                                                <div class="progress progress-xs mt-7 bg-white-o-90">
                                                    <div class="progress-bar bg-white" role="progressbar" style="width: 67%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 mb-5">
                                        <div class="card card-custom h-100">
                                            <div class="card-header h-auto border-0">
                                                <div class="card-title">
                                                    <h3 class="card-label">
                                                        <span class="d-block text-dark font-weight-bolder">Monthy Expense</span>
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="chart-demo p-1">
                                                <div id="expense_monthly" class="apex-charts"></div>
                                                <!-- <dmx-chart id="chart1" legend="bottom" dmx-bind:data="scMonthlyReport.data.monthlyExpense" labels="dates.formatDate('MMM-yy')" dataset-1:value="amount" dataset-1:label="Amount" points="true"
													point-style="rectRounded" width="" height="" cutout="" colors="colors9" noanimation smooth="true" responsive="true" point-size="" stacked="true" type="bar">
												</dmx-chart> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="card card-custom card-stretch gutter-b">
                                            <div class="card-header border-0">
                                                <h3 class="card-title font-weight-bolder text-dark">Upcoming Payments</h3>
                                            </div>
                                            <div class="card-body pt-0" style="max-height:385px;overflow:auto">
                                                <div class="d-flex align-items-center mb-4 bg-light-warning rounded p-5">
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">LIC | Sanjay | 32714512</a>
                                                        <span class="text-muted font-weight-bold">Due in 2 Days</span>
                                                    </div>
                                                    <a href="#" class="btn btn-icon btn-light btn-sm">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                </div>
                                                <div class="d-flex align-items-center bg-light-success rounded p-5 mb-4">
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Tata AIA Term Insurance</a>
                                                        <span class="text-muted font-weight-bold">Due in 2 Days</span>
                                                    </div>
                                                    <a href="#" class="btn btn-icon btn-light btn-sm">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                </div>
                                                <div class="d-flex align-items-center bg-light-danger rounded p-5 mb-4">
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Jio Fibre Recharge</a>
                                                        <span class="text-muted font-weight-bold">Due in 2 Days</span>
                                                    </div>
                                                    <a href="#" class="btn btn-icon btn-light btn-sm">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                </div>
                                                <div class="d-flex align-items-center bg-light-info rounded p-5 mb-4">
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Credit Card Bill</a>
                                                        <span class="text-muted font-weight-bold">Due in 2 Days</span>
                                                    </div>
                                                    <a href="#" class="btn btn-icon btn-light btn-sm">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                </div>
                                                <div class="d-flex align-items-center bg-light-info rounded p-5">
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">One Plus 8T | EMI</a>
                                                        <span class="text-muted font-weight-bold">Due in 2 Days</span>
                                                    </div>
                                                    <a href="#" class="btn btn-icon btn-light btn-sm">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-5">
                                        <div class="card card-custom card-stretch ">
                                            <div class="card-header border-0">
                                                <h4 class="card-title font-weight-bolder text-dark">Most Purchased Items</h4>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="align-items-center border-bottom d-flex flex-wrap mb-5 pb-2" dmx-repeat:repeatmostpurchaseditem="scMostPurchasedItem.data.TopItems">
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">{{subcategory_name}}</a>
                                                        <span class="text-muted font-weight-bold">{{category_name}}</span>
                                                    </div>
                                                    <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">{{total.toNumber().formatCurrency("₹ ", ".", ",", "2")}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div is="dmx-route" id="routeEmiList" path="/emi/list" url="Loan/spa_emiList.php" dmx-on:show="scEMIList.load()"></div>
                    <div is="dmx-route" id="routeMutualFunds" path="/investment/funds" url="investment/spa_mutualFunds.php"></div>
                    <div is="dmx-route" id="routeEmiDetails" path="/emi/details/:emi_id" url="Loan/spa_emiDetails.php" dmx-on:show="scEMIDetails.load()"></div>
                    <div is="dmx-route" id="routeQuickExpense" path="/expense/quick" url="Expense/spa_quickExpense.php"></div>
                    <div is="dmx-route" id="routeFormDetails" path="/form/detail/:form_id" url="Master/spa_formDetails.php"></div>
                    <div is="dmx-route" id="routeFormCreate" path="/form/create" url="Master/spa_formManagement.php"></div>
                    <div is="dmx-route" id="routeFormManagement" path="/form-management" url="Master/spa_formList.php" dmx-on:show="scFormList.load()"></div>
                    <div is="dmx-route" id="routeAccountList" path="/account/list" url="Master/spa_accountList.php" dmx-on:show="scGetAccountList.load();"></div>
                    <div is="dmx-route" id="routeAccounDetails" path="/account/details/:accountid" url="Master/spa_accountDetails.php" dmx-on:show="scGetAccountDetail.load();"></div>
                    <div is="dmx-route" id="routeDashboard" path="/dashboard" url="spa_dashboard.php" onshow="MonthlyGraph();"></div>
                    <div is="dmx-route" id="routeCreateExpense" path="/expense/create" url="Expense/spa_createExpense.php" dmx-on:show="scInvoiceID.load();scUnits.load();scAccountList.load();scItemLists.load();scPaymentMethods.load()"></div>
                    <div is="dmx-route" id="routeTarget" path="/targetList" url="Other/spa_targetList.php" dmx-on:show="scTargetList.load()"></div>
                    <div is="dmx-route" id="routeExpenseList" path="/expense/list" url="Expense/spa_expenseList.php" dmx-on:show="scExpenseList.load({})">
                    </div>
                    <div is="dmx-route" id="routeItems" path="/master/items" url="Master/spa_items.php" dmx-on:show="scItemList.load();scCategories.load()"></div>
                </div>
            </div>
            <div class="bg-white bottom-0 d-flex  position-fixed py-2 w-100" id="kt_footer">
                <div class="container-fluid d-flex justify-content-end">
                    <div class="align-items-center d-flex justify-content-between nav nav-dark">
                        <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                            <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                            <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">Sanjay</span>
                            <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                                <span class="symbol-label font-size-h5 font-weight-bold">S</span>
                            </span>
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-icon btn-clean btn-lg mr-3" id="kt_aside_mobile_toggle">
                        <i class="fas fa-bars text-dark"></i>
                    </a>
                    <a href="javascript:void(0)" dmx-show="scGetTheme.data.getTheme.main_theme == 'Light'" class="btn btn-icon btn-clean btn-lg" dmx-on:click="scChangeTheme.load({main_theme: 'Dark'})">
                        <i class="fas fa-circle text-dark"></i>
                    </a>
                    <a href="javascript:void(0)" dmx-show="scGetTheme.data.getTheme.main_theme == 'Dark'" class="btn btn-icon btn-clean btn-lg" dmx-on:click="scChangeTheme.load({main_theme: 'Light'})">
                        <i class="fas fa-circle text-white"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div id="kt_scrolltop" class="scrolltop">
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                    <path
                        d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                        fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>
        </span>
    </div>
    <script>
        var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };
        $(function () {
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/service-worker.js')
            }
        });
    </script>
    <script src="assets/plugins/global/plugins.bundlec7e5.js"></script>
    <script src="assets/plugins/custom/prismjs/prismjs.bundlec7e5.js"></script>
    <script src="assets/js/scripts.bundlec7e5.js"></script>
    <script src="assets/plugins/custom/fullcalendar/fullcalendar.bundlec7e5.js"></script>
    <script src="assets/js/pages/widgetsc7e5.js"></script>
</body>

</html>