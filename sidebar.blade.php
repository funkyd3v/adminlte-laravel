<div class="sidebar-wrapper">
    <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation"
            data-accordion="false" id="navigation">
            @foreach ($menus as $menu)
                <li class="nav-item">
                    <a href="{{ !$menu->children->isNotEmpty() ? route($menu->route) : '#' }}" class="nav-link">
                        <i class="nav-icon {{ $menu->icon }}"></i>
                        <p>
                            {{ $menu->title }}
                            @if ($menu->children->isNotEmpty())
                                <i class="right fas fa-angle-down"></i>
                            @endif
                        </p>
                    </a>

                    @if ($menu->children->isNotEmpty())
                        <ul class="nav nav-treeview">
                            @foreach ($menu->children as $child)
                                <li class="nav-item">
                                    <a href="{{ route($child->route) }}" class="nav-link">
                                        <i class="nav-icon {{ $child->icon }}"></i>
                                        <p>{{ $child->title }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
        <!--end::Sidebar Menu-->
    </nav>
</div>

