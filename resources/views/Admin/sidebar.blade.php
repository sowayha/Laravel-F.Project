<aside class="sidebar-wrapper ">
              <nav class="sidebar-nav">
                 <ul class="metismenu" id="menu1">
                    <li class="single-nav-wrapper">
                        <a href="{{route('admin.dashboard')}}" class="menu-item">
                            <span class="left-icon"><i class="fas fa-home"></i></span>
                            <span class="menu-text">الرئيسية</span>
                        </a>
                      </li>
                  
                     
                          @if(Auth::user()->role_id == 1)

                          <li class="single-nav-wrapper ">
                            
                          <a class="has-arrow menu-item " href="#" aria-expanded="false">
                            <span class="left-icon"><i class="fa-solid fa-pen-to-square"></i></span> 
                              <span class="menu-text">تعديل الصفحة الرئيسية 
                            </span>
                          </a>
                          <ul class="dashboard-menu">
                              

                        <li class="single-nav-wrapper">
                        <a href="{{route('openheroBanner')}}" class="menu-item">
                            <span class="left-icon"><i class="fa-solid fa-image"></i></span>
                            <span class="menu-text">العنوان</span>
                        </a>
                      </li>

                      <li class="single-nav-wrapper">
                        <a href="{{route('openAboutUs')}}" class="menu-item">
                            <span class="left-icon"><i class="fa-solid fa-address-card"></i></span>
                            <span class="menu-text">من نحن</span>
                        </a>
                      </li>

                       <li class="single-nav-wrapper">
                        <a href="{{route('openHDIW')}}" class="menu-item">
                            <span class="left-icon"><i class="fa-solid fa-briefcase"></i></span>
                            <span class="menu-text">كيفية الاستخدام
</span>
                        </a>
                      </li>

                      <li class="single-nav-wrapper">
                        <a href="{{route('forRequesters')}}" class="menu-item">
                            <span class="left-icon"><i class="fa-solid fa-registered"></i></span>
                            <span class="menu-text">المستخدم</span>
                        </a>
                      </li>

                      <li class="single-nav-wrapper">
                        <a href="{{route('forProviders')}}" class="menu-item">
                            <span class="left-icon"><i class="fa-brands fa-product-hunt"></i></span>
                            <span class="menu-text">مقدم الخدمة</span>
                        </a>
                      </li>

                        <li class="single-nav-wrapper">
                          <a class="has-arrow menu-item" href="#" aria-expanded="false">
                            <span class="left-icon"><i class="fa-solid fa-server"></i></span>
                              <span class="menu-text">الخدمات</span>
                          </a>
                          <ul class="dashboard-menu">
                              <li><a href="{{ route('allServices') }}">كل الخدمات</a></li>
                              
                              <li><a href="{{ route('NewService') }}">اضف خدمة</a></li>


                            </ul>
                        </li>


                      </li>

                       <li class="single-nav-wrapper">
                        <a href="{{route('cta')}}" class="menu-item">
                            <span class="left-icon"><i class="fa-solid fa-circle-plus"></i></span>
                            <span class="menu-text">طلب التسجيل</span>
                        </a>
                      </li>

                      <li class="single-nav-wrapper">
                          <a class="has-arrow menu-item" href="#" aria-expanded="false">
                            <span class="left-icon"><i class="fa-solid fa-circle-question"></i></span>
                              <span class="menu-text">الأسئلة المتداولة
                            </span>
                          </a>
                          <ul class="dashboard-menu">
                              <li><a href="{{ route('allFaqs') }}">كل الاسئلة</a></li>
                              
                              <li><a href="{{ route('NewFaqs') }}">اضف سؤال</a></li>
                            </ul>
                        </li>

                      <li class="single-nav-wrapper">
                        <a href="{{route('social')}}" class="menu-item">
                            <span class="left-icon"><i class="fa-brands fa-facebook"></i></span>
                            <span class="menu-text">مواقع التواصل </span>
                        </a>
                      </li>






                            </ul>
                        </li>


                        <li class="single-nav-wrapper">
                        <a href="{{route('admin.allReq')}}" class="menu-item">
                            <span class="left-icon"><i class="fa-solid fa-server"></i></span>
                            <span class="menu-text"> الطلبات </span>
                        </a>
                      </li>


                           <li class="single-nav-wrapper">
                          <a class="has-arrow menu-item" href="#" aria-expanded="false">
                            <span class="left-icon"><i class="fa-solid fa-user"></i></span>
                              <span class="menu-text">الاعضاء</span>
                          </a>
                          <ul class="dashboard-menu">
                              <li><a href="{{ route('allUsers') }}">مدير</a></li>
                              <li><a href="{{ route('rallUsers') }}">مستخدم</a></li>
                              <li><a href="{{ route('pallUsers') }}">مقدم خدمة</a></li>
                              <li><a href="{{ route('addUser') }}">اضف عضو</a></li>
                            </ul>
                        </li>

                           
                          @endif


                      


                @if(Auth::user()->role_id == 2)
                <li class="single-nav-wrapper">
                        <a href="{{route('requester.addBankAcc')}}" class="menu-item">
                            <span class="left-icon"><i class="fa-solid fa-dollar-sign"></i></span>
                            <span class="menu-text">الحساب البنكي</span>
                        </a>
                      </li>

                      <li class="single-nav-wrapper">
                          <a class="has-arrow menu-item" href="#" aria-expanded="false">
                            <span class="left-icon"><i class="fa-solid fa-plus"></i></span>
                              <span class="menu-text"> طلب الخدمة </span>
                          </a>
                          <ul class="dashboard-menu">
                              <li><a href="{{ route('allServices') }}"> كل الخدمات </a></li>
                              <li><a href="{{ route('addReqPage') }}"> اضافة خدمة </a></li>
                            </ul>
                        </li>


                @elseif(Auth::user()->role_id == 3)
                <li class="single-nav-wrapper">
                        <a href="{{route('provider.addBankAcc')}}" class="menu-item">
                            <span class="left-icon"><i class="fas fa-home"></i></span>
                            <span class="menu-text">الحساب البنكي</span>
                        </a>
                      </li>
                @endif

                          
                            
                      
                      
                    </ul>
              </nav>
            </aside>