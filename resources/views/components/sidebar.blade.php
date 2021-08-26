<div class="c-sidebar-brand">
    <img src="{{asset('assets/img/logo.png')}}" class="w-25 p-1 m-2">
</div>

<ul class="c-sidebar-nav ps ps--active-y">
    <li class="c-sidebar-nav-item ">
        <a class="c-sidebar-nav-link" href="{{url('/')}}">
            <i class="cil-home c-sidebar-nav-icon"></i>
            Home
         </a>
    </li>

    <li class="c-sidebar-nav-title">Subject Files</li>
    @can('incoming_access')  
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ url('staff/incomings') }}">
            <i class="fas fa-file-import c-sidebar-nav-icon"></i>
            Incoming Files
        </a>
    </li>
    @endcan

    @can('outgoing_access')
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ url('staff/outgoings') }}">
            <i class="fas fa-file-export c-sidebar-nav-icon"></i>
            Outgoing Files
        </a>
    </li>
    @endcan
    
    <li class="c-sidebar-nav-title">Settings</li>  

    <li class="">
        <a class="c-sidebar-nav-link" href="{{url('staff/categories')}}">
            <i class="fas fa-list-ul c-sidebar-nav-icon"></i>
            File Category
        </a>
    </li>

    <li class="">
        <a class="c-sidebar-nav-link" href="{{ url('staff/sender-destinations')}}">
            <i class="fas fa-shipping-fast c-sidebar-nav-icon"></i>
            Sender/Destination
        </a>
    </li>

    @can('department_access')
    <li class="">
        <a class="c-sidebar-nav-link" href="{{ url('admin/departments')}}">
            <i class="far fa-building c-sidebar-nav-icon"></i>
            Departments
        </a>
    </li>
    @endcan
    
    @can('staff_manage')
    <li class="">
        <a class="c-sidebar-nav-link" href="{{url('coordinator/staff')}}">
            <i class="fas fa-user-tie c-sidebar-nav-icon"></i>
            Staff
        </a>
    </li>
    @endcan

    <li class="">
        <a class="c-sidebar-nav-link" href="{{ route('profile.show') }}">
            <i class="fas fa-user-cog c-sidebar-nav-icon"></i>
            My Profile
        </a>
    </li> 

    <li class="">
        <a class="c-sidebar-nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
            <i class="cil-account-logout c-sidebar-nav-icon"></i>
            Logout
        </a>
    </li>     
</ul>


<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized">
</button>

</div>

                
