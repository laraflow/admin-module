<li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="{{ $authUser->getFirstMediaUrl('avatars') }}"
             class="user-image img-circle" alt="User Image">
        {{--        <span class="d-none d-md-inline text-capitalize">{{ $authUser->name }}</span>--}}
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-white">
            <img src="{{ $authUser->getFirstMediaUrl('avatars') }}"
                 class="img-circle elevation-2" alt="{{ $authUser->name }}">

            <p class="text-capitalize font-weight-bold">
                {{ $authUser->name }}
                @if($authUser->roles->first() != null)
                    <br>
                    <small class="text-warning text-sm">{{ $authUser->roles->first()->name }}</small>
                @endif
            </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body border-bottom-0 border-top-0">
            <div class="row">
                <div class="col-4 text-center">
                    <a href="#">Followers</a>
                </div>
                <div class="col-4 text-center">
                    <a href="#">Sales</a>
                </div>
                <div class="col-4 text-center">
                    <a href="#">Friends</a>
                </div>
            </div>
            <!-- /.row -->
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <a href="{{ route('admin.users.show', $authUser->id) }}" class="btn btn-default btn-flat">Profile</a>
            <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-default btn-flat float-right">Sign
                out</a>
        </li>
    </ul>
</li>
