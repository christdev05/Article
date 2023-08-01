<div>
    <div class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <div>
                <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
            </div>
            <div>
                <h4 class="logo-text">ARTICLES</h4>
            </div>
            <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
            </div>
        </div>
        <!--navigation-->
        <ul class="metismenu" id="menu">
            <li>
                <a href="/dashboard" >
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li class="menu-label">USERS</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-user"></i>
                    </div>
                    <div class="menu-title">Users Management</div>
                </a>
                <ul>
                    <li> <a href="{{route('user.index')}}"><i class="bx bx-right-arrow-alt"></i>Role and Permission User</a>
                    </li>
                </ul>
            </li>
            <li class="menu-label">ARTICLES</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-grid'></i>
                    </div>
                    <div class="menu-title">Article Management</div>
                </a>
                <ul>
                    <li> <a href="{{route('type.index')}}"><i class="bx bx-right-arrow-alt"></i>Type of articles</a>
                    </li>
                    <li> <a href="{{route('article.index')}}"><i class="bx bx-right-arrow-alt"></i>Articles</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!--end navigation-->
    </div>
</div>
