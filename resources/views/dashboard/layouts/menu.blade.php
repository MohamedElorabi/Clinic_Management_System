<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{asset('/')}}">
                        <div class="brand-logo">
                            <img src="{{asset('dashboard/images/logo/logo.jpg')}}" alt="">
                            <h2 class="brand-text">عيادة دكتور/</h2>    
                        </div>
                    </a>
                </li>
                
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">

            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item"><a href="{{asset('/')}}"><i class="feather icon-home"></i><span class="menu-title">لوحة التحكم</span></a>
                </li>

                <li class=" nav-item"><a href="#"><i class="fas fa-user-md"></i><span class="menu-title">الكشوفات</span><span class="badge badge badge-pill badge-success float-right mr-2"></span></a>
                    <ul class="menu-content">
                        @if (auth()->user()->hasPermission('read-reveals'))
                        <li><a href="{{url(route('reveals.index'))}}"><i class="feather icon-circle"></i><span class="menu-item">عرض الكشوفات</span></a>
                        </li>
                        @endif
                        @if (auth()->user()->hasPermission('create-reveals'))
                        <li><a href="{{url(route('reveals.create'))}}"><i class="feather icon-circle"></i><span class="menu-item">انشاء كشف جديد</span></a>
                        </li>
                        @endif
                    </ul>
                </li>

                <li class=" nav-item"><a href="#"><i class="fas fa-clipboard-list"></i><span class="menu-title">الحجز</span></a>
                    <ul class="menu-content">
                    @if (auth()->user()->hasPermission('read-reservations'))
                        <li><a href="{{url(route('reservations.index'))}}"><i class="feather icon-circle"></i><span class="menu-item">عرض الحجوزات</span></a>
                        </li>
                        @endif
                    @if (auth()->user()->hasPermission('create-reservations'))
                        <li><a href="{{url(route('reservations.create'))}}"><i class="feather icon-circle"></i><span class="menu-item">انشاء حجز جديد</span></a>
                        </li>
                    @endif
                    </ul>
                </li>


                {{-- <li class=" nav-item"><a href="#"><i class="fas fa-user-injured"></i><span class="menu-title">المرضى</span></a>
                    <ul class="menu-content">
                    @if (auth()->user()->hasPermission('read-patients'))
                    <li><a href="{{url(route('patients.index'))}}"><i class="feather icon-circle"></i><span class="menu-item">عرض بيانات المرضى</span></a>
                        </li>
                    @endif
                    @if (auth()->user()->hasPermission('create-patients'))
                        <li><a href="{{url(route('patients.create'))}}"><i class="feather icon-circle"></i><span class="menu-item">انشاء بيانات مريض</span></a>
                        </li>
                    @endif
                    </ul>
                </li> --}}

                <li class=" nav-item"><a href="#"><i class="feather icon-user"></i><span class="menu-title">المشرفين</span></a>
                    <ul class="menu-content">
                    @if (auth()->user()->hasPermission('read-users'))
                        <li><a href="{{url(route('admins.index'))}}"><i class="feather icon-circle"></i><span class="menu-item">عرض المشرفين</span></a>
                        </li>
                    @endif

                    @if (auth()->user()->hasPermission('create-users'))
                        <li><a href="{{url(route('admins.create'))}}"><i class="feather icon-circle"></i><span class="menu-item">انشاء بيانات مشرف جديد</span></a>
                        </li>
                    @endif
                    </ul>
                </li>
                

                <li class=" nav-item"><a href="#"><i class="fas fa-file"></i><span class="menu-title">سجلات المرضى</span></a>
                    <ul class="menu-content">
                    
                    <li><a href="{{url(route('records.index'))}}"><i class="feather icon-circle"></i><span class="menu-item">عرض السجلات السابقة</span></a>
                        </li>
                    
                        <li><a href="{{url(route('records.create'))}}"><i class="feather icon-circle"></i><span class="menu-item">إنشاء سجل</span></a>
                        </li>
                    
                    </ul>
                </li>



            </ul>
        </div>
    </div>
