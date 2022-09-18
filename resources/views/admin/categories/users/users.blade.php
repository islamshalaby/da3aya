@extends('admin.app')
@section('title' , __('messages.category_user'))
@section('scripts')
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js" type="text/javascript"></script>
@endsection
@section('content')
    <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">

        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>{{ __('messages.category_user') }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <a class="btn btn-primary" href="{{route('categories.create.users',[$id,$type])}}">{{ __('messages.add_user') }}</a>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <table class="table table-hover non-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>{{ __('messages.user_name') }}</th>
                            @if(Auth::user()->delete_data)
                                <th class="text-center">{{ __('messages.delete') }}</th>@endif
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        <?php $i = 1; ?>
                        @foreach ($data as $row)
                            <tr>
                                <td><?=$i;?></td>
                                <td>{{  $row->User->name }}</td>
                                @if(Auth::user()->delete_data)
                                    <td class="text-center blue-color">
                                        <a onclick="return confirm('Are you sure you want to delete this item?');"
                                           href="/admin-panel/categories/destroy/users/{{ $row->id }}">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                @endif
                                <?php $i++; ?>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
