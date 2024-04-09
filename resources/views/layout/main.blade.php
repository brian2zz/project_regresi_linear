<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta name="description"
        content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code." />
    <meta name="keywords"
        content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard" />
    <meta name="author" content="ThemeSelect" />
    <title>
        Regresi Linear
    </title>
    <link rel="icon" type="image/png" href="../app-assets/images/ico/logo.png">
    <link
        href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700"
        rel="stylesheet" />
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet" />
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/vendors.css" />
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/chartist.css" />
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/chartist-plugin-tooltip.css" />
    <!-- END VENDOR CSS-->
    <!-- BEGIN CHAMELEON  CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/app.css" />
    <!-- END CHAMELEON  CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-menu-modern.css" />
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/colors/palette-gradient.css" />
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/colors/palette-gradient.css" />
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/chat-application.css" />
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/dashboard-analytics.css" />
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
    <!-- END Custom CSS-->
    @stack('styles')
</head>

<body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-color="bg-gradient-x-purple-red" data-col="2-columns">
    @include('layout.component.navbar')
    @include('layout.component.sidebar')
    @yield('content')

    <!-- BEGIN VENDOR JS-->
    <script src="../app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    @stack('scripts')
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="../app-assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
    <script src="../app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN CHAMELEON  JS-->
    <script src="../app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="../app-assets/js/core/app.js" type="text/javascript"></script>
    <!-- END CHAMELEON  JS-->
    <!-- BEGIN PAGE LEVEL JS-->

    <!-- END PAGE LEVEL JS-->
</body>

</html>
