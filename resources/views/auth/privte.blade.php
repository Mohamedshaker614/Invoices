<!-- Sidebar  -->
<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        @php
            $setting = Dev\Infrastructure\Model\Setting::first();
            // $reservationsPending=Dev\Infrastructure\Model\Setting::first();
        @endphp
        <a href="{{ route('dashboard') }}">
            <img src="{{ $setting ? $setting->logo_url : '' }}" class="img-fluid" alt="">
            <span>{{ $setting ? $setting->dr_name : '' }}</span>
        </a>
        <div class="iq-menu-bt-sidebar">
            <div class="iq-menu-bt align-self-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                    <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul class="iq-menu">
                {{-- <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Dashboard</span></li> --}}
                <li {{-- class="active" --}}>
                    <a href="{{ route('dashboard') }}" class="iq-waves-effect">
                        <i class="ri-home-4-line"></i><span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
                @if (Auth::guard(Guard::ADMINS)->user()->can('Reservations'))
                    <li class="{{ request()->is('reservations*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-reserved-line"></i><span>{{ __('Reservations') }}</span>
                            {{-- <small style="left: 47px;" class="badge badge-pill badge-primary float-right font-weight-normal ml-auto">Soon</small> --}}
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('reservations*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('reservations*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Reservation Add'))
                                <li><a data-toggle="modal" data-target="#exampleModalScrollable"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a></li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Reservations List'))
                                <li><a href="{{ route('reservations.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('List') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif


                @php
                    use App\Utility\Guard;
                @endphp
                @if (Auth::guard(Guard::ADMINS)->user() && Auth::guard(Guard::ADMINS)->user()->user_type == 'super')
                    @if (Auth::guard(Guard::ADMINS)->user()->can('Managers'))
                        <li class="{{ request()->is('admins*') ? 'menu-open' : '' }}">
                            <a href="javascript:void(0);" class="iq-waves-effect">
                                <i class="ri-user-line"></i><span>{{ __('المديرين') }}</span>
                                <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                            <ul class="iq-submenu {{ request()->is('admins*') ? 'menu-open' : '' }}"
                                style="{{ request()->is('admins*') ? 'display: block;' : '' }}">
                                @if (Auth::guard(Guard::ADMINS)->user()->can('Managers Add'))
                                    <li><a href="{{ route('admins.create') }}"><i
                                                class="ri-add-line"></i>{{ __('Add') }}</a></li>
                                @endif
                                @if (Auth::guard(Guard::ADMINS)->user()->can('Managers List'))
                                    <li><a href="{{ route('admins.index') }}"><i
                                                class="ri-file-list-line"></i>{{ __('List') }}</a></li>
                                @endif
                                @if (Auth::guard(Guard::ADMINS)->user()->can('Managers Roles'))
                                    <li><a href="{{ route('roles.index') }}"><i
                                                class="ri-file-list-line"></i>{{ __('Role') }}</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif
                @endif


                @if (Auth::guard(Guard::ADMINS)->user()->can('Patient files'))
                    <li class="{{ request()->is('users*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-user-line"></i><span>{{ __('ملفات المرضي') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('users*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('users*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Patient files Add'))
                                <li><a href="{{ route('users.create') }}"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Patient files List'))
                                <li><a href="{{ route('users.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('List') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::guard(Guard::ADMINS)->user()->can('news'))
                    <li class="{{ request()->is('announcements*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-contacts-book-line"></i><span>{{ __('العروض و الاخبار الجديدة ') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('announcements*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('announcements*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('news Add'))
                                <li><a href="{{ route('announcements.create') }}"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a></li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('news List'))
                                <li><a href="{{ route('announcements.index') }}"><i
                                            class="ri-add-line"></i>{{ __('List') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::guard(Guard::ADMINS)->user()->can('notifictations'))
                    <li class="{{ request()->is('notification*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-notification-2-line"></i><span>{{ __('notifications') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('notification*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('notification*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('notifictations Add'))
                                <li><a href="{{ route('notification.create') }}"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a></li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('notifictations List'))
                                <li><a href="{{ route('notification.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('List') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif




                @php
                    $clinicInfo = Dev\Infrastructure\Model\Setting::first();
                @endphp

                @if ($clinicInfo && $clinicInfo->clinic_specialty == 2)
                    <li class="{{ request()->is('periodic_notifications*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-notification-2-line"></i><span>{{ __('الاشعارات الدوريه') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('periodic_notifications*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('periodic_notifications*') ? 'display: block;' : '' }}">

                            <li><a href="{{ route('periodic_notifications.create') }}"><i
                                        class="ri-add-line"></i>{{ __('Add') }}</a></li>

                            <li><a href="{{ route('periodic_notifications.index') }}"><i
                                        class="ri-file-list-line"></i>{{ __('List') }}</a></li>

                        </ul>
                    </li>
                @endif






                @if (Auth::guard(Guard::ADMINS)->user()->can('Services'))
                    <li class="{{ request()->is('reservationServices*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-mini-program-line"></i><span>{{ __('Reservation Services') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('reservationServices*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('reservationServices*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Services Add'))
                                <li><a href="{{ route('reservationServices.create') }}"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a></li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Services List'))
                                <li><a href="{{ route('reservationServices.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('List') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::guard(Guard::ADMINS)->user()->can('therapeutic methods'))
                    <li
                        class="{{ request()->is('therapeutic_methods*') || request()->is('materials*') || request()->is('inventory*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-medium-line"></i><span>{{ __('الوسائل العلاجيه ') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('therapeutic_methods*') || request()->is('materials*') || request()->is('inventory*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('therapeutic_methods*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('therapeutic methods List'))
                                <li><a href="{{ route('therapeutic_methods.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('List') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('therapeutic Raw materials'))
                                <li><a href="{{ route('materials.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('المواد الخام') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::guard(Guard::ADMINS)->user()->can('Pricing plans'))
                    <li class="{{ request()->is('package_templates*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-medium-line"></i><span>{{ __('خطط الاسعار و الحسابات') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('package_templates*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('package_templates*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Pricing plans Add'))
                                <li><a href="{{ route('package_templates.create') }}"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Pricing plans List'))
                                <li><a href="{{ route('package_templates.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('List') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::guard(Guard::ADMINS)->user()->can('Patients accounts'))
                    <li class="{{ request()->is('packages*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-medium-line"></i><span>{{ __('حسابات المرضي') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('packages*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('packages*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Patients accounts Add'))
                                <li><a href="{{ route('packages.create') }}"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Patients accounts List'))
                                <li><a href="{{ route('packages.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('List') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::guard(Guard::ADMINS)->user()->can('Financial statistics'))
                    <li
                        class="{{ request()->is('financial_setting*') || request()->is('expenses*') || request()->is('revenues*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-money-dollar-box-line"></i><span>{{ __('الاحصائيات المالية ') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('financial_setting*') || request()->is('expenses*') || request()->is('revenues*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('financial_setting*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Financial items'))
                                <li><a href="{{ route('financial_setting.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('بنود الماليه') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('expenses'))
                                <li><a href="{{ route('expenses.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('المصروفات') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Revenues'))
                                <li><a href="{{ route('revenues.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('ايرادات') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Financial reports'))
                                <li><a href="{{ route('financial.reports') }}"><i
                                            class="ri-file-list-line"></i>{{ __('تقارير الماليه ') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::guard(Guard::ADMINS)->user()->can('medicines'))
                    <li class="{{ request()->is('medicines*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-medium-line"></i><span>{{ __('الادويه') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('medicines*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('medicines*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('medicines Add'))
                                <li><a href="{{ route('medicines.create') }}"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('medicines List'))
                                <li><a href="{{ route('medicines.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('List') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::guard(Guard::ADMINS)->user()->can('Analysis and rumours'))
                    <li class="{{ request()->is('tests*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-checkbox-circle-line"></i><span>{{ __('التحاليل و الاشاعات ') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('tests*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('tests*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Analysis and rumours Add'))
                                <li><a href="{{ route('tests.create') }}"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Analysis and rumours List'))
                                <li><a href="{{ route('tests.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('List') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::guard(Guard::ADMINS)->user()->can('Prescriptions'))
                    <li class="{{ request()->is('prescriptions*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-file-text-line"></i><span>{{ __('الروشتات ') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('prescriptions*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('prescriptions*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Prescriptions Add'))
                                <li><a
                                        href="{{ route('prescriptions.create', ['reservation_id' => request('reservation_id')]) }}"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Prescriptions List'))
                                <li><a href="{{ route('prescriptions.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('List') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::guard(Guard::ADMINS)->user()->can('Categories of patients'))
                    <li class="{{ request()->is('categories*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-align-justify"></i><span>{{ __('فئات المرضي') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('categories*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('categories*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Categories of patients Add'))
                                <li><a href="{{ route('categories.create') }}"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Categories of patients List'))
                                <li><a href="{{ route('categories.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('List') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif




                @if (Auth::guard(Guard::ADMINS)->user()->can('Blog sections'))
                    <li class="{{ request()->is('blog_type*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-article-fill"></i><span>{{ __('اقسام المدونات') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                        </a>
                        <ul class="iq-submenu {{ request()->is('blog_type*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('blog_type*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Blog sections Add'))
                                <li><a href="{{ route('blog_type.create') }}"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Blog sections List'))
                                <li><a href="{{ route('blog_type.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('List') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::guard(Guard::ADMINS)->user()->can('Articles'))
                    <li class="{{ request()->is('blogs*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-article-fill"></i><span>{{ __('المقالات') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('blogs*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('blogs*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Articles Add'))
                                <li><a href="{{ route('blogs.create') }}"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Articles List'))
                                <li><a href="{{ route('blogs.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('List') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::guard(Guard::ADMINS)->user()->can('videos'))
                    <li class="{{ request()->is('videos*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-video-line"></i><span>{{ __('الفيديوهات الدعائية') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('videos*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('videos*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('videos Add'))
                                <li><a href="{{ route('videos.create') }}"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('videos List'))
                                <li><a href="{{ route('videos.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('List') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::guard(Guard::ADMINS)->user()->can('Basic medical staff'))
                    <li class="{{ request()->is('staff*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-group-line"></i><span>{{ __('الطاقم الطبي الأساسي') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                        </a>
                        <ul class="iq-submenu {{ request()->is('staff*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('staff*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Basic medical staff Add'))
                                <li><a href="{{ route('staff.create') }}"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Basic medical staff List'))
                                <li><a href="{{ route('staff.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('List') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::guard(Guard::ADMINS)->user()->can('Assistant doctors'))
                    <li class="{{ request()->is('doctors*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-group-line"></i><span>{{ __('الأطباء المساعدين') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                        </a>
                        <ul class="iq-submenu {{ request()->is('doctors*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('staff*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Assistant doctors Add'))
                                <li><a href="{{ route('doctors.create') }}"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Assistant doctors List'))
                                <li><a href="{{ route('doctors.index') }}"><i
                                            class="ri-file-list-line"></i>{{ __('List') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif


                @if (Auth::guard(Guard::ADMINS)->user()->can('Clinic data'))
                    <li class="{{ request()->is('docInfo*') ? 'menu-open' : '' }}">
                        <a href="{{ route('docInfo') }}" class="iq-waves-effect">
                            <i class="ri-home-4-line"></i><span>{{ __('بيانات العياده') }}</span>
                        </a>
                    </li>
                @endif

                @if (Auth::guard(Guard::ADMINS)->user()->can('Clinic branches'))
                    <li class="{{ request()->is('contactUs*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);" class="iq-waves-effect">
                            <i class="ri-contacts-book-line"></i><span>{{ __('أفرع العيادة ') }}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul class="iq-submenu {{ request()->is('contactUs*') ? 'menu-open' : '' }}"
                            style="{{ request()->is('contactUs*') ? 'display: block;' : '' }}">
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Clinic branches Add'))
                                <li><a href="{{ route('contactUs.create') }}"><i
                                            class="ri-add-line"></i>{{ __('Add') }}</a>
                                </li>
                            @endif
                            @if (Auth::guard(Guard::ADMINS)->user()->can('Clinic branches List'))
                                <li><a href="{{ route('contactUs.index') }}"><i
                                            class="ri-add-line"></i>{{ __('List') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>

<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">اختر الخدمه</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="GET" action="{{ route('reservations.create') }}" enctype="multipart/form-data">

                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="title">{{ __('اختر الخدمه') }}:</label>
                            <select name="service_id" id="service_id" class="form-control select2" required>
                                <option></option>
                                @foreach (\Dev\Infrastructure\Model\ReservationService::all() as $key => $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>

                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn btn-primary">انشاء حجز </button>
                </div>
            </form>

        </div>
    </div>
</div>
