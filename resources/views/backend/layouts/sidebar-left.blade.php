<ul class="nav nav-pills nav-stacked side-navigation">
    @foreach (config('backend-menu') as $top => $son)
        @if ( ! is_array($son))
            @if ( ! auth('admin')->user()->denies($son))
                <li @if (Route::is('RootDashboard') && $son == 'RootDashboard') class="active" @endif>
                    <a href="{{ route($son) }}">{!! __($top) !!}</a>
                </li>
            @endif
        @else
            @if (Arr::first($son, function($route_name){ if(is_array($route_name)){ foreach($route_name as $route_name => $_); } return ! auth('admin')->user()->denies($route_name); }))
                <li class="menu-list">
                    <a href="#"> {!! __($top) !!}</a>
                    <ul class="child-list">
                        @foreach ($son as $title => $route_name)
                            <?php
                            $params = [];
                            if (is_array($route_name)) {
                                foreach ($route_name as $route_name => $params) ;
                            }
                            ?>
                            @if ( ! auth('admin')->user()->denies($route_name))
                                <li><a href="{{ route($route_name, $params) }}">{!! __($title) !!}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endif
        @endif
    @endforeach
</ul>

@if ( ! @$_COOKIE['sidebar_collapsed'])
    <script> $('.menu-list > .child-list').hide(); </script>
@endif
