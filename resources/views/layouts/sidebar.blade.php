@if(Auth::user()->role_id == 'R01')
<div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li id="admin-menu-dashboard" class="menu-item">
        <a href="{{url('admin/home')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Users</span>
    </li>
    <li id="admin-menu-instruktur" class="menu-item">
        <a href="{{url('admin/instruktur/index')}}" class="menu-link">
            
        <i class="menu-icon tf-icons bx bxs-user"></i>
        <div data-i18n="Basic">Instruktur</div>
        </a>
    </li>
    <li id="admin-menu-client" class="menu-item">
        <a href="{{url('admin/client/index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-user-rectangle"></i>
        <div data-i18n="Basic">Client</div>
        </a>
    </li>
    <!-- Components -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Master</span></li>

    <!-- User interface -->
    <li id="admin-menu-layanan" class="menu-item">
        <a href="{{url('admin/layanan/index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-collection"></i>
        <div data-i18n="Basic">Layanan</div>
        </a>
    </li>

    <li id="admin-menu-diskon" class="menu-item">
        <a href="{{url('admin/diskon/index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-discount"></i>
        <div data-i18n="Basic">Diskon</div>
        </a>
    </li>

    

    <!-- Forms & Tables -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Pemesanan &amp; Pemeriksaan</span></li>
    <!-- Forms -->
    <li id="admin-menu-pemesanan" class="menu-item">
        <a href="{{url('admin/pemesanan/index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-mail-send"></i>
        <div data-i18n="Basic">Pemesanan</div>
        </a>
    </li>

    <li id="admin-menu-pemeriksaan" class="menu-item">
        <a href="{{url('admin/pemeriksaan/index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-receipt"></i>
        <div data-i18n="Basic">Pemeriksaan</div>
        </a>
    </li>

    <li id="admin-menu-jadwal" class="menu-item">
        <a href="{{url('admin/jadwal/index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-calendar"></i>
        <div data-i18n="Basic">Jadwal</div>
        </a>
    </li>

    <!-- <li id="admin-menu-history" class="menu-item">
        <a href="{{url('admin/history/index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-history"></i>
        <div data-i18n="Basic">History</div>
        </a>
    </li> -->
    <!-- Misc -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Report</span></li>
    <li id="admin-menu-keuangan" class="menu-item">
        <a href="{{url('admin/keuangan/index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-money"></i>
        <div data-i18n="Basic">Keuangan</div>
        </a>
    </li>
    <li id="admin-menu-rating" class="menu-item">
        <a href="{{url('admin/rating/index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-star"></i>
        <div data-i18n="Basic">Rating</div>
        </a>
    </li>
    </ul>
</aside>
<!-- / Menu -->
@elseif(Auth::user()->role_id == 'R02')
<div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li id="instruktur-menu-home" class="menu-item">
        <a href="{{url('instruktur/home')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Home</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Menu</span>
    </li>
    <li id="instruktur-menu-pemeriksaan" class="menu-item">
        <a href="{{url('instruktur/pemeriksaan/index')}}" class="menu-link">
            
        <i class="menu-icon tf-icons bx bx-list-ul"></i>
        <div data-i18n="Basic">Pemeriksaan</div>
        </a>
    </li>
    <li id="instruktur-menu-rating" class="menu-item">
        <a href="{{url('instruktur/rating/index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-cart-alt"></i>
        <div data-i18n="Basic">Rating</div>
        </a>
    </li>
    
    </ul>
</aside>
@elseif(Auth::user()->role_id == 'R03')
<div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li id="client-menu-home" class="menu-item">
        <a href="{{url('client/home')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Home</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Menu</span>
    </li>
    <li id="client-menu-layanan" class="menu-item">
        <a href="{{url('client/layanan/index')}}" class="menu-link">
            
        <i class="menu-icon tf-icons bx bx-list-ul"></i>
        <div data-i18n="Basic">Layanan</div>
        </a>
    </li>
    <li id="client-menu-pemesanan" class="menu-item">
        <a href="{{url('client/pemesanan/index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-cart-alt"></i>
        <div data-i18n="Basic">Pemesanan</div>
        </a>
    </li>
    <li id="client-menu-history" class="menu-item">
        <a href="{{url('client/history/index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-history"></i>
        <div data-i18n="Basic">History Pemeriksaan</div>
        </a>
    </li>
    
    </ul>
</aside>
<!-- / Menu -->
@endif