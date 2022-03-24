@foreach($menus as $m)
    <li class="sidenav-item {{$m['class']}}">
        <a href="{{ ($m['route'] != '')?route($m['route']):'javascript:void(0);' }}" class="sidenav-link @if(count($m['children']) > 0)  sidenav-toggle @endif">
            <i class="sidenav-icon fas fa-{{ $m['icon'] }}"></i>&nbsp;
            <span class="hide-menu">{{ $m['name'] }}</span>
        </a>
        @if(count($m['children']) > 0)
            <ul class="sidenav-menu">
                @foreach($m['children'] as $child)
                    <li class="sidenav-item {{$child['class']}}">
                        <a href="{{ ($child['route'] != '')?route($child['route']):'javascript:void(0);' }}" class=" sidenav-link  @if(count($child['children']) > 0) sidenav-toggle @endif">
                            <i class="sidenav-icon fas fa-{{ $child['icon'] }}"></i>&nbsp;
                            {{ $child['name'] }}
                        </a>
                        @if(count($child['children']) > 0)
                            <ul class="sidenav-menu">
                                @foreach($child['children'] as $childs)
                                    <li class="sidenav-item {{$childs['class']}}">
                                        <a href="{{ ($childs['route'] != '')?route($childs['route']):'javascript:void(0);' }}" class=" sidenav-link" >
                                            <i class="sidenav-icon fas fa-{{ $childs['icon'] }}"></i>&nbsp;
                                            {{ $childs['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </li>
@endforeach
