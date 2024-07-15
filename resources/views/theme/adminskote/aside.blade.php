<div data-simplebar class="h-100">
    {{--  Sidemenu  --}}
    <div id="sidebar-menu">
        {{--  Left Menu Start  --}}
        <ul class="metismenu list-unstyled" id="side-menu">
            @php
                $titulo = null;
            @endphp
            @foreach ($menus as $menu)
                @if ($titulo != $menu['dmenu'])
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="{{trim($menu['icono'])}}"></i>
                        <span>{{$menu['dmenu']}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @foreach ($menus as $submenu)
                            @if($menu['dmenu'] == $submenu['dmenu'])
                                <li>
                                    <a href="{{route($submenu['ruta'])}}">
                                        <i class="{{trim($submenu['iconoi'])}}" style="color:rgb(237, 139, 11)"></i>
                                        {{$submenu['dsubmenu']}}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                @endif
                @php
                    $titulo = $menu['dmenu'];
                @endphp
            @endforeach
        </ul>
    </div>
    {{--  Sidebar  --}}
</div>
