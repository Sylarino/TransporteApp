<div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-lighter">

    <!-- Brand demo (see assets/css/demo/demo.css) -->
    <div class="app-brand demo bg-google-darker">
        <a href="{{ route('home') }}" class="app-brand-text demo text-lightest sidenav-text font-weight-normal ml-2">{!! config('app.name') !!}</a>
        <a href="javascript:void(0)" class="layout-sidenav-toggle sidenav-link text-large text-lighter ml-auto">
            <i class="ion ion-md-menu align-middle"></i>
        </a>
    </div>
    <?php $menu = new \App\Domain\System\Menu\Menu();?>
    <div class="sidenav-divider mt-0"></div>
    <ul class="sidenav-inner py-1">
        {!! $menu->makeMenu() !!}
    </ul>

</div>
