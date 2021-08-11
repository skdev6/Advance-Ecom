<ul class="list-group mt-4">
    <li><a href="{{url('/')}}">Home</a></li>
    <li><a href="{{route('user.image')}}">Update Image</a></li>
    <li><a href="{{route('user.updatePassword')}}">Update Password</a></li>
    <li><a href="{{route('user.order.view')}}">Order</a></li>
    <li><a href="{{route('user.order.view')}}">Return Order</a></li>
    <li><a href="{{route('user.order.view')}}">Cancel Order</a></li>
    <li>
        <a href="{{ route('logout') }}" onclick=" event.preventDefault(); document.getElementById('logout-form').submit(); "></i> {{__('Logout')}} </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
</ul>