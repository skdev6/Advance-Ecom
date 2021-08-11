<div class="card">
    <div class="card-body">
        <img src="{{asset(Auth::user()->avater)}}" alt="" class="rounded w-100">
        <ul class="list-group mt-4">
            <li><a href="{{route('admin.profile')}}">Home</a></li>
            <li><a href="{{route('admin.image')}}">Update Image</a></li>
            <li><a href="{{route('admin.change.password')}}">Update Password</a></li>
            <li>
                <a href="{{ route('logout') }}" onclick=" event.preventDefault(); document.getElementById('logout-form').submit(); "></i> {{__('Logout')}} </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>