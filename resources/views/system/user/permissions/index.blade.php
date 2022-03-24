@extends('layouts.modal.layout')
@section('modal-icon','fa-th-list')
@section('modal-title','Permisos del Usuario: '.$user->getFullName())
@section('modal-content')
    <form class="" role="form"  id="user-permissions-form">
        @csrf
        <div class="card-datatable">
            <table class="table table-bordered table-striped" id="table-generated">
                <thead>
                <tr>
                    <th>Slug</th>
                    <th>Permisos</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>
                            <label class="switcher">
                                <input type="checkbox" id="{{ $permission->slug }}" class="switcher-input main-control" value="{{ $permission->slug }}" name="{{ $permission->slug }}">
                                <span class="switcher-indicator">
                                    <span class="switcher-yes"></span>
                                    <span class="switcher-no"></span>
                                </span>
                                <span class="switcher-label">{{ $permission->slug }}</span>
                            </label>
                        <td>
                            @foreach(explode(',',$permission->list) as $p)
                                <div class="row">
                                    <div class="col-12">
                                        <label class="switcher">
                                            <input type="checkbox" class="{{ $permission->slug }} switcher-input" value="{{ $permission->slug.".".$p }}" name="perms[]" @if($user->hasAccess([$permission->slug.".".$p])) checked @endif>
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">{{ $p }}</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </form>
    <script>
        $('.main-control').change(function() {
            var id = this.id;
            if($(this).is(":checked")) {

                $('.'+id).prop('checked',true);
            }else {
                $('.'+id).prop('checked',false);
            }
            //'unchecked' event code
        });
    </script>
@endsection
@section('modal-validation')
    {!!  makeValidation('#user-permissions-form','/userPermissions/'.$user->id, "tableReload(); closeModal();") !!}
@endsection
@section('modal-width','60')
