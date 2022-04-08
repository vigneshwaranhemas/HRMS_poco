<div class="iconsidebar-menu">
   <div class="sidebar">
      <ul class="iconMenu-bar custom-scrollbar">
         <li>
            <a class="bar-icons" href="#">
               <!--img(src='../assets/images/menu/home.png' alt='')--><i class="pe-7s-home"></i><span>Dashboard    </span>
            </a>
            {{-- <ul class="iconbar-mainmenu custom-scrollbar">
               <li class="iconbar-header">Dashboard</li>
               <li><a >Default</a></li>
               <li><a>Crypto</a></li>
               <li><a >Ecommerce</a></li>
               <li class="iconbar-header sub-header">Widgets</li>
               <li><a >General widget</a></li>
               <li><a >Chart widget</a></li>
            </ul> --}}
         </li>
         <li>
            <a class="bar-icons" href="#"><i class="pe-7s-portfolio"></i><span>Masters</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
               <li class="iconbar-header">Masters</li>
               <li><a href="{{ route('business') }}">Business Unit</a></li>
               <li><a href="{{ route('division') }}">Division</a></li>
               <li><a href="{{ route('function') }}">Function </a></li>
               <li><a href="{{ route('grade') }}">Grade</a></li>
               <li><a href="{{ route('band') }}">Band</a></li>
               <li><a href="{{ route('location') }}">Work Location</a></li>
               <li><a href="{{ route('blood') }}">Blood Group</a></li>
               <li><a href="{{ route('roll') }}">Roll of Intake</a></li>
               <li><a href="{{ route('department') }}">Department</a></li>
               <li><a href="{{ route('designation_or_position') }}">Designation or Position</a></li>
               <li><a href="{{ route('client') }}">Client</a></li>
               <li><a href="{{ route('state') }}">State</a></li>
               <li><a href="{{ route('zone') }}">Zone</a></li>
               <li><a href="{{ route('personnel') }}">Personnel</a></li>
            </ul>
         </li>
         <li>
            <span class="badge badge-pill badge-danger">Hot</span><a class="bar-icons" href="#"><i class="pe-7s-diamond"></i><span>Holidays</span></a>
         </li>
         <li>
            <a class="bar-icons" href="#"><i class="pe-7s-note2"></i><span>Settings</span></a>
             <ul class="iconbar-mainmenu custom-scrollbar">
               <li class="iconbar-header">Settings</li>
               <li><a>Profile Settings</a></li>
               <li><a href="{{url('/permission')}}">Roles & Permissions</a></li>
               <li><a>Function</a>Module Settings</li>
            </ul>
         </li>
         {{-- <li>
            <a class="bar-icons" href="#"><i class="pe-7s-id"></i><span>Tables</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
               <li class="iconbar-header">Bootstrap Tables</li>
               <li><a href="{{route('bootstrap-basic-table')}}">Basic Tables</a></li>
               <li><a href="{{route('bootstrap-sizing-table')}}">Sizing Tables</a></li>
               <li><a href="{{route('bootstrap-border-table')}}">Border Tables</a></li>
               <li><a href="{{route('bootstrap-styling-table')}}">Styling Tables</a></li>
               <li><a href="{{route('table-components')}}">Table components</a></li>
               <li class="iconbar-header sub-header">Data Tables</li>
               <li><a href="{{route('datatable-basic-init')}}">Basic Init</a></li>
               <li><a href="{{route('datatable-advance')}}">Advance Init</a></li>
               <li><a href="{{route('datatable-styling')}}">Styling</a></li>
               <li><a href="{{route('datatable-ajax')}}">AJAX</a></li>
               <li><a href="{{route('datatable-server-side')}}">Server Side</a></li>
               <li><a href="{{route('datatable-plugin')}}">Plug-in</a></li>
               <li><a href="{{route('datatable-api')}}">API</a></li>
               <li><a href="{{route('datatable-data-source')}}">Data Sources</a></li>
               <li class="iconbar-header sub-header">Extension Data Tables</li>
               <li><a href="{{route('datatable-ext-autofill')}}">Auto Fill</a></li>
               <li><a href="{{route('datatable-ext-basic-button')}}">Basic Button</a></li>
               <li><a href="{{route('datatable-ext-col-reorder')}}">Column Reorder</a></li>
               <li><a href="{{route('datatable-ext-fixed-header')}}">Fixed Header</a></li>
               <li><a href="{{route('datatable-ext-html-5-data-export')}}">HTML 5 Export</a></li>
               <li><a href="{{route('datatable-ext-key-table')}}">Key Table</a></li>
               <li><a href="{{route('datatable-ext-responsive')}}">Responsive</a></li>
               <li><a href="{{route('datatable-ext-row-reorder')}}">Row Reorder</a></li>
               <li><a href="{{route('datatable-ext-scroller')}}">Scroller</a></li>
               <li><a href="{{route('jsgrid-table')}}">Js Grid Table</a></li>
            </ul>
         </li>
         <li>--}}
            <a class="bar-icons" href="{{url('Hr_SeatingRequest')}}"><i class="pe-7s-paperclip"></i></i><span>Seating Request</span></a>
         </li>
      </ul>
   </div>
</div>
