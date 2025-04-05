@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">📂 Chi tiết danh mục</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Thông tin danh mục -->
                <div class="col-md-12">
                    <h4 class="text-primary">Danh mục : {{ $category->name }}</h4>
                    <p><strong>Mô tả:</strong> {{ $category->description ?? 'Chưa có mô tả' }}</p>
                 
                </div>
            </div>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại danh sách
            </a>
        </div>
    </div>
</div>
@endsection
