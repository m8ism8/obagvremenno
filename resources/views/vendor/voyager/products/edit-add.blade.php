<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
    <title>Изменить Продукт</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="lMP0F7VhBPzb8toNZFtadDle0GgsyngkOJDzWjLQ"/>
    <meta name="assets-path" content="http://127.0.0.1:8000/admin/voyager-assets"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="http://127.0.0.1:8000/admin/voyager-assets?path=images%2Flogo-icon.png" type="image/png">


    <!-- App CSS -->
    <link rel="stylesheet" href="http://127.0.0.1:8000/admin/voyager-assets?path=css%2Fapp.css">

    <meta name="csrf-token" content="lMP0F7VhBPzb8toNZFtadDle0GgsyngkOJDzWjLQ">

    <!-- Few Dynamic Styles -->
    <style type="text/css">
        .voyager .side-menu .navbar-header {
            background:#22A7F0;
            border-color:#22A7F0;
        }
        .widget .btn-primary{
            border-color:#22A7F0;
        }
        .widget .btn-primary:focus, .widget .btn-primary:hover, .widget .btn-primary:active, .widget .btn-primary.active, .widget .btn-primary:active:focus{
            background:#22A7F0;
        }
        .voyager .breadcrumb a{
            color:#22A7F0;
        }
    </style>


</head>

<body class="voyager products">
    <div id="voyager-loader">
        <img src="http://127.0.0.1:8000/admin/voyager-assets?path=images%2Flogo-icon.png" alt="Voyager Loader">
    </div>


    <div class="app-container">
        <div class="fadetoblack visible-xs"></div>
        <div class="row content-container">
            <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button class="hamburger btn-link">
                            <span class="hamburger-inner"></span>
                        </button>
                        <ol class="breadcrumb hidden-xs">
                            <li class="active">
                                <a href="http://127.0.0.1:8000/admin"><i class="voyager-boat"></i> Панель управления</a>
                            </li>
                            <li>
                                <a href="http://127.0.0.1:8000/admin/products">Products</a>
                            </li>
                            <li>
                                <a href="http://127.0.0.1:8000/admin/products/1121">1121</a>
                            </li>
                            <li>Edit</li>
                        </ol>
                    </div>
                    <ul class="nav navbar-nav  navbar-right ">
                        <li class="dropdown profile">
                            <a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button"
                               aria-expanded="false"><img src="http://127.0.0.1:8000/storage/users/default.png" class="profile-img"> <span
                                    class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-animated">
                                <li class="profile-img">
                                    <img src="http://127.0.0.1:8000/storage/users/default.png" class="profile-img">
                                    <div class="profile-body">
                                        <h5>admin</h5>
                                        <h6>admin@admin.com</h6>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li class="class-full-of-rum">
                                    <a href="http://127.0.0.1:8000/admin/profile" >
                                        <i class="voyager-person"></i>
                                        Профиль
                                    </a>
                                </li>
                                <li >
                                    <a href="/" target="_blank">
                                        <i class="voyager-home"></i>
                                        Главная
                                    </a>
                                </li>
                                <li >
                                    <form action="http://127.0.0.1:8000/admin/logout" method="POST">
                                        <input type="hidden" name="_token" value="lMP0F7VhBPzb8toNZFtadDle0GgsyngkOJDzWjLQ">
                                        <button type="submit" class="btn btn-danger btn-block">
                                            <i class="voyager-power"></i>
                                            Выход
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="side-menu sidebar-inverse">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="side-menu-container">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="http://127.0.0.1:8000/admin">
                                <div class="logo-icon-container">
                                    <img src="http://127.0.0.1:8000/admin/voyager-assets?path=images%2Flogo-icon-light.png" alt="Logo Icon">
                                </div>
                                <div class="title">VOYAGER</div>
                            </a>
                        </div><!-- .navbar-header -->

                        <div class="panel widget center bgimage"
                             style="background-image:url(http://127.0.0.1:8000/admin/voyager-assets?path=images%2Fbg.jpg); background-size: cover; background-position: 0px;">
                            <div class="dimmer"></div>
                            <div class="panel-content">
                                <img src="http://127.0.0.1:8000/storage/users/default.png" class="avatar" alt="admin avatar">
                                <h4>Admin</h4>
                                <p>admin@admin.com</p>

                                <a href="http://127.0.0.1:8000/admin/profile" class="btn btn-primary">Профиль</a>
                                <div style="clear:both"></div>
                            </div>
                        </div>

                    </div>
                    <div id="adminmenu">
                        <admin-menu :items="[{&quot;id&quot;:1,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;Dashboard&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-boat&quot;,&quot;color&quot;:null,&quot;parent_id&quot;:null,&quot;order&quot;:1,&quot;created_at&quot;:&quot;2022-02-11T08:15:18.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-02-11T08:15:18.000000Z&quot;,&quot;route&quot;:&quot;voyager.dashboard&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin&quot;,&quot;active&quot;:false,&quot;children&quot;:[]},{&quot;id&quot;:4,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;Roles&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-lock&quot;,&quot;color&quot;:null,&quot;parent_id&quot;:null,&quot;order&quot;:2,&quot;created_at&quot;:&quot;2022-02-11T08:15:18.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-02-11T08:15:18.000000Z&quot;,&quot;route&quot;:&quot;voyager.roles.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/roles&quot;,&quot;children&quot;:[]},{&quot;id&quot;:3,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;Users&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-person&quot;,&quot;color&quot;:null,&quot;parent_id&quot;:null,&quot;order&quot;:3,&quot;created_at&quot;:&quot;2022-02-11T08:15:18.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-02-11T08:15:18.000000Z&quot;,&quot;route&quot;:&quot;voyager.users.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/users&quot;,&quot;children&quot;:[]},{&quot;id&quot;:2,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;Media&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-images&quot;,&quot;color&quot;:null,&quot;parent_id&quot;:null,&quot;order&quot;:4,&quot;created_at&quot;:&quot;2022-02-11T08:15:18.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-02-15T12:44:26.000000Z&quot;,&quot;route&quot;:&quot;voyager.media.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/media&quot;,&quot;children&quot;:[]},{&quot;id&quot;:5,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;Tools&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-tools&quot;,&quot;color&quot;:null,&quot;parent_id&quot;:null,&quot;order&quot;:5,&quot;created_at&quot;:&quot;2022-02-11T08:15:19.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-02-15T12:44:26.000000Z&quot;,&quot;route&quot;:null,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000&quot;,&quot;active&quot;:false,&quot;children&quot;:[{&quot;id&quot;:6,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;Menu Builder&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-list&quot;,&quot;color&quot;:null,&quot;parent_id&quot;:5,&quot;order&quot;:1,&quot;created_at&quot;:&quot;2022-02-11T08:15:19.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-02-15T12:44:26.000000Z&quot;,&quot;route&quot;:&quot;voyager.menus.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/menus&quot;,&quot;children&quot;:[]},{&quot;id&quot;:7,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;Database&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-data&quot;,&quot;color&quot;:null,&quot;parent_id&quot;:5,&quot;order&quot;:2,&quot;created_at&quot;:&quot;2022-02-11T08:15:19.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-02-15T12:44:26.000000Z&quot;,&quot;route&quot;:&quot;voyager.database.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/database&quot;,&quot;children&quot;:[]},{&quot;id&quot;:8,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;Compass&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-compass&quot;,&quot;color&quot;:null,&quot;parent_id&quot;:5,&quot;order&quot;:3,&quot;created_at&quot;:&quot;2022-02-11T08:15:19.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-02-15T12:44:26.000000Z&quot;,&quot;route&quot;:&quot;voyager.compass.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/compass&quot;,&quot;children&quot;:[]},{&quot;id&quot;:9,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;BREAD&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-bread&quot;,&quot;color&quot;:null,&quot;parent_id&quot;:5,&quot;order&quot;:4,&quot;created_at&quot;:&quot;2022-02-11T08:15:19.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-02-15T12:44:26.000000Z&quot;,&quot;route&quot;:&quot;voyager.bread.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/bread&quot;,&quot;children&quot;:[]}]},{&quot;id&quot;:10,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;Settings&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-settings&quot;,&quot;color&quot;:null,&quot;parent_id&quot;:null,&quot;order&quot;:6,&quot;created_at&quot;:&quot;2022-02-11T08:15:19.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-02-15T12:44:26.000000Z&quot;,&quot;route&quot;:&quot;voyager.settings.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/settings&quot;,&quot;children&quot;:[]},{&quot;id&quot;:53,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0417\u0430\u043a\u0430\u0437\u044b&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-basket&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:7,&quot;created_at&quot;:&quot;2022-03-19T19:38:30.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-19T23:24:09.000000Z&quot;,&quot;route&quot;:&quot;voyager.carts.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/carts&quot;,&quot;children&quot;:[]},{&quot;id&quot;:11,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0438&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-categories&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:8,&quot;created_at&quot;:&quot;2022-02-15T10:37:12.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-19T23:24:07.000000Z&quot;,&quot;route&quot;:&quot;voyager.categories.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/categories&quot;,&quot;children&quot;:[]},{&quot;id&quot;:12,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041f\u043e\u0434\u043a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0438&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-window-list&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:9,&quot;created_at&quot;:&quot;2022-02-15T10:38:14.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-19T23:24:07.000000Z&quot;,&quot;route&quot;:&quot;voyager.subcategories.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/subcategories&quot;,&quot;children&quot;:[]},{&quot;id&quot;:52,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0438 \u043a\u043e\u043c\u043f\u043b\u0435\u043a\u0442\u0443\u044e\u0449\u0438\u0435&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-tools&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:10,&quot;created_at&quot;:&quot;2022-03-18T19:57:04.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-19T23:24:07.000000Z&quot;,&quot;route&quot;:&quot;voyager.complete-categories.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/complete-categories&quot;,&quot;children&quot;:[]},{&quot;id&quot;:13,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041f\u0440\u043e\u0434\u0443\u043a\u0442\u044b&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-bag&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:11,&quot;created_at&quot;:&quot;2022-02-15T12:00:43.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-19T23:24:07.000000Z&quot;,&quot;route&quot;:&quot;voyager.products.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/products&quot;,&quot;active&quot;:true,&quot;children&quot;:[]},{&quot;id&quot;:24,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0421\u043a\u0438\u0434\u043a\u0438&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-megaphone&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:12,&quot;created_at&quot;:&quot;2022-02-16T13:55:28.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-19T23:24:07.000000Z&quot;,&quot;route&quot;:&quot;voyager.sales.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/sales&quot;,&quot;children&quot;:[]},{&quot;id&quot;:29,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0421\u0435\u0440\u0442\u0438\u0444\u0438\u043a\u0430\u0442\u044b&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-documentation&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:13,&quot;created_at&quot;:&quot;2022-03-04T11:13:08.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-19T23:24:07.000000Z&quot;,&quot;route&quot;:&quot;voyager.certificates.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/certificates&quot;,&quot;children&quot;:[]},{&quot;id&quot;:33,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041e\u0442\u0437\u044b\u0432\u044b&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-edit&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:14,&quot;created_at&quot;:&quot;2022-03-04T13:05:01.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T18:53:53.000000Z&quot;,&quot;route&quot;:&quot;voyager.reviews.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/reviews&quot;,&quot;children&quot;:[]},{&quot;id&quot;:28,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0424\u0438\u043b\u044c\u0442\u0440\u044b&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-diamond&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:15,&quot;created_at&quot;:&quot;2022-03-03T14:51:34.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T18:53:53.000000Z&quot;,&quot;route&quot;:null,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000&quot;,&quot;active&quot;:false,&quot;children&quot;:[{&quot;id&quot;:26,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0438&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:null,&quot;parent_id&quot;:28,&quot;order&quot;:1,&quot;created_at&quot;:&quot;2022-03-03T14:45:37.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-03T14:51:39.000000Z&quot;,&quot;route&quot;:&quot;voyager.filter-categories.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/filter-categories&quot;,&quot;children&quot;:[]},{&quot;id&quot;:27,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u042d\u043b\u0435\u043c\u0435\u043d\u0442\u044b&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:null,&quot;parent_id&quot;:28,&quot;order&quot;:2,&quot;created_at&quot;:&quot;2022-03-03T14:46:06.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-03T14:51:39.000000Z&quot;,&quot;route&quot;:&quot;voyager.filter-elements.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/filter-elements&quot;,&quot;children&quot;:[]}]},{&quot;id&quot;:22,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041f\u043e\u043b\u044c\u0437\u043e\u0432\u0430\u0442\u0435\u043b\u0438&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-group&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:16,&quot;created_at&quot;:&quot;2022-02-15T13:55:06.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T18:53:53.000000Z&quot;,&quot;route&quot;:null,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000&quot;,&quot;active&quot;:false,&quot;children&quot;:[{&quot;id&quot;:23,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041f\u043e\u043b\u044c\u0437\u043e\u0432\u0430\u0442\u0435\u043b\u0438&quot;,&quot;url&quot;:&quot;\/admin\/users&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:22,&quot;order&quot;:1,&quot;created_at&quot;:&quot;2022-02-15T13:56:01.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-02-15T13:56:05.000000Z&quot;,&quot;route&quot;:null,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/users&quot;,&quot;children&quot;:[]},{&quot;id&quot;:50,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0424\u043e\u0440\u043c\u0430 \u0441\u0432\u044f\u0437\u0438&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:22,&quot;order&quot;:2,&quot;created_at&quot;:&quot;2022-03-18T00:20:05.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T18:53:10.000000Z&quot;,&quot;route&quot;:&quot;voyager.contact-feedback.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/contact-feedback&quot;,&quot;children&quot;:[]},{&quot;id&quot;:20,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0412\u0430\u043a\u0430\u043d\u0441\u0438\u0438&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:null,&quot;parent_id&quot;:22,&quot;order&quot;:3,&quot;created_at&quot;:&quot;2022-02-15T13:54:19.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T18:53:10.000000Z&quot;,&quot;route&quot;:&quot;voyager.vacancies.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/vacancies&quot;,&quot;children&quot;:[]},{&quot;id&quot;:49,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041a\u043e\u043d\u0442\u0430\u043a\u0442\u044b&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:22,&quot;order&quot;:4,&quot;created_at&quot;:&quot;2022-03-18T00:19:57.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T18:53:10.000000Z&quot;,&quot;route&quot;:&quot;voyager.contact-infos.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/contact-infos&quot;,&quot;children&quot;:[]},{&quot;id&quot;:62,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0420\u0430\u0441\u0441\u044b\u043b\u043a\u0430&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-file-text&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:22,&quot;order&quot;:5,&quot;created_at&quot;:&quot;2022-03-21T18:42:49.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T18:53:53.000000Z&quot;,&quot;route&quot;:&quot;voyager.subscriptions.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/subscriptions&quot;,&quot;children&quot;:[]}]},{&quot;id&quot;:19,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041a\u043e\u043d\u0441\u0442\u0440\u0443\u043a\u0442\u043e\u0440\u044b&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-hammer&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:17,&quot;created_at&quot;:&quot;2022-02-15T12:44:22.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T18:52:42.000000Z&quot;,&quot;route&quot;:null,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000&quot;,&quot;active&quot;:false,&quot;children&quot;:[{&quot;id&quot;:15,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041a\u043e\u043d\u0441\u0442\u0440\u0443\u043a\u0442\u043e\u0440\u044b&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:null,&quot;parent_id&quot;:19,&quot;order&quot;:1,&quot;created_at&quot;:&quot;2022-02-15T12:40:14.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-02-15T12:44:28.000000Z&quot;,&quot;route&quot;:&quot;voyager.constructors.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/constructors&quot;,&quot;children&quot;:[]},{&quot;id&quot;:16,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041a\u0430\u0442\u0435\u0433\u043e\u0440\u0438\u0438&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:null,&quot;parent_id&quot;:19,&quot;order&quot;:2,&quot;created_at&quot;:&quot;2022-02-15T12:40:49.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-02-15T12:44:29.000000Z&quot;,&quot;route&quot;:&quot;voyager.constructor-categories.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/constructor-categories&quot;,&quot;children&quot;:[]},{&quot;id&quot;:17,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0422\u0438\u043f\u044b&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:null,&quot;parent_id&quot;:19,&quot;order&quot;:3,&quot;created_at&quot;:&quot;2022-02-15T12:42:22.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-02-15T12:44:30.000000Z&quot;,&quot;route&quot;:&quot;voyager.constructor-types.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/constructor-types&quot;,&quot;children&quot;:[]},{&quot;id&quot;:18,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u042d\u043b\u0435\u043c\u0435\u043d\u0442\u044b&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:null,&quot;parent_id&quot;:19,&quot;order&quot;:4,&quot;created_at&quot;:&quot;2022-02-15T12:43:52.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-02-15T12:44:31.000000Z&quot;,&quot;route&quot;:&quot;voyager.constructor-elements.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/constructor-elements&quot;,&quot;children&quot;:[]}]},{&quot;id&quot;:61,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0417\u0430\u043a\u0430\u0437 \u0432 \u043e\u0434\u0438\u043d \u043a\u043b\u0438\u043a&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-file-text&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:18,&quot;created_at&quot;:&quot;2022-03-21T18:42:31.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T18:52:42.000000Z&quot;,&quot;route&quot;:&quot;voyager.order-callbacks.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/order-callbacks&quot;,&quot;children&quot;:[]},{&quot;id&quot;:32,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0413\u043e\u0440\u043e\u0434\u0430&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-world&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:19,&quot;created_at&quot;:&quot;2022-03-04T12:41:07.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T18:52:42.000000Z&quot;,&quot;route&quot;:null,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000&quot;,&quot;active&quot;:false,&quot;children&quot;:[{&quot;id&quot;:30,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0413\u043e\u0440\u043e\u0434\u0430&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:null,&quot;parent_id&quot;:32,&quot;order&quot;:1,&quot;created_at&quot;:&quot;2022-03-04T12:39:44.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-04T12:41:14.000000Z&quot;,&quot;route&quot;:&quot;voyager.cities.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/cities&quot;,&quot;children&quot;:[]},{&quot;id&quot;:31,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0424\u0438\u043b\u0438\u0430\u043b\u044b&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:null,&quot;parent_id&quot;:32,&quot;order&quot;:2,&quot;created_at&quot;:&quot;2022-03-04T12:40:20.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-04T12:41:14.000000Z&quot;,&quot;route&quot;:&quot;voyager.fillials.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/fillials&quot;,&quot;children&quot;:[]}]},{&quot;id&quot;:64,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041d\u0430\u0441\u0442\u0440\u043e\u0439\u043a\u0438&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-tools&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:20,&quot;created_at&quot;:&quot;2022-03-21T18:47:15.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-04-07T16:59:18.000000Z&quot;,&quot;route&quot;:null,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000&quot;,&quot;active&quot;:false,&quot;children&quot;:[{&quot;id&quot;:54,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0421\u0442\u0430\u0442\u0443\u0441\u044b \u0437\u0430\u043a\u0430\u0437\u0430&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:64,&quot;order&quot;:1,&quot;created_at&quot;:&quot;2022-03-19T21:34:23.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T18:53:19.000000Z&quot;,&quot;route&quot;:&quot;voyager.statuses.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/statuses&quot;,&quot;children&quot;:[]},{&quot;id&quot;:60,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0426\u0435\u043d\u0430 \u0437\u0430 \u0434\u043e\u0441\u0442\u0430\u0432\u043a\u0443&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-truck&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:64,&quot;order&quot;:2,&quot;created_at&quot;:&quot;2022-03-21T18:41:42.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T18:53:19.000000Z&quot;,&quot;route&quot;:&quot;voyager.delivery-prices.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/delivery-prices&quot;,&quot;children&quot;:[]},{&quot;id&quot;:55,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0411\u043e\u043d\u0443\u0441\u043d\u0430\u044f \u043f\u0440\u043e\u0446\u0435\u043d\u0442\u043d\u0430\u044f \u0441\u0442\u0430\u0432\u043a\u0430&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:64,&quot;order&quot;:3,&quot;created_at&quot;:&quot;2022-03-21T14:17:32.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T18:53:19.000000Z&quot;,&quot;route&quot;:&quot;voyager.percent-bonuses.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/percent-bonuses&quot;,&quot;children&quot;:[]}]},{&quot;id&quot;:47,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0421\u0442\u0440\u0430\u043d\u0438\u0446\u044b&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-folder&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:21,&quot;created_at&quot;:&quot;2022-03-17T22:42:52.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-04-07T16:59:18.000000Z&quot;,&quot;route&quot;:null,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000&quot;,&quot;active&quot;:false,&quot;children&quot;:[{&quot;id&quot;:45,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0418\u0441\u0442\u043e\u0440\u0438\u044f \u0438 \u043c\u0438\u0441\u0441\u0438\u044f&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:47,&quot;order&quot;:1,&quot;created_at&quot;:&quot;2022-03-17T22:40:57.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-17T22:44:48.000000Z&quot;,&quot;route&quot;:&quot;voyager.history-missions.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/history-missions&quot;,&quot;children&quot;:[]},{&quot;id&quot;:46,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0421\u043e\u0446\u0438\u0430\u043b\u044c\u043d\u0430\u044f \u043c\u0438\u0441\u0441\u0438\u044f&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:47,&quot;order&quot;:2,&quot;created_at&quot;:&quot;2022-03-17T22:42:24.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-17T22:45:03.000000Z&quot;,&quot;route&quot;:&quot;voyager.social-missions.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/social-missions&quot;,&quot;children&quot;:[]},{&quot;id&quot;:36,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0418\u043d\u0444\u043e\u0440\u043c\u0430\u0446\u0438\u044f \u043e \u0431\u0440\u0435\u043d\u0434\u0435&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:47,&quot;order&quot;:3,&quot;created_at&quot;:&quot;2022-03-17T22:37:37.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-17T22:45:22.000000Z&quot;,&quot;route&quot;:&quot;voyager.brand-information.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/brand-information&quot;,&quot;children&quot;:[]},{&quot;id&quot;:48,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0418\u043d\u0444\u043e\u0440\u043c\u0430\u0446\u0438\u044f \u043e \u043f\u0440\u043e\u0434\u0443\u043a\u0446\u0438\u0438&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:47,&quot;order&quot;:4,&quot;created_at&quot;:&quot;2022-03-17T22:46:37.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-17T22:47:19.000000Z&quot;,&quot;route&quot;:&quot;voyager.product-information.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/product-information&quot;,&quot;children&quot;:[]},{&quot;id&quot;:35,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0412\u0441\u0435 \u043e \u043f\u0440\u043e\u0434\u0443\u043a\u0446\u0438\u0438&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:47,&quot;order&quot;:5,&quot;created_at&quot;:&quot;2022-03-17T22:37:13.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-17T22:47:40.000000Z&quot;,&quot;route&quot;:&quot;voyager.all-about-products.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/all-about-products&quot;,&quot;children&quot;:[]},{&quot;id&quot;:41,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0418\u0441\u0441\u043b\u0435\u0434\u043e\u0432\u0430\u043d\u0438\u044f \u0438 \u0438\u043d\u043d\u043e\u0432\u0430\u0446\u0438\u0438 \u043a\u043e\u043c\u043f\u0430\u043d\u0438\u0438&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:47,&quot;order&quot;:6,&quot;created_at&quot;:&quot;2022-03-17T22:38:50.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-17T22:48:45.000000Z&quot;,&quot;route&quot;:&quot;voyager.research-innovations.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/research-innovations&quot;,&quot;children&quot;:[]},{&quot;id&quot;:44,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0414\u043e\u0441\u0442\u0430\u0432\u043a\u0430 \u0438 \u043e\u043f\u043b\u0430\u0442\u0430&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:47,&quot;order&quot;:7,&quot;created_at&quot;:&quot;2022-03-17T22:39:10.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-17T22:49:13.000000Z&quot;,&quot;route&quot;:&quot;voyager.shipping-payments.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/shipping-payments&quot;,&quot;children&quot;:[]},{&quot;id&quot;:42,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0412\u043e\u0437\u0432\u0440\u0430\u0442&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:47,&quot;order&quot;:8,&quot;created_at&quot;:&quot;2022-03-17T22:38:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-17T22:49:30.000000Z&quot;,&quot;route&quot;:&quot;voyager.return-information.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/return-information&quot;,&quot;children&quot;:[]},{&quot;id&quot;:40,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0421\u0438\u0441\u0442\u0435\u043c\u0430 \u043b\u043e\u044f\u043b\u044c\u043d\u043e\u0441\u0442\u0438&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:47,&quot;order&quot;:9,&quot;created_at&quot;:&quot;2022-03-17T22:38:45.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-17T22:50:45.000000Z&quot;,&quot;route&quot;:&quot;voyager.loyalty-systems.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/loyalty-systems&quot;,&quot;children&quot;:[]},{&quot;id&quot;:37,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0418\u043d\u0444\u043e\u0440\u043c\u0430\u0446\u0438\u044f \u043a\u043e\u0440\u043f\u043e\u0440\u0430\u0442\u0438\u0432\u043d\u044b\u043c \u043a\u043b\u0438\u0435\u043d\u0442\u0430\u043c&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:47,&quot;order&quot;:10,&quot;created_at&quot;:&quot;2022-03-17T22:38:23.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-17T22:51:12.000000Z&quot;,&quot;route&quot;:&quot;voyager.corporate-information.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/corporate-information&quot;,&quot;children&quot;:[]},{&quot;id&quot;:38,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041f\u0440\u0430\u0432\u0438\u043b\u0430 \u0438\u0441\u043f\u043e\u043b\u044c\u0437\u043e\u0432\u0430\u043d\u0438\u044f \u043f\u043e\u0434\u0430\u0440\u043e\u0447\u043d\u044b\u0445 \u0441\u0435\u0440\u0442\u0438\u0444\u0438\u043a\u0430\u0442\u043e\u0432&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:47,&quot;order&quot;:11,&quot;created_at&quot;:&quot;2022-03-17T22:38:31.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-17T22:51:24.000000Z&quot;,&quot;route&quot;:&quot;voyager.gift-rules.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/gift-rules&quot;,&quot;children&quot;:[]},{&quot;id&quot;:39,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0413\u0430\u0440\u0430\u043d\u0442\u0438\u044f&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:47,&quot;order&quot;:12,&quot;created_at&quot;:&quot;2022-03-17T22:38:36.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-17T22:51:40.000000Z&quot;,&quot;route&quot;:&quot;voyager.guarantees.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/guarantees&quot;,&quot;children&quot;:[]},{&quot;id&quot;:43,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041f\u0440\u0430\u0432\u0438\u043b\u0430 \u044d\u043a\u0441\u043f\u043b\u0443\u0430\u0442\u0430\u0446\u0438\u0438 \u043f\u0440\u043e\u0434\u0443\u043a\u0446\u0438\u0438&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:47,&quot;order&quot;:13,&quot;created_at&quot;:&quot;2022-03-17T22:39:02.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-17T22:51:50.000000Z&quot;,&quot;route&quot;:&quot;voyager.rule-operations.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/rule-operations&quot;,&quot;children&quot;:[]},{&quot;id&quot;:56,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041f\u0430\u0440\u0442\u043d\u0435\u0440\u0441\u043a\u0438\u0435 \u043c\u0430\u0433\u0430\u0437\u0438\u043d\u044b&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:47,&quot;order&quot;:14,&quot;created_at&quot;:&quot;2022-03-21T15:27:47.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T16:49:15.000000Z&quot;,&quot;route&quot;:&quot;voyager.affiliate-stores.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/affiliate-stores&quot;,&quot;children&quot;:[]},{&quot;id&quot;:58,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u041c\u0430\u0433\u0430\u0437\u0438\u043d\u044b \u0432 \u041a\u0430\u0437\u0430\u0445\u0441\u0442\u0430\u043d\u0435&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:47,&quot;order&quot;:15,&quot;created_at&quot;:&quot;2022-03-21T15:28:31.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T16:49:50.000000Z&quot;,&quot;route&quot;:&quot;voyager.stores-kazakhstans.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/stores-kazakhstans&quot;,&quot;children&quot;:[]},{&quot;id&quot;:57,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;Mobile Shopping Stores&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:47,&quot;order&quot;:16,&quot;created_at&quot;:&quot;2022-03-21T15:28:07.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T16:49:52.000000Z&quot;,&quot;route&quot;:&quot;voyager.mobile-shopping-stores.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/mobile-shopping-stores&quot;,&quot;children&quot;:[]},{&quot;id&quot;:59,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;Mobile Shopping Contents&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:null,&quot;parent_id&quot;:47,&quot;order&quot;:17,&quot;created_at&quot;:&quot;2022-03-21T16:47:56.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-21T16:49:55.000000Z&quot;,&quot;route&quot;:&quot;voyager.mobile-shopping-contents.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/mobile-shopping-contents&quot;,&quot;children&quot;:[]}]},{&quot;id&quot;:34,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0418\u043c\u043f\u043e\u0440\u0442 \u0441 Excel&quot;,&quot;url&quot;:&quot;\/admin\/excel-import&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-list-add&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:22,&quot;created_at&quot;:&quot;2022-03-09T19:09:39.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-04-25T16:30:18.000000Z&quot;,&quot;route&quot;:null,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/excel-import&quot;,&quot;children&quot;:[]},{&quot;id&quot;:69,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;Seo&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:&quot;voyager-bar-chart&quot;,&quot;color&quot;:&quot;#000000&quot;,&quot;parent_id&quot;:null,&quot;order&quot;:23,&quot;created_at&quot;:&quot;2022-05-09T14:10:23.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-05-09T14:55:01.000000Z&quot;,&quot;route&quot;:&quot;voyager.seos.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/seos&quot;,&quot;children&quot;:[]},{&quot;id&quot;:70,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0410\u043a\u0446\u0438\u0438&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:null,&quot;parent_id&quot;:null,&quot;order&quot;:24,&quot;created_at&quot;:&quot;2022-05-09T17:27:40.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-05-09T17:27:40.000000Z&quot;,&quot;route&quot;:&quot;voyager.new-sales.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/new-sales&quot;,&quot;children&quot;:[]},{&quot;id&quot;:71,&quot;menu_id&quot;:1,&quot;title&quot;:&quot;\u0418\u043d\u0441\u0442\u0440\u0443\u043a\u0446\u0438\u0438 \u043f\u043e \u044d\u043a\u0441\u043f\u043b\u0443\u0430\u0442\u0430\u0446\u0438\u0438&quot;,&quot;url&quot;:&quot;&quot;,&quot;target&quot;:&quot;_self&quot;,&quot;icon_class&quot;:null,&quot;color&quot;:null,&quot;parent_id&quot;:null,&quot;order&quot;:25,&quot;created_at&quot;:&quot;2022-05-09T18:07:36.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-05-09T18:07:36.000000Z&quot;,&quot;route&quot;:&quot;voyager.exploitation-articles.index&quot;,&quot;parameters&quot;:null,&quot;href&quot;:&quot;http:\/\/127.0.0.1:8000\/admin\/exploitation-articles&quot;,&quot;children&quot;:[]}]"></admin-menu>
                    </div>
                </nav>
            </div>
            <script>
                (function(){
                    var appContainer = document.querySelector('.app-container'),
                        sidebar = appContainer.querySelector('.side-menu'),
                        navbar = appContainer.querySelector('nav.navbar.navbar-top'),
                        loader = document.getElementById('voyager-loader'),
                        hamburgerMenu = document.querySelector('.hamburger'),
                        sidebarTransition = sidebar.style.transition,
                        navbarTransition = navbar.style.transition,
                        containerTransition = appContainer.style.transition;

                    sidebar.style.WebkitTransition = sidebar.style.MozTransition = sidebar.style.transition =
                        appContainer.style.WebkitTransition = appContainer.style.MozTransition = appContainer.style.transition =
                            navbar.style.WebkitTransition = navbar.style.MozTransition = navbar.style.transition = 'none';

                    if (window.innerWidth > 768 && window.localStorage && window.localStorage['voyager.stickySidebar'] == 'true') {
                        appContainer.className += ' expanded no-animation';
                        loader.style.left = (sidebar.clientWidth/2)+'px';
                        hamburgerMenu.className += ' is-active no-animation';
                    }

                    navbar.style.WebkitTransition = navbar.style.MozTransition = navbar.style.transition = navbarTransition;
                    sidebar.style.WebkitTransition = sidebar.style.MozTransition = sidebar.style.transition = sidebarTransition;
                    appContainer.style.WebkitTransition = appContainer.style.MozTransition = appContainer.style.transition = containerTransition;
                })();
            </script>
            <!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body padding-top">
                    <h1 class="page-title">
                        <i class=""></i>
                        Изменить Продукт
                    </h1>
                    <div id="voyager-notifications"></div>
                    <div class="page-content edit-add container-fluid">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="panel panel-bordered">
                                    <!-- form start -->
                                    <form role="form"
                                          class="form-edit-add"
                                          action="http://127.0.0.1:8000/admin/products/1134"
                                          method="POST" enctype="multipart/form-data">
                                        <!-- PUT Method if we are editing -->
                                        <input type="hidden" name="_method" value="PUT">

                                        <!-- CSRF TOKEN -->
                                        @csrf

                                        <div class="panel-body">


                                            <!-- Adding / Editing -->

                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Is Constructor</label>
                                                <br>



                                                <input type="checkbox" name="is_constructor" class="toggleswitch"
                                                       checked >

                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->
                                            <?php
                                            $subcategoryIds = \App\Models\SubcategoriesProduct::query()->where('product_id', $dataTypeContent->id)->pluck('subcategory_id')->toArray();
                                            $subcategories = \App\Models\Subcategory::query()->whereIn('id', $subcategoryIds)->get();

                                            $complete = \App\Models\CompleteCategory::query()->where('id', $dataTypeContent->complete_id)->first();

                                            $image = json_decode($dataTypeContent->image, true)
                                            ?>

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Подкатегории</label>
                                                <select
                                                    class="form-control select2-ajax "
                                                    name="product_belongstomany_subcategory_relationship[]" multiple
                                                    data-get-items-route="http://127.0.0.1:8000/admin/products/relation"
                                                    data-get-items-field="product_belongstomany_subcategory_relationship"
                                                    data-id="{{$dataTypeContent->id}}"
                                                    data-method="edit"
                                                >

                                                    <option value="">Отсутствует</option>
                                                    @foreach($subcategories as $subcategory)
                                                        <option value="{{$subcategory->id}}" selected="selected">
                                                            {{$subcategory->title}}
                                                        </option>

                                                    @endforeach
                                                </select>




                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->
                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Категории комплектаций</label>
                                                <select
                                                    class="form-control select2-ajax" name="complete_id"
                                                    data-get-items-route= {{ env('APP_URL') . "/admin/products/relation"}}
                                                    data-get-items-field="product_belongsto_complete_category_relationship"
                                                    data-id="{{$dataTypeContent->id}}"
                                                    data-method="edit"
                                                >


                                                    <option value="{{$complete->id}}}"  selected="selected" >{{$complete->title}}</option>
                                                </select>





                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Название</label>
                                                <input  required  type="text" class="form-control" name="title"
                                                        placeholder="Название"

                                                        value="{{$dataTypeContent->title}}">


                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Код</label>
                                                <input  required  type="text" class="form-control" name="code"
                                                        placeholder="Код"

                                                        value="{{$dataTypeContent->code}}">


                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Цена</label>
                                                <input type="number"
                                                       class="form-control"
                                                       name="price"
                                                       type="number"
                                                       required                      step="any"
                                                       placeholder="Цена"
                                                       value="{{$dataTypeContent->price}}">


                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Пометка</label>
                                                <input  type="text" class="form-control" name="badge"
                                                        placeholder="Пометка"

                                                        value="{{$dataTypeContent->badge}}">


                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Цена со скидкой</label>
                                                <input type="number"
                                                       class="form-control"
                                                       name="new_price"
                                                       type="number"
                                                       step="any"
                                                       placeholder="Цена со скидкой"
                                                       value="{{$dataTypeContent->new_price}}">

                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">В наличии</label>
                                                <br>


                                                <input type="checkbox" name="available" class="toggleswitch"
                                                       checked >


                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Характеристики</label>
                                                <textarea class="form-control richTextBox" name="characteristics" id="richtextcharacteristics">
                                                    {{$dataTypeContent->characteristics}}
</textarea>



                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Описание</label>
                                                <textarea class="form-control richTextBox" name="description" id="richtextdescription">
                                                    {{$dataTypeContent->description}}
                                                </textarea>



                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Изображение</label>
                                                <br>

                                                @foreach($image as $item)
                                                <div class="img_settings_container" data-field-name="image" style="float:left;padding-right:15px;">
                                                    <a href="#" class="voyager-x remove-multi-image" style="position: absolute;"></a>
                                                    <img src="{{env('APP_URL') . '/storage/' . $item}}"
                                                         data-file-name="{{env('APP_URL') . '/storage/' . $item}}"
                                                    data-id="{{$dataTypeContent->id}}" style="max-width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:5px;">
                                                </div>
                                                @endforeach
                                                <div class="clearfix"></div>
                                                <input  type="file" name="image[]" multiple="multiple" accept="image/*">


                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Видео</label>
                                                <input  type="text" class="form-control" name="video"
                                                        placeholder="Видео"

                                                        value="https://youtu.be/74J20_Sfeck">


                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Скидки</label>
                                                <select
                                                    class="form-control select2-ajax  taggable "
                                                    name="product_belongstomany_sale_relationship[]" multiple
                                                    data-get-items-route="http://127.0.0.1:8000/admin/products/relation"
                                                    data-get-items-field="product_belongstomany_sale_relationship"
                                                    data-id="1121"                     data-method="edit"
                                                    data-route="http://127.0.0.1:8000/admin/sales"
                                                    data-label="title"
                                                    data-error-message="Похоже, что возникла проблема с созданием записи. Убедитесь, что таблица имеет значения по умолчанию для других полей."
                                                >


                                                    <option value="">Отсутствует</option>


                                                </select>





                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Остаток</label>
                                                <input  required  type="text" class="form-control" name="remainder"
                                                        placeholder="Остаток"

                                                        value="0">


                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Фильтры</label>
                                                <select
                                                    class="form-control select2-ajax  taggable "
                                                    name="product_belongstomany_filter_element_relationship[]" multiple
                                                    data-get-items-route="http://127.0.0.1:8000/admin/products/relation"
                                                    data-get-items-field="product_belongstomany_filter_element_relationship"
                                                    data-id="1121"                     data-method="edit"
                                                    data-route="http://127.0.0.1:8000/admin/filter-elements"
                                                    data-label="title"
                                                    data-error-message="Похоже, что возникла проблема с созданием записи. Убедитесь, что таблица имеет значения по умолчанию для других полей."
                                                >


                                                    <option value="">Отсутствует</option>

                                                    <option value="2" selected="selected">черный</option>
                                                    <option value="22" selected="selected">Италия</option>
                                                    <option value="122" selected="selected">металл</option>
                                                    <option value="178" selected="selected">Диаметр - 32 мм</option>

                                                </select>





                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Constructor Id</label>
                                                <input  type="text" class="form-control" name="constructor_id"
                                                        placeholder="Constructor Id"

                                                        value="8">


                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Комплектующие продукта</label>
                                                <select
                                                    class="form-control select2-ajax "
                                                    name="product_belongstomany_constructor_category_relationship[]" multiple
                                                    data-get-items-route="http://127.0.0.1:8000/admin/products/relation"
                                                    data-get-items-field="product_belongstomany_constructor_category_relationship"
                                                    data-id="1121"                     data-method="edit"
                                                >


                                                    <option value="">Отсутствует</option>


                                                </select>





                                            </div>
                                            <!-- GET THE DISPLAY OPTIONS -->

                                            <div class="form-group  col-md-12 " >

                                                <label class="control-label" for="name">Картинки для конструктора</label>
                                                <br>
                                                <div class="clearfix"></div>
                                                <input  type="file" name="constructor_image[]" multiple="multiple" accept="image/*">


                                            </div>

                                        </div><!-- panel-body -->

                                        <div class="panel-footer">
                                            <button type="submit" class="btn btn-primary save">Сохранить</button>
                                        </div>
                                    </form>

                                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                                    <form id="my_form" action="http://127.0.0.1:8000/admin/upload" target="form_target" method="post"
                                          enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                                        <input name="image" id="upload_file" type="file"
                                               onchange="$('#my_form').submit();this.value='';">
                                        <input type="hidden" name="type_slug" id="type_slug" value="products">
                                        <input type="hidden" name="_token" value="lMP0F7VhBPzb8toNZFtadDle0GgsyngkOJDzWjLQ">
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade modal-danger" id="confirm_delete_modal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i class="voyager-warning"></i> Вы уверены</h4>
                                </div>

                                <div class="modal-body">
                                    <h4>Вы точно хотите удалить '<span class="confirm_delete_name"></span>'</h4>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                    <button type="button" class="btn btn-danger" id="confirm_delete">Да, удалить!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Delete File Modal -->
                </div>
            </div>
        </div>
    </div>
    <footer class="app-footer">
        <div class="site-footer-right">
            Сделано с <i class="voyager-heart"></i>  <a href="http://thecontrolgroup.com" target="_blank">The Control Group</a>
            - v1.5.2
        </div>
    </footer>

    <!-- Javascript Libs -->


    <script type="text/javascript" src="http://127.0.0.1:8000/admin/voyager-assets?path=js%2Fapp.js"></script>

    <script>

    </script>
    <script>
        Vue.component('media-manager', {
            template: `<div>
    <div v-if="hidden_element" :id="'dd_'+this._uid" class="dd">
        <ol id="files" class="dd-list">
            <li v-for="file in getSelectedFiles()" class="dd-item" :data-url="file">
                <div class="file_link selected" aria-hidden="true" data-toggle="tooltip" data-placement="auto" :title="file">
                    <div class="link_icon">
                        <template v-if="fileIs(file, 'image')">
                            <div class="img_icon" :style="imgIcon('http://127.0.0.1:8000/storage/'+file)"></div>
                        </template>
                        <template v-else-if="fileIs(file, 'video')">
                            <i class="icon voyager-video"></i>
                        </template>
                        <template v-else-if="fileIs(file, 'audio')">
                            <i class="icon voyager-music"></i>
                        </template>
                        <template v-else-if="fileIs(file, 'zip')">
                            <i class="icon voyager-archive"></i>
                        </template>
                        <template v-else-if="fileIs(file, 'folder')">
                            <i class="icon voyager-folder"></i>
                        </template>
                        <template v-else>
                            <i class="icon voyager-file-text"></i>
                        </template>
                    </div>
                    <div class="details">
                        <div class="folder">
                            {{--<h4>{{ getFileName(file) }}</h4>--}}
                        </div>
                    </div>
                    <i class="voyager-x dd-nodrag" v-on:click="removeFileFromInput(file)"></i>
                </div>
            </li>
        </ol>
    </div>
    <div v-if="hidden_element">
        <div class="btn btn-sm btn-default" v-on:click="isExpanded = !isExpanded;" style="width:100%">
            <div v-if="!isExpanded"><i class="voyager-double-down"></i> Открыть</div>
            <div v-if="isExpanded"><i class="voyager-double-up"></i> Закрыть</div>
        </div>
    </div>
    <div id="toolbar" v-if="showToolbar" :style="isExpanded ? 'display:block' : 'display:none'">
        <div class="btn-group offset-right">
            <button type="button" class="btn btn-primary" id="upload" v-if="allowUpload">
                <i class="voyager-upload"></i>
                Загрузка
            </button>
            <button type="button" class="btn btn-primary" v-if="allowCreateFolder" data-toggle="modal" :data-target="'#create_dir_modal_'+this._uid">
                <i class="voyager-folder"></i>
                Создать папку
            </button>
        </div>
        <button type="button" class="btn btn-default" v-on:click="getFiles()">
            <i class="voyager-refresh"></i>
        </button>
        <div class="btn-group offset-right">
            <button type="button" :disabled="selected_files.length == 0" v-if="allowUpload && hidden_element" class="btn btn-default" v-on:click="addSelectedFiles()">
                <i class="voyager-upload"></i>
                Добавить все выбранные
            </button>
            <button type="button" v-if="showFolders && allowMove" class="btn btn-default" data-toggle="modal" :data-target="'#move_files_modal_'+this._uid">
                <i class="voyager-move"></i>
                Переместить
            </button>
            <button type="button" v-if="allowDelete" :disabled="selected_files.length == 0" class="btn btn-default" data-toggle="modal" :data-target="'#confirm_delete_modal_'+this._uid">
                <i class="voyager-trash"></i>
                Удалить
            </button>
            <button v-if="allowCrop" :disabled="selected_files.length != 1 || !fileIs(selected_file, 'image')" type="button" class="btn btn-default" data-toggle="modal" :data-target="'#crop_modal_'+this._uid">
                <i class="voyager-crop"></i>
                Обрезать
            </button>
        </div>
    </div>
    <div id="uploadPreview" style="display:none;" v-if="allowUpload"></div>
    <div id="uploadProgress" class="progress active progress-striped" v-if="allowUpload">
        <div class="progress-bar progress-bar-success" style="width: 0"></div>
    </div>
    <div id="content" :style="isExpanded ? 'display:block' : 'display:none'">
        <div class="breadcrumb-container">
            <ol class="breadcrumb filemanager">
                <li class="media_breadcrumb" v-on:click="setCurrentPath(-1)">
                    <span class="arrow"></span>
                    <strong>Библиотека медиа</strong>
                </li>
                <li v-for="(folder, i) in getCurrentPath()" v-on:click="setCurrentPath(i)">
                    <span class="arrow"></span>
{{--                    {{ folder }}--}}
                      </li>
                  </ol>
              </div>
              <div class="flex">
                  <div id="left">
                      <ul id="files">
                          <li v-for="(file) in files" v-on:click="selectFile(file, $event)" v-on:dblclick="openFile(file)" v-if="filter(file)">
                              <div :class="'file_link ' + (isFileSelected(file) ? 'selected' : '')">
                                  <div class="link_icon">
                                      <template v-if="fileIs(file, 'image')">
                                          <div class="img_icon" :style="imgIcon(file.path)"></div>
                                      </template>
                                      <template v-else-if="fileIs(file, 'video')">
                                          <i class="icon voyager-video"></i>
                                      </template>
                                      <template v-else-if="fileIs(file, 'audio')">
                                          <i class="icon voyager-music"></i>
                                      </template>
                                      <template v-else-if="fileIs(file, 'zip')">
                                          <i class="icon voyager-archive"></i>
                                      </template>
                                      <template v-else-if="fileIs(file, 'folder')">
                                          <i class="icon voyager-folder"></i>
                                      </template>
                                      <template v-else>
                                          <i class="icon voyager-file-text"></i>
                                      </template>
                                  </div>
                                  <div class="details">
                                      <div :class="file.type">
                                          {{--<h4>{{ file.name }}</h4>--}}
                                    <small v-if="!fileIs(file, 'folder')">
                                        {{--<span class="file_size">{{ bytesToSize(file.size) }}</span>--}}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div id="file_loader" v-if="is_loading">
                                                            <img src="http://127.0.0.1:8000/admin/voyager-assets?path=images%2Flogo-icon.png" alt="Voyager Loader">
                                        <p>ИДЕТ ЗАГРУЗКА ВАШИХ ФАЙЛОВ</p>
                </div>

                <div id="no_files" v-if="files.length == 0">
                    <h3><i class="voyager-meh"></i> Отсутствуют файлы в данной папке</h3>
                </div>
            </div>
            <div id="right">
                <div class="right_details">
                    <div v-if="selected_files.length > 1" class="right_none_selected">
                        <i class="voyager-list"></i>
                        {{--<p>{{ selected_files.length }} файлы/папка выбраны</p>--}}
                    </div>
                    <div v-else-if="selected_files.length == 1" class="right_details">
                        <div class="detail_img">
                            <div v-if="fileIs(selected_file, 'image')">
                                <img :src="selected_file.path" />
                            </div>
                            <div v-else-if="fileIs(selected_file, 'video')">
                                <video width="100%" height="auto" ref="videoplayer" controls>
                                    <source :src="selected_file.path" type="video/mp4">
                                    <source :src="selected_file.path" type="video/ogg">
                                    <source :src="selected_file.path" type="video/webm">
                                    Ваш браузер не поддерживает видео тег.
                                </video>
                            </div>
                            <div v-else-if="fileIs(selected_file, 'audio')">
                                <i class="voyager-music"></i>
                                <audio controls style="width:100%; margin-top:5px;" ref="audioplayer">
                                    <source :src="selected_file.path" type="audio/ogg">
                                    <source :src="selected_file.path" type="audio/mpeg">
                                    Ваш браузер не поддерживает аудио элементы.
                                </audio>
                            </div>
                            <div v-else-if="fileIs(selected_file, 'zip')">
                                <i class="voyager-archive"></i>
                            </div>
                            <div v-else-if="fileIs(selected_file, 'folder')">
                                <i class="voyager-folder"></i>
                            </div>
                            <div v-else>
                                <i class="voyager-file-text"></i>
                            </div>
                        </div>
                        <div class="detail_info">
                            <span>
                                <h4>Название:</h4>
                                <input v-if="allowRename" type="text" class="form-control" :value="selected_file.name" @keydown.enter.prevent="renameFile">
                                {{--<p v-else>{{ selected_file.name }}</p>--}}
                            </span>
                            <span>
                                <h4>Тип:</h4>
                                {{--<p>{{ selected_file.type }}</p>--}}
                            </span>

                            <template v-if="!fileIs(selected_file, 'folder')">
                                <span>
                                    <h4>Размер:</h4>
                                    {{--<p><span class="selected_file_size">{{ bytesToSize(selected_file.size) }}</span></p>--}}
                                </span>
                                <span>
                                    <h4>Публичная ссылка URL:</h4>
                                    <p><a :href="selected_file.path" target="_blank">Кликните тут</a></p>
                                </span>
                                <span>
                                    <h4>Последнее изменение:</h4>
                                    {{--<p>{{ dateFilter(selected_file.last_modified) }}</p>--}}
                                </span>
                            </template>

                            <span v-if="fileIs(selected_file, 'image') && selected_file.thumbnails.length > 0">
                                <h4>Thumbnails</h4><br>
                                <ul>
                                    <li v-for="thumbnail in selected_file.thumbnails">
                                        <a :href="thumbnail.path" target="_blank">
{{--                                            {{ thumbnail.thumb_name }}--}}
                      </a>
                  </li>
              </ul>
          </span>
      </div>
  </div>
  <div v-else class="right_none_selected">
      <i class="voyager-cursor"></i>
      <p>Ничего не выбрано</p>
  </div>
</div>
</div>
</div>
</div>

<!-- Image Modal -->
<div class="modal fade" :id="'imagemodal_'+this._uid" v-if="selected_file && fileIs(selected_file, 'image')">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
  <img :src="selected_file.path" class="img img-responsive" style="margin: 0 auto;">
</div>

<div class="modal-footer text-left">
  {{--<small class="image-title">{{ selected_file.name }}</small>--}}
                </div>

            </div>
        </div>
    </div>
    <!-- End Image Modal -->

    <!-- New Folder Modal -->
    <div class="modal fade modal-info" :id="'create_dir_modal_'+this._uid">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-folder"></i> Добавить новую папку</h4>
                </div>

                <div class="modal-body">
                    <input name="new_folder_name" placeholder="Новое имя папки" class="form-control" value="" v-model="modals.new_folder.name" />
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-info" v-on:click="createFolder">Создать новую папку
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End New Folder Modal -->

    <!-- Delete File Modal -->
    <div class="modal fade modal-danger" :id="'confirm_delete_modal_'+this._uid" v-if="allowDelete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> Вы уверены</h4>
                </div>

                <div class="modal-body">
                    <h4>Вы уверены, что хотите удалить эти файлы?</h4>
                    <ul>
                        {{--<li v-for="file in selected_files">{{ file.name }}</li>--}}
                    </ul>
                    <h5 class="folder_warning">
                        <i class="voyager-warning"></i> Удаление папки приведет к удалению всего ее содержимого.
                    </h5>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-danger" v-on:click="deleteFiles">Да, удалить!
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->

    <!-- Move Files Modal -->
    <div class="modal fade modal-warning" :id="'move_files_modal_'+this._uid" v-if="allowMove">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-move"></i> Переместить файл/папку</h4>
                </div>

                <div class="modal-body">
                    <h4>Папка назначения</h4>
                    <select class="form-control" v-model="modals.move_files.destination">
                        <option value="" disabled>Папка назначения</option>
                        <option v-if="current_folder != basePath && showFolders" value="/../">../</option>
                            {{--<option v-for="file in files" v-if="file.type == 'folder' && !selected_files.includes(file)" :value="current_folder+'/'+file.name">{{ file.name }}</option>--}}
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-warning" v-on:click="moveFiles">Переместить</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Move File Modal -->

    <!-- Crop Image Modal -->
    <div class="modal fade modal-warning" :id="'crop_modal_'+this._uid" v-if="allowCrop">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Обрезать изображение</h4>
                </div>

                <div class="modal-body">
                    <div class="crop-container">
                        <img :id="'cropping-image_'+this._uid" v-if="selected_files.length == 1 && fileIs(selected_file, 'image')" class="img img-responsive" :src="selected_file.path + '?' + selected_file.last_modified" />
                    </div>
                    <div class="new-image-info">
                        Ширина:  <span :id="'new-image-width_'+this._uid"></span>, Высота: <span :id="'new-image-height_'+this._uid"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-warning" v-on:click="crop(false)">Обрезать</button>
                    <button type="button" class="btn btn-warning" v-on:click="crop(true)">Создать и Обрезать</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Crop Image Modal -->
</div>
`,
            props: {
                basePath: {
                    type: String,
                    default: '/'
                },
                filename: {
                    type: String,
                    default: null
                },
                allowMultiSelect: {
                    type: Boolean,
                    default: true
                },
                maxSelectedFiles: {
                    type: Number,
                    default: 0
                },
                minSelectedFiles: {
                    type: Number,
                    default: 0
                },
                showFolders: {
                    type: Boolean,
                    default: true
                },
                showToolbar: {
                    type: Boolean,
                    default: true
                },
                allowUpload: {
                    type: Boolean,
                    default: true
                },
                allowMove: {
                    type: Boolean,
                    default: true
                },
                allowDelete: {
                    type: Boolean,
                    default: true
                },
                allowCreateFolder: {
                    type: Boolean,
                    default: true
                },
                allowRename: {
                    type: Boolean,
                    default: true
                },
                allowCrop: {
                    type: Boolean,
                    default: true
                },
                allowedTypes: {
                    type: Array,
                    default: function() {
                        return [];
                    }
                },
                preSelect: {
                    type: Boolean,
                    default: true,
                },
                element: {
                    type: String,
                    default: ""
                },
                details: {
                    type: Object,
                    default: function() {
                        return {};
                    }
                },
                expanded: {
                    type: Boolean,
                    default: true,
                },
            },
            data: function() {
                return {
                    current_folder: this.basePath,
                    selected_files: [],
                    files: [],
                    is_loading: true,
                    hidden_element: null,
                    isExpanded: this.expanded,
                    modals: {
                        new_folder: {
                            name: ''
                        },
                        move_files: {
                            destination: ''
                        }
                    }
                };
            },
            computed: {
                selected_file: function() {
                    return this.selected_files[0];
                }
            },
            methods: {
                getFiles: function() {
                    var vm = this;
                    vm.is_loading = true;
                    $.post('http://127.0.0.1:8000/admin/media/files', { folder: vm.current_folder, _token: 'lMP0F7VhBPzb8toNZFtadDle0GgsyngkOJDzWjLQ', details: vm.details }, function(data) {
                        vm.files = [];
                        for (var i = 0, file; file = data[i]; i++) {
                            if (vm.filter(file)) {
                                vm.files.push(file);
                            }
                        }
                        vm.selected_files = [];
                        if (vm.preSelect && data.length > 0) {
                            vm.selected_files.push(data[0]);
                        }
                        vm.is_loading = false;
                    });
                },
                selectFile: function(file, e) {
                    if ((!e.ctrlKey && !e.metaKey && !e.shiftKey) || !this.allowMultiSelect) {
                        this.selected_files = [];
                    }

                    if (e.shiftKey && this.allowMultiSelect && this.selected_files.length == 1) {
                        var index = null;
                        var start = 0;
                        for (var i = 0, cfile; cfile = this.files[i]; i++) {
                            if (cfile === this.selected_file) {
                                start = i;
                                break;
                            }
                        }

                        var end = 0;
                        for (var i = 0, cfile; cfile = this.files[i]; i++) {
                            if (cfile === file) {
                                end = i;
                                break;
                            }
                        }

                        for (var i = start; i < end; i++) {
                            index = this.selected_files.indexOf(this.files[i]);
                            if (index === -1) {
                                this.selected_files.push(this.files[i]);
                            }
                        }
                    }

                    index = this.selected_files.indexOf(file);
                    if (index === -1) {
                        this.selected_files.push(file);
                    }

                    if (this.selected_files.length == 1) {
                        var vm = this;
                        Vue.nextTick(function () {
                            if (vm.fileIs(vm.selected_file, 'video')) {
                                vm.$refs.videoplayer.load();
                            } else if (vm.fileIs(vm.selected_file, 'audio')) {
                                vm.$refs.audioplayer.load();
                            }
                        });
                    }
                },
                openFile: function(file) {
                    if (file.type == 'folder') {
                        this.current_folder += file.name+"/";
                        this.getFiles();
                    } else if (this.hidden_element) {
                        this.addFileToInput(file);
                    } else {
                        if (this.fileIs(this.selected_file, 'image')) {
                            $('#imagemodal_' + this._uid).modal('show');
                        } else {
                            // ...
                        }
                    }
                },
                isFileSelected: function(file) {
                    return this.selected_files.includes(file);
                },
                fileIs: function(file, type) {
                    if (typeof file === 'string') {
                        if (type == 'image') {
                            return this.endsWithAny(['jpg', 'jpeg', 'png', 'bmp'], file.toLowerCase());
                        }
                        //Todo: add other types
                    } else {
                        return file.type.includes(type);
                    }

                    return false;
                },
                getCurrentPath: function() {
                    var path = this.current_folder.replace(this.basePath, '').split('/').filter(function (el) {
                        return el != '';
                    });

                    return path;
                },
                setCurrentPath: function(i) {
                    if (i == -1) {
                        this.current_folder = this.basePath;
                    } else {
                        var path = this.getCurrentPath();
                        path.length = i + 1;
                        this.current_folder = this.basePath+path.join('/') + '/';
                    }

                    this.getFiles();
                },
                filter: function(file) {
                    if (this.allowedTypes.length > 0) {
                        if (file.type != 'folder') {
                            for (var i = 0, type; type = this.allowedTypes[i]; i++) {
                                if (file.type.includes(type)) {
                                    return true;
                                }
                            }
                        }
                    }

                    if (file.type == 'folder' && this.showFolders) {
                        return true;
                    } else if (file.type == 'folder' && !this.showFolders) {
                        return false;
                    }
                    if (this.allowedTypes.length == 0) {
                        return true;
                    }

                    return false;
                },
                addFileToInput: function(file) {
                    if (file.type != 'folder') {
                        if (!this.allowMultiSelect) {
                            this.hidden_element.value = file.relative_path;
                        } else {
                            var content = JSON.parse(this.hidden_element.value);
                            if (content.indexOf(file.relative_path) !== -1) {
                                return;
                            }
                            if (content.length >= this.maxSelectedFiles && this.maxSelectedFiles > 0) {
                                var msg_sing = "Вы может выбрать только один файл";
                                var msg_plur = "Вы может выбрать максимум 2 файлов";
                                if (this.maxSelectedFiles == 1) {
                                    toastr.error(msg_sing);
                                } else {
                                    toastr.error(msg_plur.replace('2', this.maxSelectedFiles));
                                }
                            } else {
                                content.push(file.relative_path);
                                this.hidden_element.value = JSON.stringify(content);
                            }
                        }
                        this.$forceUpdate();
                    }
                },
                removeFileFromInput: function(path) {
                    if (this.allowMultiSelect) {
                        var content = JSON.parse(this.hidden_element.value);
                        if (content.indexOf(path) !== -1) {
                            content.splice(content.indexOf(path), 1);
                            this.hidden_element.value = JSON.stringify(content);
                            this.$forceUpdate();
                        }
                    } else {
                        this.hidden_element.value = '';
                    }
                },
                getSelectedFiles: function() {
                    if (!this.allowMultiSelect) {
                        var content = [];
                        if (this.hidden_element.value != '') {
                            content.push(this.hidden_element.value);
                        }

                        return content;
                    } else {
                        return JSON.parse(this.hidden_element.value);
                    }
                },
                renameFile: function(object) {
                    var vm = this;
                    if (!this.allowRename || vm.selected_file.name == object.target.value) {
                        return;
                    }
                    $.post('http://127.0.0.1:8000/admin/media/rename_file', {
                        folder_location: vm.current_folder,
                        filename: vm.selected_file.name,
                        new_filename: object.target.value,
                        _token: 'lMP0F7VhBPzb8toNZFtadDle0GgsyngkOJDzWjLQ'
                    }, function(data){
                        if (data.success == true) {
                            toastr.success('Успешно переименованы файл/папка', "Успешно!");
                            vm.getFiles();
                        } else {
                            toastr.error(data.error, "Ой!");
                        }
                    });
                },
                createFolder: function(e) {
                    if (!this.allowCreateFolder) {
                        return;
                    }
                    var vm = this;
                    var name = this.modals.new_folder.name;
                    $.post('http://127.0.0.1:8000/admin/media/new_folder', { new_folder: vm.current_folder+'/'+name, _token: 'lMP0F7VhBPzb8toNZFtadDle0GgsyngkOJDzWjLQ' }, function(data) {
                        if(data.success == true){
                            toastr.success('Успешно создано ' + name, "Успешно!");
                            vm.getFiles();
                        } else {
                            toastr.error(data.error, "Ой!");
                        }
                        vm.modals.new_folder.name = '';
                        $('#create_dir_modal_'+vm._uid).modal('hide');
                    });
                },
                deleteFiles: function() {
                    if (!this.allowDelete) {
                        return;
                    }
                    var vm = this;
                    $.post('http://127.0.0.1:8000/admin/media/delete_file_folder', {
                        path: vm.current_folder,
                        files: vm.selected_files,
                        _token: 'lMP0F7VhBPzb8toNZFtadDle0GgsyngkOJDzWjLQ'
                    }, function(data){
                        if(data.success == true){
                            toastr.success('', "Успешно!");
                            vm.getFiles();
                            $('#confirm_delete_modal_'+vm._uid).modal('hide');
                        } else {
                            toastr.error(data.error, "Ой!");
                            vm.getFiles();
                            $('#confirm_delete_modal_'+vm._uid).modal('hide');
                        }
                    });
                },
                moveFiles: function(e) {
                    if (!this.allowMove) {
                        return;
                    }
                    var vm = this;
                    var destination = this.modals.move_files.destination;
                    if (destination === '') {
                        return;
                    }
                    $('#move_files_modal_'+vm._uid).modal('hide');
                    $.post('http://127.0.0.1:8000/admin/media/move_file', {
                        path: vm.current_folder,
                        files: vm.selected_files,
                        destination: destination,
                        _token: 'lMP0F7VhBPzb8toNZFtadDle0GgsyngkOJDzWjLQ'
                    }, function(data){
                        if(data.success == true){
                            toastr.success('Успешно перемещены файл/папка', "Успешно!");
                            vm.getFiles();
                        } else {
                            toastr.error(data.error, "Ой!");
                        }

                        vm.modals.move_files.destination = '';
                    });
                },
                crop: function(mode) {
                    if (!this.allowCrop) {
                        return;
                    }
                    if (!mode) {
                        if (!window.confirm('Исходное изображение будет изменено, вы уверены?')) {
                            return;
                        }
                    }

                    croppedData.originImageName = this.selected_file.name;
                    croppedData.upload_path = this.current_folder;
                    croppedData.createMode = mode;

                    var vm = this;
                    var postData = Object.assign(croppedData, { _token: 'lMP0F7VhBPzb8toNZFtadDle0GgsyngkOJDzWjLQ' });
                    $.post('http://127.0.0.1:8000/admin/media/crop', postData, function(data) {
                        if (data.success) {
                            toastr.success(data.message);
                            vm.getFiles();
                            $('#crop_modal_'+vm._uid).modal('hide');
                        } else {
                            toastr.error(data.error, "Ой!");
                        }
                    });
                },
                addSelectedFiles: function () {
                    var vm = this;
                    for (i = 0; i < vm.selected_files.length; i++) {
                        vm.openFile(vm.selected_files[i]);
                    }
                },
                bytesToSize: function(bytes) {
                    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                    if (bytes == 0) return '0 Bytes';
                    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
                },
                getFileName: function(name) {
                    var name = name.split('/');
                    return name[name.length -1];
                },
                imgIcon: function(path) {
                    path = path.replace(/\\/g,"/");
                    return 'background-size: cover; background-image: url("' + path + '"); background-repeat:no-repeat; background-position:center center;display:inline-block; width:100%; height:100%;';
                },
                dateFilter: function(date) {
                    if (!date) {
                        return null;
                    }
                    var date = new Date(date * 1000);

                    var month = "0" + (date.getMonth() + 1);
                    var minutes = "0" + date.getMinutes();
                    var seconds = "0" + date.getSeconds();

                    var dateFormated = date.getFullYear() + '-' + month.substr(-2) + '-' + date.getDate() + ' ' + date.getHours() + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);

                    return dateFormated;
                },
                endsWithAny: function(suffixes, string) {
                    return suffixes.some(function (suffix) {
                        return string.endsWith(suffix);
                    });
                }
            },
            mounted: function() {
                this.getFiles();
                var vm = this;

                if (this.element != '') {
                    this.hidden_element = document.querySelector(this.element);
                    if (!this.hidden_element) {
                        console.error('Element "'+this.element+'" could not be found.');
                    } else {
                        if (this.maxSelectedFiles > 1 && this.hidden_element.value == '') {
                            this.hidden_element.value = '[]';
                        }
                    }
                }

                //Key events
                this.onkeydown = function(evt) {
                    evt = evt || window.event;
                    if (evt.keyCode == 39) {
                        evt.preventDefault();
                        for (var i = 0, file; file = vm.files[i]; i++) {
                            if (file === vm.selected_file) {
                                i = i + 1; // increase i by one
                                i = i % vm.files.length;
                                vm.selectFile(vm.files[i], evt);
                                break;
                            }
                        }
                    } else if (evt.keyCode == 37) {
                        evt.preventDefault();
                        for (var i = 0, file; file = vm.files[i]; i++) {
                            if (file === vm.selected_file) {
                                if (i === 0) {
                                    i = vm.files.length;
                                }
                                i = i - 1;
                                vm.selectFile(vm.files[i], evt);
                                break;
                            }
                        }
                    } else if (evt.keyCode == 13) {
                        evt.preventDefault();
                        if (evt.target.tagName != 'INPUT') {
                            vm.openFile(vm.selected_file, null);
                        }
                    }
                };
                //Dropzone
                var dropzone = $(vm.$el).first().find('#upload').first();
                var progress = $(vm.$el).first().find('#uploadProgress').first();
                var progress_bar = $(vm.$el).first().find('#uploadProgress .progress-bar').first();
                if (this.allowUpload && !dropzone.hasClass('dz-clickable')) {
                    dropzone.dropzone({
                        timeout: 180000,
                        url: 'http://127.0.0.1:8000/admin/media/upload',
                        previewsContainer: "#uploadPreview",
                        totaluploadprogress: function(uploadProgress, totalBytes, totalBytesSent) {
                            progress_bar.css('width', uploadProgress + '%');
                            if (uploadProgress == 100) {
                                progress.delay(1500).slideUp(function(){
                                    progress_bar.css('width', '0%');
                                });
                            }
                        },
                        processing: function(){
                            progress.fadeIn();
                        },
                        sending: function(file, xhr, formData) {
                            formData.append("_token", 'lMP0F7VhBPzb8toNZFtadDle0GgsyngkOJDzWjLQ');
                            formData.append("upload_path", vm.current_folder);
                            formData.append("filename", vm.filename);
                            formData.append("details", JSON.stringify(vm.details));
                        },
                        success: function(e, res) {
                            if (res.success) {
                                toastr.success(res.message, "Успешно!");
                            } else {
                                toastr.error(res.message, "Ой!");
                            }
                        },
                        error: function(e, res, xhr) {
                            toastr.error(res, "Ой!");
                        },
                        queuecomplete: function() {
                            vm.getFiles();
                        }
                    });
                }

                //Cropper
                if (this.allowCrop) {
                    var cropper = $(vm.$el).first().find('#crop_modal_'+vm._uid).first();
                    cropper.on('shown.bs.modal', function (e) {
                        if (typeof cropper !== 'undefined' && cropper instanceof Cropper) {
                            cropper.destroy();
                        }
                        var croppingImage = document.getElementById('cropping-image_'+vm._uid);
                        cropper = new Cropper(croppingImage, {
                            crop: function(e) {
                                document.getElementById('new-image-width_'+vm._uid).innerText = Math.round(e.detail.width) + 'px';
                                document.getElementById('new-image-height_'+vm._uid).innerText = Math.round(e.detail.height) + 'px';
                                croppedData = {
                                    x: Math.round(e.detail.x),
                                    y: Math.round(e.detail.y),
                                    height: Math.round(e.detail.height),
                                    width: Math.round(e.detail.width)
                                };
                            }
                        });
                    });
                }

                $(document).ready(function () {
                    $(".form-edit-add").submit(function (e) {
                        if (vm.hidden_element) {
                            if (vm.maxSelectedFiles > 1) {
                                var content = JSON.parse(vm.hidden_element.value);
                                if (content.length < vm.minSelectedFiles) {
                                    e.preventDefault();
                                    var msg_sing = "Вы должны выбрать хотя бы один файл";
                                    var msg_plur = "Вы должны выбрать не менее 2 файлов";
                                    if (vm.minSelectedFiles == 1) {
                                        toastr.error(msg_sing);
                                    } else {
                                        toastr.error(msg_plur.replace('2', vm.minSelectedFiles));
                                    }
                                }
                            } else {
                                if (vm.minSelectedFiles > 0 && vm.hidden_element.value == '') {
                                    e.preventDefault();
                                    toastr.error("Вы должны выбрать хотя бы один файл");
                                }
                            }
                        }
                    });

                    //Nestable
                    $('#dd_'+vm._uid).nestable({
                        maxDepth: 1,
                        handleClass: 'file_link',
                        collapseBtnHTML: '',
                        expandBtnHTML: '',
                        callback: function(l, e) {
                            if (vm.allowMultiSelect) {
                                var new_content = [];
                                var object = $('#dd_'+vm._uid).nestable('serialize');
                                for (var key in object) {
                                    new_content.push(object[key].url);
                                }
                                vm.hidden_element.value = JSON.stringify(new_content);
                            }
                        }
                    });

                    $('#create_dir_modal_' + vm._uid).on('hidden.bs.modal', function () {
                        vm.modals.new_folder.name = '';
                    });

                    $('#move_files_modal_' + vm._uid).on('hidden.bs.modal', function () {
                        vm.modals.move_files.destination = '';
                    });
                });
            },
        });
    </script>
    <style>
        .dd-placeholder {
            flex: 1;
            width: 100%;
            min-width: 200px;
            max-width: 250px;
        }
    </style>
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
            return function() {
                $file = $(this).siblings(tag);

                params = {
                    slug:   'products',
                    filename:  $file.data('file-name'),
                    id:     $file.data('id'),
                    field:  $file.parent().data('field-name'),
                    multi: isMulti,
                    _token: 'lMP0F7VhBPzb8toNZFtadDle0GgsyngkOJDzWjLQ'
                }

                $('.confirm_delete_name').text(params.filename);
                $('#confirm_delete_modal').modal('show');
            };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                } else if (elt.type != 'date') {
                    elt.type = 'text';
                    $(elt).datetimepicker({
                        format: 'L',
                        extraFormats: [ 'YYYY-MM-DD' ]
                    }).datetimepicker($(elt).data('datepicker'));
                }
            });


            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('http://127.0.0.1:8000/admin/products/remove', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            var additionalConfig = {
                selector: 'textarea.richTextBox[name="characteristics"]',
            }

            $.extend(additionalConfig, "{}")

            tinymce.init(window.voyagerTinyMCE.getConfig(additionalConfig));
        });
    </script>
    <script>
        $(document).ready(function() {
            var additionalConfig = {
                selector: 'textarea.richTextBox[name="description"]',
            }

            $.extend(additionalConfig, "{}")

            tinymce.init(window.voyagerTinyMCE.getConfig(additionalConfig));
        });
    </script>

    </body>
    </html>
