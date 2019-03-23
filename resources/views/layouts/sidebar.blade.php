
<ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
    
    <li class="nav-item start {{ request()->is('noticeboard') ? 'active' : '' }}">
        <a href="{{ auth('user')->check() ? route('noticeboard') : (auth('teacher')->check() ? route('teacher.noticeboard.index') : '') }}" class="nav-link nav-toggle">
            <i class="icon-list"></i>
            <span class="title">{{ trans('general.noticeboard') }}</span>         
        </a>       
    </li>

    @if(auth('user')->check())
        @can(['view-announcement'])
        <li class="nav-item start {{ request()->is('announcements') ? 'active' : '' }}">
            <a href="{{ route('announcements.index') }}" class="nav-link nav-toggle">
                <i class="icon-list"></i>
                <span class="title">{{ trans('general.announcements_list') }}</span>         
            </a>       
        </li>
        @endcan

        <li class="nav-item start {{ request()->is('home') ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="nav-link nav-toggle">
                <i class="icon-home"></i>
                <span class="title">{{ trans('general.dashboard') }}</span>         
            </a>       
        </li>

        <li class="nav-item start {{ request()->is('issues*') ? 'active' : '' }}">
            <a href="{{ route('issues.index') }}" class="nav-link nav-toggle">
                <i class="icon-question"></i>            
                <span class="title">{{ trans('general.issue') }}</span>         
            </a>       
        </li>

        @if (auth()->user()->can(['view-university']))
        <li class="nav-item start {{ request()->is('universities*') ? 'active' : '' }}">
            <a href="#" class="nav-link nav-toggle">
                <i class="icon-grid"></i>
                <span class="title">{{ trans('general.universities') }}</span>
                <span class="arrow {{ request()->is('universities*') ? 'open' : '' }}"></span>
            </a>
            <ul class="sub-menu">            
                <li class="nav-item {{ request()->is('universities') ? 'active' : '' }}">
                    <a href="{{ route('universities.index') }}" class="nav-link ">
                        <i class="icon-list"></i>
                        <span class="title">{{ trans('general.universities_list') }}</span>                    
                    </a>
                </li> 
                @if (auth()->user()->can(['create-university']))          
                <li class="nav-item {{ request()->is('universities/create') ? 'active' : '' }}">
                    <a href="{{ route('universities.create') }}" class="nav-link ">
                        <i class="icon-plus"></i>
                        <span class="title">{{ trans('general.create_university') }}</span>
                    </a>
                </li>
                @endif            
            </ul>
        </li>
        @endif

        @if (auth()->user()->can(['view-student']))
        <li class="nav-item start {{ (request()->is('students*') or request()->is('attendance*')) ? 'active' : '' }}">
            <a href="#" class="nav-link nav-toggle">
                <i class="icon-graduation"></i>
                <span class="title">{{ trans('general.students') }}</span>
                <span class="arrow {{ (request()->is('students*') or request()->is('attendance*')) ? 'open' : '' }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ request()->is('students') ? 'active' : '' }}">
                    <a href="{{ route('students.index') }}" class="nav-link ">
                        <i class="icon-list"></i>
                        <span class="title">{{ trans('general.students_list') }}</span>                    
                    </a>
                </li> 
            
                @if (auth()->user()->can(['create-student']))          
                <li class="nav-item {{ request()->is('students/create') ? 'active' : '' }}">
                    <a href="{{ route('students.create') }}" class="nav-link ">
                        <i class="icon-plus"></i>
                        <span class="title">{{ trans('general.create_student') }}</span>
                    </a>
                </li>
                @endif

                @if (auth()->user()->can(['view-group']))   
                <hr>
                <li class="nav-item {{ (request()->is('*groups') or request()->is('*groups*edit')) ? 'active' : '' }}">
                    <a href="{{ route('groups.index') }}" class="nav-link ">
                        <i class="icon-list"></i>
                        <span class="title">{{ trans('general.groups_list') }}</span>
                    </a>
                </li>
                @endif

                @if (auth()->user()->can(['create-group']))          
                <li class="nav-item {{ request()->is('*groups/create') ? 'active' : '' }}">
                    <a href="{{ route('groups.create') }}" class="nav-link ">
                        <i class="icon-plus"></i>
                        <span class="title">{{ trans('general.create_group') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('*groups/create') ? 'active' : '' }}">
                    <a href="{{ route('student.groups.all.create') }}" class="nav-link ">
                        <i class="icon-plus"></i>
                        <span class="title">{{ trans('general.create_groups_automatically') }}</span>
                    </a>
                </li>
                @endif
                <hr>
                {{--<li class="nav-item {{ request()->is('attendance') ? 'active' : '' }}">--}}
                    {{--<a href="{{ route('attendance.create') }}" class="nav-link ">--}}
                        {{--<i class="icon-printer"></i>--}}
                        {{--<span class="title">{{ trans('general.print_attendance') }}</span>--}}
                    {{--</a>--}}
                {{--</li>--}}

            </ul>
        </li>
        @endif

        @if (auth()->user()->can(['view-transfer']))
        <li class="nav-item start {{ request()->is('transfers*') ? 'active' : '' }}">
            <a href="#" class="nav-link nav-toggle">
                <i class="icon-grid"></i>
                <span class="title">{{ trans('general.transfers') }}</span>
                <span class="arrow {{ request()->is('transfers*') ? 'open' : '' }}"></span>
            </a>
            <ul class="sub-menu">            
                <li class="nav-item {{ request()->is('transfers') ? 'active' : '' }}">
                    <a href="{{ route('transfers.index') }}" class="nav-link ">
                        <i class="icon-list"></i>
                        <span class="title">{{ trans('general.transfers_list') }}</span>                    
                    </a>
                </li> 
                @if (auth()->user()->can(['create-transfer']))          
                <li class="nav-item {{ request()->is('transfers/create') ? 'active' : '' }}">
                    <a href="{{ route('transfers.create') }}" class="nav-link ">
                        <i class="icon-plus"></i>
                        <span class="title">{{ trans('general.create_transfer') }}</span>
                    </a>
                </li>
                @endif            
            </ul>
        </li>
        @endif

        @if (auth()->user()->can(['view-leave']))
        <li class="nav-item start {{ request()->is('leaves*') ? 'active' : '' }}">
            <a href="#" class="nav-link nav-toggle">
                <i class="icon-grid"></i>
                <span class="title">{{ trans('general.leaves') }}</span>
                <span class="arrow {{ request()->is('leaves*') ? 'open' : '' }}"></span>
            </a>
            <ul class="sub-menu">            
                <li class="nav-item {{ request()->is('leaves') ? 'active' : '' }}">
                    <a href="{{ route('leaves.index') }}" class="nav-link ">
                        <i class="icon-list"></i>
                        <span class="title">{{ trans('general.leaves_list') }}</span>                    
                    </a>
                </li> 
                @if (auth()->user()->can(['create-leave']))          
                <li class="nav-item {{ request()->is('leaves/create') ? 'active' : '' }}">
                    <a href="{{ route('leaves.create') }}" class="nav-link ">
                        <i class="icon-plus"></i>
                        <span class="title">{{ trans('general.create_leave') }}</span>
                    </a>
                </li>
                @endif            
            </ul>
        </li>
        @endif

        @if (auth()->user()->can(['view-dropout']))
        <li class="nav-item start {{ request()->is('dropouts*') ? 'active' : '' }}">
            <a href="#" class="nav-link nav-toggle">
                <i class="icon-grid"></i>
                <span class="title">{{ trans('general.dropouts') }}</span>
                <span class="arrow {{ request()->is('dropouts*') ? 'open' : '' }}"></span>
            </a>
            <ul class="sub-menu">            
                <li class="nav-item {{ request()->is('dropouts') ? 'active' : '' }}">
                    <a href="{{ route('dropouts.index') }}" class="nav-link ">
                        <i class="icon-list"></i>
                        <span class="title">{{ trans('general.dropouts_list') }}</span>                    
                    </a>
                </li> 
                @if (auth()->user()->can(['create-dropout']))          
                <li class="nav-item {{ request()->is('dropouts/create') ? 'active' : '' }}">
                    <a href="{{ route('dropouts.create') }}" class="nav-link ">
                        <i class="icon-plus"></i>
                        <span class="title">{{ trans('general.create_dropout') }}</span>
                    </a>
                </li>
                @endif            
            </ul>
        </li>
        @endif

        @if (auth()->user()->can(['view-curriculum']))
        <li class="nav-item start {{ request()->is('curriculum*') ? 'active' : '' }}">
            <a href="#" class="nav-link nav-toggle">
                <i class="icon-grid"></i>
                <span class="title">{{ trans('general.curriculum') }}</span>
                <span class="arrow {{ request()->is('curriculum*') ? 'open' : '' }}"></span>
            </a>
            <ul class="sub-menu">
                @if (auth()->user()->allUniversities())            
                <li class="nav-item {{ request()->is('curriculum*') ? 'active' : '' }}">
                    <a href="{{ route('curriculum.universities') }}" class="nav-link ">
                        <i class="icon-list"></i>
                        <span class="title">{{ trans('general.universities_list') }}</span>                    
                    </a>
                </li>
                @else
                <li class="nav-item {{ request()->is('curriculum*') ? 'active' : '' }}">
                    <a href="{{ route('curriculum.departments', auth()->user()->university_id) }}" class="nav-link ">
                        <i class="icon-list"></i>
                        <span class="title">{{ trans('general.departments_list') }}</span>                    
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if (auth()->user()->can(['view-teacher']))
        <li class="nav-item start {{ request()->is('teachers*') ? 'active' : '' }}">
            <a href="#" class="nav-link nav-toggle">
                <i class="icon-grid"></i>
                <span class="title">{{ trans('general.teachers') }}</span>
                <span class="arrow {{ request()->is('teachers*') ? 'open' : '' }}"></span>
            </a>
            <ul class="sub-menu">            
                <li class="nav-item {{ request()->is('teachers') ? 'active' : '' }}">
                    <a href="{{ route('teachers.index') }}" class="nav-link ">
                        <i class="icon-list"></i>
                        <span class="title">{{ trans('general.teachers_list') }}</span>                    
                    </a>
                </li> 
                @if (auth()->user()->can(['create-teacher']))          
                <li class="nav-item {{ request()->is('teachers/create') ? 'active' : '' }}">
                    <a href="{{ route('teachers.create') }}" class="nav-link ">
                        <i class="icon-plus"></i>
                        <span class="title">{{ trans('general.create_teacher') }}</span>
                    </a>
                </li>
                @endif            
            </ul>
        </li>
        @endif

        @if (auth()->user()->can(['view-course']))
        <li class="nav-item start {{ request()->is('courses*') ? 'active' : '' }}">
            <a href="#" class="nav-link nav-toggle">
                <i class="icon-grid"></i>
                <span class="title">{{ trans('general.courses') }}</span>
                <span class="arrow {{ request()->is('courses*') ? 'open' : '' }}"></span>
            </a>
            <ul class="sub-menu">            
                <li class="nav-item {{ request()->is('courses') ? 'active' : '' }}">
                    <a href="{{ route('courses.index') }}" class="nav-link ">
                        <i class="icon-list"></i>
                        <span class="title">{{ trans('general.courses_list') }}</span>                    
                    </a>
                </li> 
                @if (auth()->user()->can(['create-course']))          
                <li class="nav-item {{ request()->is('courses/create') ? 'active' : '' }}">
                    <a href="{{ route('courses.create') }}" class="nav-link ">
                        <i class="icon-plus"></i>
                        <span class="title">{{ trans('general.create_course') }}</span>
                    </a>
                </li>
                @endif            
            </ul>
        </li>
        @endif

        @if (auth()->user()->can(['view-user', 'view-role']))
        <li class="nav-item start {{ (request()->is('users*') or request()->is('roles*')) ? 'active' : '' }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-users"></i>
                <span class="title">{{ trans('general.users') }}</span>
                <span class="arrow {{ request()->is('users*') ? 'open' : '' }}"></span>
            </a>
            <ul class="sub-menu">
                @if (auth()->user()->can(['view-user']))
                <li class="nav-item {{ request()->is('users') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="nav-link ">
                        <i class="icon-list"></i>
                        <span class="title">{{ trans('general.users_list') }}</span>                    
                    </a>
                </li>           
                @endif
                @if (auth()->user()->can(['create-user']))
                <li class="nav-item {{ request()->is('users/create') ? 'active' : '' }}">
                    <a href="{{ route('users.create') }}" class="nav-link ">
                        <i class="icon-plus"></i>
                        <span class="title">{{ trans('general.create_account') }}</span>
                    </a>
                </li>
                @endif
                @if (auth()->user()->can(['view-role']))
                <li class="nav-item {{ request()->is('roles') ? 'active' : '' }}">
                    <a href="{{ route('roles.index') }}" class="nav-link ">
                        <i class="icon-list"></i>
                        <span class="title">{{ trans('general.roles_list') }}</span>                    
                    </a>
                </li>
                @endif
                @if (auth()->user()->can(['create-role']))
                <li class="nav-item {{ request()->is('roles/create') ? 'active' : '' }}">
                    <a href="{{ route('roles.create') }}" class="nav-link ">
                        <i class="icon-plus"></i>
                        <span class="title">{{ trans('general.create_role') }}</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        
        <!-- activity log -->

        @can('view-user')
        <li class="nav-item start {{ request()->is('activity') ? 'active' : '' }}">
            <a href="{{ route('activity') }}" class="nav-link nav-toggle">
            <i class="fa fa-bar-chart-o"> </i>
                <span class="text-muted">{{ trans('general.activity') }}</span>      
            </a>       
        </li>
        @endcan
    @endif

    @if(auth('teacher')->check())
    <li class="nav-item start {{ request()->is('teacher.timetable.course') ? 'active' : '' }}">
        <a href="{{ route('teacher.timetable.course') }}" class="nav-link nav-toggle">
            <i class="icon-earphones-alt"></i>            
            <span class="title">{{ trans('general.timetable') }}</span>         
        </a>       
    </li>
    @endif



    <li class="nav-item start {{ request()->is('support') ? 'active' : '' }}">
        <a href="{{ auth('user')->check() ? route('support') : (auth('teacher')->check() ? route('teacher.support') : '') }}" class="nav-link nav-toggle">
            <i class="icon-earphones-alt"></i>            
            <span class="title">{{ trans('general.support') }}</span>         
        </a>       
    </li>

    {{-- <li class="nav-item start {{ request()->is('settings') ? 'active' : '' }}">
        <a href="{{  route('setting') }}" class="nav-link nav-toggle">
            <i class="icon-earphones-alt"></i>            
            <span class="title">{{ trans('general.settings') }}</span>         
        </a>       
    </li> --}}
    
</ul>