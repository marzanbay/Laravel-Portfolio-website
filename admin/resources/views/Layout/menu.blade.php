    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item "> <a class="nav-link nav-toggler  hidden-md-up  waves-effect waves-dark" href="javascript:void(0)"><i class="fas  fa-bars"></i></a></li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="fas fa-bars"></i></a> </li> 
                     <li class="nav-item mt-3">ADMIN</li>
					</ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item"><a href="{{url('/Logout')}}" class="btn btn-sm btn-danger">Logout</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider mt-0" style="margin-bottom: 5px"></li>

                        <li> <a href="{{url('/')}}" ><span> <i class="fas fa-home"></i> </span><span class="hide-menu">হোম</span></a></li>

             <li> <a href="{{url('/visitor')}}" ><span> <i class="fas fa-users"></i> </span><span class="hide-menu">ভিজিটর</span></a></li>

                    <li> <a href="{{url('/service')}}" ><span> <i class="fas fa-globe"></i> </span><span class="hide-menu">সার্ভিস</span></a></li>

                    <li> <a href="{{url('/courses')}}" ><span> <i class="fas fa-user-graduate"></i> </span><span class="hide-menu">কোর্স</span></a></li>

                    <li> <a href="{{url('/Project')}}" ><span> <i class="fas fa-code"></i> </span><span class="hide-menu">প্রজেক্ট</span></a></li>

                    <li> <a href="{{url('/Contact')}}" ><span> <i class="far fa-envelope-open"></i> </span><span class="hide-menu">কন্টাক্ট</span></a></li>

                    <li> <a href="{{url('/Review')}}" ><span> <i class="fas fa-star-half-alt"></i> </span><span class="hide-menu">রিভিউ</span></a></li>

                    <li> <a href="{{url('/Photo')}}" ><span> <i class="fas fa-images"></i> </span><span class="hide-menu">ফটো গ্যালারি</span></a></li>



					</ul>
                </nav>
            </div>
        </aside>
<div class="page-wrapper">