<aside>
      <div id="sidebar" class="nav-collapse ">
      
        <ul class="sidebar-menu">
          <li class="{{(request()->segment(2) == 'home') ? 'active': ''}}">
            <a class="" href="{{route('admin_home')}}">
                  <i class="icon_house_alt"></i>
                  <span>Home </span>
            </a>
          </li>
          
          
          <li class="{{(request()->segment(2) == 'reservations') ? 'active': ''}}">
            <a class="" href="{{route('admin_reservations')}}">
                <i class="icon_genius"></i>
                <span>Reservations</span>
            </a>
          </li>

           <li class="{{(request()->segment(2) == 'rooms') ? 'active': ''}}">
            <a class="" href="{{route('admin_rooms')}}">
                <i class="icon_house_alt"></i>
                <span>Rooms</span>
            </a>
          </li>

          <div style="margin-top: 400px">
            <li class="{{(request()->segment(2) == 'user-lists') ? 'active': ''}}" >
            <a class="" href="{{route('admin_user_lists')}}">
                <i class="icon_cogs"></i>
                <span>USERS</span>
            </a>
          </li>

          <li class="{{(request()->segment(2) == 'record-lists') ? 'active': ''}}" >
            <a class="" href="{{route('admin_record_lists')}}">
                <i class="icon_document_alt"></i>
                <span>RECORDS</span>
            </a>
          </li>
          </div>
          
        </ul>
        
      </div>
    </aside>