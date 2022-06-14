@extends('layouts.layout')
@section('content')

    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <div class="card ">
            <div class="card-body">
                <div class="breadcrumb-line header-elements-md-inline">
                    <div class="d-flex h-flex">
                        <div class="breadcrumb" style="border: none !important ; background: none; font-size: 19px ; padding: 8px !important">
                            <a href="" class="breadcrumb-item"><i class="fas fa-home"></i> الرئيسية</a>
                            <span class="breadcrumb-item active">لوحة التحكم</span>
                            <span class="breadcrumb-item active">التحكم بالمنظمات</span>
                        </div>
                        <a href="" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>
                </div>
                <div class="data-organization" style="margin-bottom: 30px">
                    <div class="text-right " style="margin-bottom: 30px">
                        <a style="font-size: 20px"><i class="fas fa-bookmark ml-2"></i>إضافة قسم :</a>
                    </div>
                </div>
                <form action="{{ route('section.store') }}" method="post">
                    @csrf
                    <div class="form-group text-right">
                        <label>اسم القسم</label>
                        <input name="section_name" type="text" class="form-control">
                        <small class="form-text text-muted">لا يمكن تكرار اسم القسم</small>
                    </div>
                    <div class="mr-auto ml-auto text-center">
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
