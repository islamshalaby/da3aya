@extends('admin.app')

@section('title' , __('messages.add_new_category'))
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
                        <h4>{{ __('messages.add_new_category') }}</h4>
                    </div>
                </div>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="custom-file-container" data-upload-id="myFirstImage">
                    <label>{{ __('messages.upload') }} ({{ __('messages.single_image') }}) <a href="javascript:void(0)"
                                                                                              class="custom-file-container__image-clear"
                                                                                              title="Clear Image">x</a></label>
                    <label class="custom-file-container__custom-file">
                        <input type="file" required name="image"
                               class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>
                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                    </label>
                    <div class="custom-file-container__image-preview"></div>
                </div>
                <div class="custom-file-container" data-upload-id="mySecondImage">
                    <label>{{ __('messages.offers_cover') }} ({{ __('messages.single_image') }}) <a
                            href="javascript:void(0)" class="custom-file-container__image-clear"
                            title="Clear Image">x</a></label>
                    <label class="custom-file-container__custom-file">
                        <input type="file" required name="offers_image"
                               class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>
                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                    </label>
                    <div class="custom-file-container__image-preview">

                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="title_ar">{{ __('messages.name_ar') }}</label>
                    <input required type="text" name="title_ar" class="form-control" id="title_ar"
                           placeholder="{{ __('messages.name_ar') }}" value="">
                </div>
                <div class="form-group mb-4">
                    <label for="title_ar">{{ __('messages.name_en') }}</label>
                    <input required type="text" name="title_en" class="form-control" id="title_en"
                           placeholder="{{ __('messages.name_en') }}" value="">
                </div>
                <div class="form-group inside">
                    <label for="users">{{ __('messages.users') }}</label>
                    <select class="form-control tagging" name="users[]" id="cmb_sub_cat" multiple="multiple">
                        <option disabled>{{ __('messages.select') }}</option>
                        @foreach ($users as $row)
                            <option value="{{ $row->id }}">{{ $row->name }} &nbsp; &nbsp; &nbsp; {{ $row->phone }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" value="{{ __('messages.add') }}" class="btn btn-primary">
            </form>
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
