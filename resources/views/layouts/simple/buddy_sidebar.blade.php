<div class="iconsidebar-menu">
    <div class="sidebar">
       <ul class="iconMenu-bar custom-scrollbar">
          <li>
             <a class="bar-icons" href="{{ route('buddy_dashboard') }}">
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
             <a class="bar-icons" href="../buddy"><i class="pe-7s-portfolio"></i><span>Buddy Info</span></a>
             {{-- <ul class="iconbar-mainmenu custom-scrollbar">
                <li class="iconbar-header">Ui Elements</li>
                <li><a>State color</a></li>
                <li><a >Typography</a></li>
                <li><a>Buttons </a></li>
                <li><a>Avatars</a></li>
             </ul> --}}
          </li>
          <li>
             <span class="badge badge-pill badge-danger">Hot</span><a class="bar-icons" href="#"><i class="pe-7s-diamond"></i><span>Profile</span></a>
             {{-- <ul class="iconbar-mainmenu custom-scrollbar">
                <li class="iconbar-header">Animation</li>
                <li><a>Animate</a></li>
                <li><a>Scroll Reveal</a></li>
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
                <li><a>Tabbed Card</a></li>
             </ul> --}}
          </li>
          <li>
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
