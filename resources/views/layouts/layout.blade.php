<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Collapsible sidebar using Bootstrap 4</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>
<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header text-center">
            <h3>لوحة تحكم</h3>
            <strong>DP</strong>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="index.html" class="ho text-right">الرئيسية <i class="fas fa-home ml-2"></i></a>
                <strong> <a href="index.html" class="text-center" style="font-size: 22px"><i class="fas fa-home "></i></a></strong>
            </li>
            <li >
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle ho text-right">أخبار<i class="fas fa-bars ml-2"></i></a>
                <strong><a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-center" style="font-size: 22px"><i class="fas fa-bars"></i></a></strong>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="{{route('post.create')}}" class="text-right home">اضافة خبر</a>
                    </li>
                    <li>
                        <a href="{{ route('posts') }}" class="text-right home">عرض الأخبار</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#notifcation" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-right ho">أقسام<i class="fas fa-bell ml-2"></i></a>
                <strong> <a href="#notifcation" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-center" style="font-size: 22px"><i class="fas fa-bell"></i></a></strong>
                <ul class="collapse list-unstyled" id="notifcation">
                    <li>
                        <a href="{{route('section.create')}}" class="text-right">اضافة قسم</a>
                    </li>
                    <li>
                        <a href="{{route('sections')}}" class="text-right">عرض الأقسام</a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="#commncation" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-right ho">الأقلام الحرة<i class="fas fa-comment ml-2"></i></a>
                <strong> <a href="#commncation" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-center" style="font-size: 22px"><i class="fas fa-comment"></i></a></strong>
                <ul class="collapse list-unstyled" id="commncation">
                    <li>
                        <a href="{{route('pen.create')}}" class="text-right">اضافة</a>
                    </li>
                    <li>
                        <a href="{{route('pens')}}" class="text-right">عرض</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="setting.html" class="ho text-right">اجتماعي <i class="fas fa-user-cog ml-2"></i></a>
                <strong> <a href="setting.html" class="text-center" style="font-size: 22px"><i class="fas fa-user-cog"></i></a></strong>
            </li>
        </ul>
    </nav>


    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light" style="background: #172b44">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-side" style="background: none; color: #FFF ;font-size: 20px">
                    <i class="fas fa-align-left"></i>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none mr-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item dropdown dropdown2">
                            <a class="nav-link dropdown-toggle dropdown-toggle2" style="margin-left: 10px" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img width="30" style="border-radius: 50% ; margin-left: 10px" src="http://entryit.net/storage/logos/Xonahp6qJzfsfDrGvOO9DCvvwB0Bx0ZsXpxwK2D4.jpg" alt="">Admin
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#"><i class="fas fa-user ml-2"></i>الملف الشخصي</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog ml-2"></i>الاعدادت</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt ml-2"></i>تسجيل خروج</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')

    </div>
</div>


<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script><!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script defer src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });
</script>
@yield('js')
</body>

</html>
