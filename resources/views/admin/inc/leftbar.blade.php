<div class="sl-logo"><a href="{{route('admin.dashboard')}}"><i class="icon ion-android-star-outline"></i> starlight</a></div>
<div class="sl-sideleft">
  <div class="input-group input-group-search">
    <input type="search" name="search" class="form-control" placeholder="Search">
    <span class="input-group-btn">
      <button class="btn"><i class="fa fa-search"></i></button>
    </span><!-- input-group-btn -->
  </div><!-- input-group -->

  <label class="sidebar-label">Navigation</label>
  <div class="sl-sideleft-menu">
    <a href="{{route('admin.dashboard')}}" class="sl-menu-link">
      <div class="sl-menu-item">
        <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
        <span class="menu-item-label">Dashboard</span>
      </div>
    </a>
    @isset(auth()->user()->role->peression['permisson']['brand']['view'])
    <a href="{{route('admin.brand')}}" class="sl-menu-link @yield('brand')">
      <div class="sl-menu-item">
        <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
        <span class="menu-item-label">Brand</span>
      </div>
    </a>
    @endisset
    @isset(auth()->user()->role->peression['permisson']['slider']['add'])
      <a href="{{route('admin.slider')}}" class="sl-menu-link @yield('slider')">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
          <span class="menu-item-label">Slider</span>
        </div>
      </a>
    @endisset
    <a href="#" class="sl-menu-link @yield('category')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
        <span class="menu-item-label">Category</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item"><a href="{{route('admin.category')}}" class="nav-link @yield('category')">Add Category</a></li>
      <li class="nav-item"><a href="{{route('admin.sub-category')}}" class="nav-link @yield('sub-category')">Sub Category</a></li>
      <li class="nav-item"><a href="{{route('admin.sub-sub-category')}}" class="nav-link @yield('sub-sub-category')">Sub Sub Category</a></li>
    </ul>
    @isset(auth()->user()->role->peression['permisson']['product']['add'])
    <a href="#" class="sl-menu-link @yield('product')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
        <span class="menu-item-label">Product</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item"><a href="{{route('admin.add-product')}}" class="nav-link @yield('category')">Add Product</a></li>
      <li class="nav-item"><a href="{{route('admin.product.index')}}" class="nav-link @yield('sub-category')">Manage Product</a></li>
    </ul>
    @endisset
    @isset(auth()->user()->role->peression['permisson']['coupon']['add'])
    <a href="{{route('admin.coupon')}}" class="sl-menu-link @yield('coupon')">
      <div class="sl-menu-item">
        <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
        <span class="menu-item-label">Coupons</span>
      </div>
    </a>
    @endisset
    <a href="#" class="sl-menu-link @yield('shipping')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
        <span class="menu-item-label">Shipping area</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item"><a href="{{route('admin.ship.area')}}" class="nav-link @yield('shipping-division')">Division</a></li>
      <li class="nav-item"><a href="{{route('admin.ship.district.area')}}" class="nav-link @yield('shipping-district')">Add District</a></li>
      <li class="nav-item"><a href="{{route('admin.ship.state.area')}}" class="nav-link @yield('shipping-state')">Add State</a></li>
    </ul>
    <a href="#" class="sl-menu-link @yield('order')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
        <span class="menu-item-label">Order</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item"><a href="{{route('admin.pending.order')}}" class="nav-link @yield('pending-order')">Pending</a></li>
      <li class="nav-item"><a href="{{route('admin.confirem.order')}}" class="nav-link @yield('Confirmed-order')">Confirmed</a></li>
      <li class="nav-item"><a href="{{route('admin.processing.order')}}" class="nav-link @yield('Processing-order')">Processing</a></li>
      <li class="nav-item"><a href="{{route('admin.picked.order')}}" class="nav-link @yield('picked-order')">picked</a></li>
      <li class="nav-item"><a href="{{route('admin.shipped.order')}}" class="nav-link @yield('Shipped-order')">Shipped</a></li>
      <li class="nav-item"><a href="{{route('admin.delivered.order')}}" class="nav-link @yield('Delivered-order')">Delivered</a></li>
      <li class="nav-item"><a href="{{route('admin.cancel.order')}}" class="nav-link @yield('Cancel-order')">Cancel</a></li>
    </ul>
    <a href="#" class="sl-menu-link @yield('role')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
        <span class="menu-item-label">Role Manegment</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item"><a href="{{route('admin.role.index')}}" class="nav-link @yield('all-role')">All Role</a></li>
      <li class="nav-item"><a href="{{route('admin.role.create')}}" class="nav-link @yield('add-role')">Add Role</a></li>
    </ul>
    <a href="#" class="sl-menu-link @yield('permiession')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
        <span class="menu-item-label">Permiession</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item"><a href="{{route('admin.permiession.index')}}" class="nav-link @yield('all-permiession')">All Permiession</a></li>
      <li class="nav-item"><a href="{{route('admin.permiession.create')}}" class="nav-link @yield('add-permiession')">Add Permiession</a></li>
    </ul>
    <a href="#" class="sl-menu-link @yield('subadmin')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
        <span class="menu-item-label">Sub Admin</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item"><a href="{{route('admin.subadmin.index')}}" class="nav-link @yield('all-subadmin')">All Sub Admin</a></li>
      <li class="nav-item"><a href="{{route('admin.subadmin.create')}}" class="nav-link @yield('add-subadmin')">Add Sub Admin</a></li>
    </ul>
  </div>
  <br>
</div>