@extends('layouts.admin')

@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

    @include('portfolio::category.partial.header')

    <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">ویرایش دسته بندی</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('PortfolioCategory.update', $PortfolioCategory->id) }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                            <div class="col-md-6">
                                <label for="name" class="form-label">نام دسته بندی</label>
                                <input type="text" name="name" class="form-control" id="name" required value="{{ $PortfolioCategory->name }}">
                                <div class="invalid-feedback">لطفا نام دسته بندی را وارد کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="slug" class="form-label">نامک</label>
                                <input type="text" name="slug" class="form-control" id="slug" required value="{{ $PortfolioCategory->slug }}">
                                <div class="invalid-feedback">لطفا نامک را وارد کنید</div>
                            </div>
{{--                            <div class="col-md-11">--}}
{{--                                <label for="banner" class="form-label">بنر</label>--}}
{{--                                <input type="file" name="banner" class="form-control" id="banner" required accept="image/*">--}}
{{--                                <div class="invalid-feedback">لطفا بنر را وارد کنید</div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-1">--}}
{{--                                @if($PortfolioCategory->banner)--}}
{{--                                    <label for="banner" class="form-label">بنر فعلی</label>--}}
{{--                                    <img src="{{ url($PortfolioCategory->banner) }}" style="max-width: 100%;">--}}
{{--                                @endif--}}
{{--                            </div>--}}


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
@endsection
