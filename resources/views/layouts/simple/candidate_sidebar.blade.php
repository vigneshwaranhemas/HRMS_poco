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
             <a class="bar-icons" href="#"><i class="pe-7s-portfolio"></i><span>Pre OnBoarding</span></a>
             <ul class="iconbar-mainmenu custom-scrollbar">
                <li class="iconbar-header">Pre OnBoarding</li>
                <li><a href="{{url('preOnboarding')}}">Pre OnBoarding</a></li>
                <li><a >Induction Schedule</a></li>
                <li><a>Buddy Info </a></li>
                <li><a href="{{url('Buddy_feedback')}}">Buddy Feedback</a></li>
             </ul>
          </li>
          <li>
             <span class="badge badge-pill badge-danger">Hot</span><a class="bar-icons" href="#"><i class="pe-7s-diamond"></i><span>Profile</span></a>
              <ul class="iconbar-mainmenu custom-scrollbar">
                <li class="iconbar-header">Profile</li>
                <li><a href="{{url('../candidate_profile')}}">My Profile</a></li>
                <!-- <li><a>Scroll Reveal</a></li>
                <li><a>AOS animation</a></li>
                <li><a>Tilt Animation</a></li>
                <li><a>Wow Animation</a></li>
                <li class="iconbar-header sub-header">Menu Options</li>
                <li><a>Hide menu on Scroll</a></li>
                <li><a>Vertical Menu</a></li>
                <li><a>Mega Menu</a></li>
                <li><a>Fix header</a></li>
                <li><a>Fix Header & sidebar</a></li>
                <li class="iconbar-header sub-header">Cards</li>
                <li><a>Basic Card</a></li>
                <li><a>Theme Card</a></li>
                <li><a>Tabbed Card</a></li> -->
             </ul> 
          </li>
          {{-- <li>
             <a class="bar-icons" href="#"><i class="pe-7s-note2"></i><span>Forms</span></a>
             <ul class="iconbar-mainmenu custom-scrollbar">
                <li class="iconbar-header">Form Controls</li>
                <li><a href="{{route('form-validation')}}">Form Validation</a></li>
                <li><a href="{{route('base-input')}}">Base Inputs</a></li>
                <li><a href="{{route('radio-checkbox-control')}}">Checkbox & Radio</a></li>
                <li><a href="{{route('input-group')}}">Input Groups</a></li>
                <li><a href="{{route('megaoptions')}}">Mega Options</a></li>
                <li class="iconbar-header sub-header">Form Widgets</li>
                <li><a href="{{route('datepicker')}}">Datepicker</a></li>
                <li><a href="{{route('time-picker')}}">Timepicker</a></li>
                <li><a href="{{route('datetimepicker')}}">Datetimepicker</a></li>
                <li><a href="{{route('daterangepicker')}}">Daterangepicker</a></li>
                <li><a href="{{route('touchspin')}}">Touchspin</a></li>
                <li><a href="{{route('select2')}}">Select2</a></li>
                <li><a href="{{route('switch')}}">Switch</a></li>
                <li><a href="{{route('typeahead')}}">Typeahead</a></li>
                <li><a href="{{route('clipboard')}}">Clipboard</a></li>
                <li class="iconbar-header sub-header">Form Layout</li>
                <li><a href="{{route('default-form')}}">Default Forms</a></li>
                <li><a href="{{route('form-wizard')}}">Form Wizard 1</a></li>
                <li><a href="{{route('form-wizard-two')}}">Form Wizard 2</a></li>
                <li><a href="{{route('form-wizard-three')}}">Form Wizard 3</a></li>
                <li><a href="{{route('form-wizard-four')}}">Form Wizard 4</a></li>
             </ul>
          </li> --}}
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
          <li>
             <a class="bar-icons" href="#"><i class="pe-7s-graph3"></i><span>Charts</span></a>
             <ul class="iconbar-mainmenu custom-scrollbar">
                <li class="iconbar-header">Charts</li>
                <li><a href="{{route('chart-apex')}}">Apex Chart</a></li>
                <li><a href="{{route('chart-google')}}">Google Chart</a></li>
                <li><a href="{{route('chart-sparkline')}}">Sparkline Chart</a></li>
                <li><a href="{{route('chart-flot')}}">Flot Chart</a></li>
                <li><a href="{{route('chart-radial')}}">Radial Chart</a></li>
                <li><a href="{{route('chart-knob')}}">Knob Chart</a></li>
                <li><a href="{{route('chart-morris')}}">Morris Chart</a></li>
                <li><a href="{{route('chartjs')}}">Chatjs Chart</a></li>
                <li><a href="{{route('chartist')}}">Chartist Chart</a></li>
                <li><a href="{{route('chart-peity')}}">Peity Chart</a></li>
             </ul>
          </li>
          <li>
             <a class="bar-icons" href="#"><i class="pe-7s-server"></i><span>Apps</span></a>
             <ul class="iconbar-mainmenu custom-scrollbar">
                <li class="iconbar-header">Ecommerce</li>
                <li><a href="{{route('product')}}">Product</a></li>
                <li><a href="{{route('product-page')}}">Product page</a></li>
                <li><a href="{{route('list-products')}}">Product list</a></li>
                <li><a href="{{route('payment-details')}}">Payment Details</a></li>
                <li><a href="{{route('order-history')}}">Order History</a></li>
                <li><a href="{{route('invoice-template')}}">Invoice</a></li>
                <li><a href="{{route('pricing')}}">Pricing</a></li>
                <li class="iconbar-header sub-header"> Blog</li>
                <li><a href="{{route('blog')}}">Blog Details</a></li>
                <li><a href="{{route('blog-single')}}">Blog Single</a></li>
                <li><a href="{{route('add-post')}}">Add Post</a></li>
                <li class="iconbar-header sub-header">Timeline</li>
                <li><a href="{{route('timeline-v-1')}}">Timeline 1</a></li>
                <li><a href="{{route('timeline-v-2')}}">Timeline 2</a></li>
                <li><a href="{{route('timeline-small')}}">Timeline 3</a></li>
                <li class="iconbar-header sub-header"> Gallery</li>
                <li><a href="{{route('gallery')}}">Gallery Grid</a></li>
                <li><a href="{{route('gallery-with-description')}}">Gallery Grid with Desc</a></li>
                <li><a href="{{route('gallery-masonry')}}">Masonry Gallery</a></li>
                <li><a href="{{route('masonry-gallery-with-disc')}}">Masonry Gallery Desc</a></li>
                <li><a href="{{route('gallery-hover')}}">Hover Effects</a></li>
                <li class="iconbar-header sub-header">Job Search</li>
                <li><a href="{{route('job-cards-view')}}">Cards view</a></li>
                <li><a href="{{route('job-list-view')}}">List View</a></li>
                <li><a href="{{route('job-details')}}">Job Details</a></li>
                <li><a href="{{route('job-apply')}}">Apply</a></li>
                <li class="iconbar-header sub-header">Learning</li>
                <li><a href="{{route('learning-list-view')}}">Learning List</a></li>
                <li><a href="{{route('learning-detailed')}}">Detailed Course</a></li>
             </ul>
          </li>
          <li>
             <span class="badge badge-pill badge-primary">New</span><a class="bar-icons" href="#"><i class="pe-7s-gift"></i><span>Apps</span></a>
             <ul class="iconbar-mainmenu custom-scrollbar">
                <li class="iconbar-header">User</li>
                <li><a href="{{route('user-profile')}}">Users Profile</a></li>
                <li><a href="{{route('edit-profile')}}">Users Edit</a></li>
                <li><a href="{{route('user-cards')}}">Users Cards</a></li>
                <li><a href="{{route('email-application')}}">Email App</a></li>
                <li><a href="{{route('email-compose')}}">Email Compose</a></li>
                <li><a href="{{route('chat')}}">Chat App</a></li>
                <li><a href="{{route('chat-video')}}">Video chat</a></li>
                <li><a href="{{route('calendar')}}">Full Calender Basic</a></li>
                <li><a href="{{route('calendar-event')}}">Full Calender Events</a></li>
                <li><a href="{{route('calendar-advanced')}}">Full Calender Advance</a></li>
                <li><a href="{{route('social-app')}}">Social App</a></li>
                <li><a href="{{route('to-do')}}">To-Do</a></li>
                <li class="iconbar-header sub-header">Editors</li>
                <li><a href="{{route('summernote')}}">Summer Note</a></li>
                <li><a href="{{route('ckeditor')}}">CK editor</a></li>
                <li><a href="{{route('simple-mde')}}">MDE editor</a></li>
                <li><a href="{{route('ace-code-editor')}}">ACE code editor</a></li>
                <li class="iconbar-header sub-header">Others</li>
                <li><a href="{{route('faq')}}">FAQ</a></li>
                <li><a href="{{route('knowledgebase')}}">Knowledgebase</a></li>
                <li><a href="{{route('internationalization')}}">Internationalization</a></li>
                <li class="iconbar-header sub-header">Maps</li>
                <li><a href="{{route('map-js')}}">Maps JS</a></li>
                <li><a href="{{route('vector-map')}}">Vector Maps</a></li>
             </ul>
          </li>
          <li>
             <a class="bar-icons" href="#"><i class="pe-7s-copy-file"></i><span>Pages</span></a>
             <ul class="iconbar-mainmenu custom-scrollbar">
                <li class="iconbar-header">All Pages</li>
                <li><a href="{{route('sample-page')}}">Sample page</a></li>
                <li><a href="{{route('support-ticket')}}">Support Ticket</a></li>
                <li><a href="{{route('search')}}">Search Website</a></li>
                <li><a href="{{route('error-400')}}">Error 400</a></li>
                <li><a href="{{route('error-404')}}">Error 404</a></li>
                <li><a href="{{route('error-500')}}">Error 500</a></li>
                <li><a href="{{route('maintenance')}}">Maintenance</a></li>
                <li><a href="{{route('login')}}">Login Simple</a></li>
                <li><a href="{{route('signup')}}">Register Simple</a></li>
                <li><a href="{{route('forget-password')}}">Forget Password</a></li>
                <li><a href="{{route('comingsoon')}}">Coming Simple</a></li>
                <li><a href="{{route('comingsoon-bg-video')}}">Coming with Bg video</a></li>
                <li><a href="{{route('comingsoon-bg-img')}}">Coming with Bg Image</a></li>
             </ul>
          </li> --}}
       </ul>
    </div>
 </div>
