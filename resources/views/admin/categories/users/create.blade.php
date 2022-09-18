@extends('admin.app')

@section('title' , __('messages.add_user'))
@section('styles')
    <link href="/admin/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/admin/plugins/select2/select2.min.css">
@endsection
@section('content')
    <div class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>{{ __('messages.add_user') }}</h4>
                    </div>
                </div>
            </div>
            <form action="{{route('category.users.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="category_type" value="{{$type}}">
                <input type="hidden" name="cat_id" value="{{$id}}">
                <div class="form-group inside">
                    <label for="users">{{ __('messages.users') }}</label>
                    <select class="form-control tagging" name="users[]" id="cmb_sub_cat" multiple="multiple">
                        <option disabled>{{ __('messages.select') }}</option>
                        @foreach ($users as $row)
                            @php $exist_user = \App\Category_user::where('user_id',$row->id)->where('cat_id',$id)->where('category_type',$type)->first() @endphp
                            @if(!$exist_user)
                                <option value="{{ $row->id }}">{{ $row->name }} &nbsp; &nbsp; &nbsp; {{ $row->phone }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <input type="submit" value="{{ __('messages.add') }}" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="/admin/plugins/highlight/highlight.pack.js"></script>
    <script src="/admin/plugins/select2/select2.min.js"></script>
    <script src="/admin/plugins/select2/custom-select2.js"></script>
    <script>
        $(".tagging").select2({
            tags: true
        });
    </script>
@endsection
