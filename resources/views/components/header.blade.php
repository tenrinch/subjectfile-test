<div class="c-wrapper">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader d-print-none">
        <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button><a class="c-header-brand d-sm-none" href="#"><img class="c-header-brand" src="{{ url('/assets/brand/coreui-base.svg" width="97" height="46" alt="CoreUI Logo"></a>
        <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
        <?php
            use App\MenuBuilder\FreelyPositionedMenus;
            if(isset($appMenus['top menu'])){
                FreelyPositionedMenus::render( $appMenus['top menu'] , 'c-header-', 'd-md-down-none');
            }
        ?>  
        <div class="ml-auto h2 my-auto" style="font-family: Dutsa;">ལོ་རྒྱུས་འབྲི་རྩོམ་དང་བར་བརྒལ་ལས་བཀོད་སྡེ་ཚན།</div>
        <ul class="c-header-nav ml-auto mr-4">
          
            <li class="c-header-nav-item dropdown">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="c-avatar"><img class="c-avatar-img" src="{{ url('/assets/img/avatars/6.jpg') }}" alt="user@email.com">
                </div>
                </a>
                @can('user_management_access') 
                <div class="dropdown-menu dropdown-menu-right pt-0">
                   
                    <div class="dropdown-header bg-light py-2"><strong>User Settings</strong></div>
                    @can('user_access')
                    <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                        <i class="cil-people c-icon mr-2"></i>
                        {{ trans('cruds.user.title') }}
                    </a>
                    @endcan
                    @can('permission_access')
                    <a class="dropdown-item" href="{{ route('admin.permissions.index') }}">
                        <i class="cil-badge c-icon mr-2"></i>
                        {{ trans('cruds.permission.title') }}
                    </a>
                    @endcan
                    @can('role_access')
                    <a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                        <i class="cil-contact c-icon mr-2"></i>
                        {{ trans('cruds.role.title') }}
                    </a>
                    @endcan
                </div>
                @endcan
            </li>
        </ul>
    </header>