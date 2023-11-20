@extends('layouts.admin')

@push('stylesheets')
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>
@endpush

@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">
        <!-- PAGE-HEADER -->
        @include('portfolio::partial.header')
        <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">ویرایش نمونه کار</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('portfolios.update', $Portfolio->id) }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                            <div class="col-md-12">
                                <label for="title" class="form-label">دسته بندی</label>
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if($Portfolio->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">لطفا دسته بندی را انتخاب کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="title" class="form-label">عنوان</label>
                                <input type="text" name="title" class="form-control" id="title" required value="{{ $Portfolio->title }}">
                                <div class="invalid-feedback">لطفا عنوان را وارد کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="slug" class="form-label">نامک</label>
                                <input type="text" name="slug" class="form-control" id="slug" required value="{{ $Portfolio->slug }}">
                                <div class="invalid-feedback">لطفا نامک را وارد کنید</div>
                            </div>
                            <div class="col-md-11">
                                <label for="image" class="form-label">تصویر شاخص</label>
                                <input type="file" name="image" class="form-control" aria-label="تصویر شاخص" id="image" accept="image/*" @if(!$Portfolio->image) required @endif>
                                <div class="invalid-feedback">لطفا یک تصویر انتخاب کنید</div>
                            </div>
                            <div class="col-md-1">
                                @if($Portfolio->image)
                                    <label for="image" class="form-label">تصویر فعلی</label>
                                    <img src="{{ url($Portfolio->image) }}" style="max-width: 100%;">
                                @endif
                            </div>
                            <div class="col-md-12">
                                <label for="editor1" class="form-label">توضیحات</label>
                                <textarea id="editor1" name="description" class="cke_rtl" required>{{ $Portfolio->description }}</textarea>
                                <div class="invalid-feedback">لطفا توضیحات را وارد کنید</div>
                            </div>

                            <div class="col-md-6">
                                <label for="customer" class="form-label">نام مشتری</label>
                                <input type="text" name="customer" class="form-control" id="customer" required value="{{ $Portfolio->customer }}">
                                <div class="invalid-feedback">لطفا نام مشتری را وارد کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="time" class="form-label">مدت زمان</label>
                                <input type="text" name="time" class="form-control" id="time" required value="{{ $Portfolio->time }}">
                                <div class="invalid-feedback">لطفا مدت زمان را وارد کنید</div>
                            </div>
                            <div class="col-md-12">
                                <label for="services" class="form-label">خدمات انجام شده</label>
                                <input type="text" name="services" class="form-control" id="services" required value="{{ $Portfolio->services }}">
                                <div class="invalid-feedback">لطفا خدمات انجام شده را وارد کنید</div>
                            </div>

                            <div class="col-md-5">
                                <label for="before" class="form-label">تصویر قبل</label>
                                <input type="file" name="before" class="form-control" aria-label="تصویر قبل" id="before" accept="image/*" @if(!$Portfolio->before) required @endif>
                                <div class="invalid-feedback">لطفا یک تصویر انتخاب کنید</div>
                            </div>
                            <div class="col-md-1">
                                @if($Portfolio->before)
                                    <label for="before" class="form-label">تصویر قبل</label>
                                    <img src="{{ url($Portfolio->before) }}" style="max-width: 100%;">
                                @endif
                            </div>

                            <div class="col-md-5">
                                <label for="after" class="form-label">تصویر بعد</label>
                                <input type="file" name="after" class="form-control" aria-label="تصویر بعد" id="after" accept="image/*" @if(!$Portfolio->after) required @endif>
                                <div class="invalid-feedback">لطفا یک تصویر انتخاب کنید</div>
                            </div>
                            <div class="col-md-1">
                                @if($Portfolio->after)
                                    <label for="after" class="form-label">تصویر بعد</label>
                                    <img src="{{ url($Portfolio->after) }}" style="max-width: 100%;">
                                @endif
                            </div>

                            @if(count($Portfolio->photos))
                                @foreach($Portfolio->photos as $photo)
                                    <div class="col-md-10">
                                        <label for="photo" class="form-label">تصویر گالری</label>
                                        <input type="file" name="photo[]" class="form-control" aria-label="تصویر گالری" id="photo" accept="image/*">
                                        <div class="invalid-feedback">لطفا یک یا چند تصویر انتخاب کنید</div>
                                    </div>
                                    <div class="col-md-1">
                                        @if($photo->path)
                                            <label for="photo" class="form-label">تصویر گالری</label>
                                            <img src="{{ url($photo->path) }}" style="max-width: 100%;">
                                        @endif
                                    </div>
                                    <div class="col-md-1">
                                        <label for="photo" class="form-label">حذف تصویر</label>
                                        <a href="{{ route('portfolios-photo-delete', $photo->id) }}" class="btn btn-danger" onclick="return confirm('برای حذف اطمینان دارید؟')"><i class="fa fa-trash"></i> حذف </a>
                                    </div>


                                @endforeach
                            @endif

                            <div class="col-md-12">
                                <label for="photo" class="form-label">تصاویر گالری</label>
                                <input type="file" name="photo[]" class="form-control" aria-label="تصاویر گالری" id="photo" accept="image/*" multiple>
                                <div class="invalid-feedback">لطفا یک یا چند تصویر انتخاب کنید</div>
                            </div>

                            <div class="col-12 mt-4">
                                <button class="btn btn-primary" type="submit">ارسال فرم</button>
                                @csrf
                                @method('PATCH')
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW CLOSED -->

    </div>

    @push('scripts')
        @include('ckfinder::setup')
        <script>
            var editor = CKEDITOR.replace('editor1', {
                // Define the toolbar groups as it is a more accessible solution.
                toolbarGroups: [
                    {
                        "name": "basicstyles",
                        "groups": ["basicstyles"]
                    },
                    {
                        "name": "links",
                        "groups": ["links"]
                    },
                    {
                        "name": "paragraph",
                        "groups": ["list", "blocks"]
                    },
                    {
                        "name": "document",
                        "groups": ["mode"]
                    },
                    {
                        "name": "insert",
                        "groups": ["insert"]
                    },
                    {
                        "name": "styles",
                        "groups": ["styles"]
                    },
                    {
                        "name": "about",
                        "groups": ["about"]
                    },
                    {   "name": 'paragraph',
                        "groups": ['list', 'blocks', 'align', 'bidi']
                    }
                ],
                // Remove the redundant buttons from toolbar groups defined above.
                removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,PasteFromWord'
            });
            CKFinder.setupCKEditor( editor );
        </script>
    @endpush
@endsection
