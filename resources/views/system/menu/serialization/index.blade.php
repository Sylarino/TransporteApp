@extends('layouts.modal.layout')
@section('modal-icon','fa-list-ol')
@section('modal-title','Serializar Menu')
@section('modal-content')
    {!! printCss(['libs/nestable/nestable.css']) !!}
    {!! printScript([
        'libs/nestable/nestable.js',
        'libs/jstree/jstree.js'
    ]) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="dd" id="nestable">
                <ol class="dd-list">
                    @foreach($menu as $m)

                        <li class="dd-item" data-id="{{ $m['id'] }}">
                            <div class="dd-handle">
                                <span class="fas fa-{{$m['icon'] }}"></span>&nbsp; {{ $m['name'] }}
                                <span class="label label-primary float-right">{{ $m['position'] }}</span>
                            </div>
                            @if(count($m['children']) > 0)
                                <ol class="dd-list">
                                    @foreach($m['children'] as $child)
                                        <li class="dd-item" data-id="{{ $child['id'] }}">
                                            <div class="dd-handle">
                                                <span class="fas fa-{{ $child['icon'] }}"></span>&nbsp; {{ $child['name'] }}
                                                <span class="label label-primary float-right">{{ $child['position'] }}</span>
                                            </div>
                                            @if(count($child['children']) > 0)
                                                <ol class="dd-list">
                                                    @foreach($child['children'] as $c)
                                                        <li class="dd-item" data-id="{{ $c['id'] }}">
                                                            <div class="dd-handle">
                                                                <span class="fas fa-{{ $c['icon'] }}"></span>&nbsp; {{ $c['name'] }}
                                                                <span class="label label-primary float-right">{{ $c['position'] }}</span>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            @endif
                                        </li>
                                    @endforeach
                                </ol>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

    <form class="my-5" role="form"  id="menu-serialization-form">
        @csrf
        <div class="form-group">
            <label class="form-label">Json Menu</label>
            <textarea id="nestable-output" name="menu" class="form-control input-sm"></textarea>
        </div>

    </form>
    <script>
        // Nestable
        $(function() {
            function updateOutput(e) {
                var list   = e.length ? e : $(e.target);
                var output = list.data('output');

                output.val(window.JSON ? window.JSON.stringify(list.nestable('serialize')) :
                    'JSON browser support required for this demo.');
            };
            $('#nestable').nestable({ group: 1 , maxDepth: 3}).on('change', updateOutput);
            updateOutput($('#nestable').data('output', $('#nestable-output')));
        });
    </script>
@endsection
@section('modal-validation')
    {!!  makeValidation('#menu-serialization-form','/menuSerialization', "tableReload(); closeModal();") !!}
@endsection
@section('modal-width','30')
