
<header class="header_area" >

     <ul class="header_menu">
                   
                    <li><a data-toggle="dropdown" href="#"><i class="far fa-user"></i> {{ Auth::user()->name }} </a>
                            <div class="user_item dropdown-menu dropdown-menu-right">
                                
                            <ul>
                                @if(Auth::user()->role_id == 1)
                                
                                <li class="pt-2"><a href="{{Route('admin.profile')}}"><span><i class="fas fa-user"></i></span> حسابي</a></li>
                                
                                @elseif(Auth::user()->role_id == 2)
                                <li class="pt-2"><a href="{{Route('requester.profile')}}"><span><i class="fas fa-user"></i></span> حسابي</a></li>

                                @else
                                <li class="pt-2"><a href="{{Route('provider.profile')}}"><span><i class="fas fa-user"></i></span> حسابي</a></li>

                                @endif


                                @if(Auth::user()->role_id == 1)
                                
                                <li><a href="{{Route('admin.changePassword')}}"><span><i class="fas fa-cogs"></i></span>  تغيير كلمة المرور</a></li>
                                <li>
                                
                                @elseif(Auth::user()->role_id == 2)
                                <li><a href="{{Route('requester.changePassword')}}"><span><i class="fas fa-cogs"></i></span>  تغيير كلمة المرور</a></li>
                                <li>

                                @else
                                <li><a href="{{Route('provider.changePassword')}}"><span><i class="fas fa-cogs"></i></span>  تغيير كلمة المرور</a></li>
                                <li>

                                @endif
                                

                                @if(Auth::user()->role_id == 1)
                                
                                <a href="{{route('admin.logout')}}"><span><i class="fas fa-unlock-alt"></i></span> تسجيل الخروج</a></li>
                                
                                @elseif(Auth::user()->role_id == 2)
                                <a href="{{route('requester.logout')}}"><span><i class="fas fa-unlock-alt"></i></span> تسجيل الخروج</a></li>

                                @else
                                <a href="{{route('provider.logout')}}"><span><i class="fas fa-unlock-alt"></i></span> تسجيل الخروج</a></li>

                                @endif

                                

                                    
                            </ul>
                        </div>
                    </li>
                    <li>

                        <a class="responsive_menu_toggle" href="#"><i class="fas fa-bars"></i></a></li>
                </ul>



               

               <!--  <div class="sidebar_btn">
                    <button class="sidbar-toggler-btn"><i class="fas fa-bars"></i></button>
                </div> -->

                
                  
                <!-- logo -->
                <div class="sidebar_logo ">
<!-- <a href="{{route('home')}}"> -->
  <!-- <img src="{{asset('admin/assets/images/favicon.png')}}" alt="" class="img-fluid logo1">
   <img src="{{asset('admin/assets/images/favicon.png')}}" alt="" class="img-fluid logo2">
   </a>--> 
    <h1 class="logo me-auto ml-3"><a href="{{route('home')}}">Arak</a></h1>

                   
                </div>

                </header>