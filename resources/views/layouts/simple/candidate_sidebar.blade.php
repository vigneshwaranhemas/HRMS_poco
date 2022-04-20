<div class="iconsidebar-menu">
    <div class="sidebar">
       <ul class="iconMenu-bar custom-scrollbar">
          <li>
             <a class="bar-icons" href="{{ route('candidate_dashboard') }}">
                <!--img(src='../assets/images/menu/home.png' alt='')--><i class="pe-7s-home"></i><span>Dashboard    </span>
             </a>
          </li>
          <li>
             <a class="bar-icons" href="#"><i class="pe-7s-portfolio"></i><span>Pre OnBoarding</span></a>
             <ul class="iconbar-mainmenu custom-scrollbar">
                <li class="iconbar-header">Pre OnBoarding</li>
                <li><a href="{{url('preOnboarding')}}">Pre OnBoarding</a></li>
                <li><a href="{{url('Candidate_Induction')}}">Induction Schedule</a></li>
                <li><a href="{{url('Candidate_Assigned_Buddy')}}">Buddy Info </a></li>
                <li><a href="{{url('Buddy_feedback')}}">Buddy Feedback</a></li>
                <li><a href="{{ url('welcome_aboard') }}">Welcome Aboard</a></li>
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
             <a class="bar-icons" href="#"><i class="pe-7s-target"></i><span>Goals</span></a>
             <ul class="iconbar-mainmenu custom-scrollbar">
                <li class="iconbar-header">Goals</li>
                <li><a href="{{ route('goals') }}">Goals</a></li>
               <li><a href="{{ route('goal_setting') }}">Goal Setting</a></li>
             </ul>
         </li>
         <li>
            <a class="bar-icons" href="{{ route('holidays') }}"><i class="pe-7s-plane"></i><span>Holidays</span></a>
         </li>
         <li>
            <a class="bar-icons" href="{{ route('events') }}"><i class="pe-7s-note"></i><span>Events</span></a>
         </li>
       </ul>
    </div>
 </div>
