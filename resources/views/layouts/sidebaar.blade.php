<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Skodash</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('category.index') }}">
                <div class="parent-icon"><i class="bi bi-list"></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <a href="{{ route('book.index') }}">
                <div class="parent-icon"><i class="bi bi-list"></i>
                </div>
                <div class="menu-title">BookList</div>
            </a>
            <a href="{{ route('calculation.index') }}">
                <div class="parent-icon"><i class="bi bi-list"></i>
                </div>
                <div class="menu-title">Calculation</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->
