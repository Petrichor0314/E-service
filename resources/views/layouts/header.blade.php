 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light" >
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>

     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
         <!-- Navbar Search -->



     </ul>
 </nav>
 <!-- /.navbar -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: black;">

     <!-- Brand Logo -->
     <a href="javascript:;" class="brand-link" style="text-align: center">
        <img style="width:auto; height: 55px" src="{{url('upload/profile/logoedit.png')}}">
         </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img style="height: 40px; width: 40px" src="{{ Auth::user()->getProfileDirect() }}" class="img-circle elevation-2"
                     alt="{{ Auth::user()->name }}">
             </div>
             <div class="info">
                 <a href="#" class="d-block" style="font-size: 1.15rem">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</a>
             </div>
         </div>

         <!-- SidebarSearch Form -->


         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other iicon font library -->


                 @if (Auth::user()->user_type == 1)
                     <li class="nav-item">
                         <a href="{{ url('admin/dashboard') }}"
                             class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                             <i class="nav-icon fas fa-tachometer-alt"></i>
                             <p>
                                 Dashboard

                             </p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="{{ url('admin/departement/list') }}"
                             class="nav-link @if (Request::segment(2) == 'departement') active @endif">
                             <i class="nav-icon fa-solid fa-landmark"></i>
                             <p>
                                 Départements
                             </p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="{{ url('admin/filiere/list') }}"
                             class="nav-link @if (Request::segment(2) == 'filiere') active @endif">
                             <i class="nav-icon fa-solid fa-graduation-cap"></i>
                             <p>
                                 Filières
                             </p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="{{ url('admin/admin/list') }}"
                             class="nav-link @if (Request::segment(2) == 'admin') active @endif">
                             <i class="nav-icon far fa-user"></i>
                             <p>
                                 Admins
                             </p>
                         </a>
                     </li>


                     <li class="nav-item">
                         <a href="{{ url('admin/teacher/list') }}"
                             class="nav-link @if (Request::segment(2) == 'teacher') active @endif">
                             <i class=" nav-icon fa-solid fa-chalkboard-user"></i>
                             <p>
                                 Professeurs
                             </p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="{{ url('admin/student/list') }}"
                             class="nav-link @if (Request::segment(2) == 'student') active @endif">
                             <i class="nav-icon fas fa-user-graduate"></i>
                             <p>
                                 Etudiants
                             </p>
                         </a>
                     </li>
                     <li class="nav-item   @if (Request::segment(2) == 'class' ||
                             Request::segment(2) == 'subject' ||
                             Request::segment(2) == 'assign_subject' ||
                             Request::segment(2) == 'assign_subject_teacher' ||
                             Request::segment(2) == 'class_timetable') menu-is-opening menu-open @endif">
                         <a href="#" class="nav-link  @if (Request::segment(2) == 'class' ||
                                 Request::segment(2) == 'subject' ||
                                 Request::segment(2) == 'assign_subject' ||
                                 Request::segment(2) == 'assign_subject_teacher' ||
                                 Request::segment(2) == 'class_timetable') active @endif">
                             <i class="nav-icon fas fa-table"></i>
                             <p>
                                 Academics
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="{{ url('admin/class/list') }}"
                                     class="nav-link @if (Request::segment(2) == 'class') active @endif">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Class </p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('admin/subject/list') }}"
                                     class="nav-link @if (Request::segment(2) == 'subject') active @endif">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Subject</p>
                                 </a>
                             </li>
                            
                             <li class="nav-item">
                                 <a href="{{ url('admin/class_timetable/list') }}"
                                     class="nav-link @if (Request::segment(2) == 'class_timetable') active @endif">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Class Timetable</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('admin/assign_subject_teacher/list') }}"
                                     class="nav-link @if (Request::segment(2) == 'assign_subject_teacher') active @endif">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Assign Subject Teacher</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     <li class="nav-item">
                         <a href="{{ url('admin/account') }}"
                             class="nav-link @if (Request::segment(2) == 'account') active @endif">
                             <i class="nav-icon far fa-address-card"></i>
                             <p>
                                 My Account
                             </p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="{{ url('admin/change_password') }}"
                             class="nav-link @if (Request::segment(2) == 'change_password') active @endif">
                             <i class="nav-icon fas fa-key"></i>
                             <p>
                                 Change Password
                             </p>
                         </a>
                     </li>
                 @elseif(Auth::user()->user_type == 2)
                     <li class="nav-item">
                         <a href="{{ url('teacher/dashboard') }}"
                             class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                             <i class="nav-icon fa-solid fa-school"></i>
                             <p>
                                 Dashboard

                             </p>
                         </a>
                     </li>

                     @if ($is_departement_head)
                         <li class="nav-item">
                             <a href="{{ url('head/modules/index') }}"
                                 class="nav-link @if (Request::segment(2) == 'modules') active @endif">
                                 <i class="nav-icon fa-solid fa-book"></i> 
                                  <p>

                                     Modules de département

                                 </p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ url('head/enseignants/index') }}"
                                 class="nav-link @if (Request::segment(2) == 'enseignants') active @endif">
                                 <i class="nav-icon fa-solid fa-chalkboard-user"></i>                                
                                  <p>

                                     Corps enseignant

                                 </p>
                             </a>
                         </li>
                     @endif

                     @if ($is_sector_coordinator)
                         <li class="nav-item">
                             <a href="{{ url('coordinator/modules') }}"
                                 class="nav-link @if (Request::segment(2) == 'modules') active @endif">
                                 <i class="nav-icon fa-solid fa-book"></i> 
                                 <p>

                                     Modules de filière

                                 </p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ url('coordinator/affichage') }}"
                                 class="nav-link @if (Request::segment(2) == 'affichage') active @endif">
                                 <i class="nav-icon fas fa-tachometer-alt"></i>
                                 <p>

                                     Affichage des notes

                                 </p>
                             </a>
                         </li>
                     @endif


                     <li class="nav-item">
                         <a href="{{ url('teacher/marks') }}"
                             class="nav-link @if (Request::segment(2) == 'marks') active @endif">
                             <i class="nav-icon fa-solid fa-marker"></i>  
                             <p>
                                 Notes

                             </p>
                         </a>
                     </li>

                    
                     <li class="nav-item   @if (Request::segment(2) == 'attendance') menu-is-opening menu-open @endif">
                         <a href="#" class="nav-link  @if (Request::segment(2) == 'attendance') active @endif">
                          <i class="nav-icon fa-solid fa-clipboard-user"></i>
                          <p>
                                 Attendance
                           </p>
                         </a>
                         <ul class="nav nav-treeview" style="background-color:rgb(0, 120, 232)">

                             <li class="nav-item" >
                                 <a href="{{ url('teacher/attendance/student') }}"
                                     class="nav-link @if (Request::segment(3) == 'student') active @endif">
                                     <i class="nav-icon fa-solid fa-pen-nib"></i>
                                     <p>
                                         Student Attendance

                                     </p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('teacher/attendance/report') }}"
                                     class="nav-link @if (Request::segment(3) == 'report') active @endif">
                                     <i class="nav-icon fa-solid fa-pen-nib"></i>
                                     <p>
                                         Attendance Report

                                     </p>
                                 </a>   
                             </li>

                         </ul>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('admin/class_timetable/list') }}"
                            class="nav-link @if (Request::segment(2) == 'class_timetable') active @endif">
                            <i class="nav-icon fa-regular fa-calendar-days"></i>                            
                            <p> Class Timetable</p>
                        </a>
                    </li>
                     <li class="nav-item">
                         <a href="{{ url('teacher/my_timetable') }}"
                             class="nav-link @if (Request::segment(2) == 'my_timetable') active @endif">
                             <i class=" nav-icon fa-solid fa-business-time"></i>
                             <p>
                                 My Timetable

                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ url('teacher/account') }}"
                            class="nav-link @if (Request::segment(2) == 'account') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                My Account

                            </p>
                        </a>
                    </li>
                     <li class="nav-item">
                         <a href="{{ url('teacher/change_password') }}"
                             class="nav-link @if (Request::segment(2) == 'change_password') active @endif">
                             <i class="nav-icon fa-solid fa-lock"></i>
                             <p>
                                 Change Password
                             </p>
                         </a>
                     </li>
                 @elseif(Auth::user()->user_type == 3)
                     <li class="nav-item">
                         <a href="{{ url('student/dashboard') }}"
                             class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                             <i class="nav-icon fa-solid fa-school"></i>
                             <p>
                                 Dashboard

                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ url('student/my_subject') }}"
                             class="nav-link @if (Request::segment(2) == 'my_subject') active @endif">
                             <i class="nav-icon fas fa-book"></i>
                             <p>
                                 My Subject

                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ url('student/my_timetable') }}"
                             class="nav-link @if (Request::segment(2) == 'my_timetable') active @endif">
                             <i class=" nav-icon fa-solid fa-business-time"></i>
                             <p>
                                 My Timetable

                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ url('student/account') }}"
                             class="nav-link @if (Request::segment(2) == 'account') active @endif">
                             <i class="nav-icon far fa-user"></i>
                             <p>
                                 My Account

                             </p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="{{ url('student/change_password') }}"
                             class="nav-link @if (Request::segment(2) == 'change_password') active @endif">
                             <i class="nav-icon fa-solid fa-lock"></i>
                             <p>
                                 Change Password
                             </p>
                         </a>
                     </li>
                 @endif



                 <li class="nav-item" style="margin-left: 3px;">
                     <a href="{{ url('logout') }}" class="nav-link">
                         <i class="nav-icon fa-solid fas fa-right-from-bracket"></i>
                         <p>
                             Logout
                         </p>
                     </a>
                 </li>

                 

             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
