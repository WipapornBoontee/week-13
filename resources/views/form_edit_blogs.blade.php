@extends('layouts.app')

@section('title')
แก้ไขบทความ
@endsection

@section('content')
<div class="container mt-3" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">แก้ไขบทความ</h2>
        <a href="{{ route('blogs') }}" class="btn btn-outline-secondary btn-sm fw-semibold">
            ⬅️ กลับหน้าบทความ
        </a>
    </div>

    <div class="card shadow-sm border-0 p-4">
        <form action="{{ route('blog.update', $blog->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label fw-semibold">หัวข้อบทความ (Title)</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $blog->title) }}" placeholder="กรอกหัวข้อบทความ">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label fw-semibold">เนื้อหาบทความ (Content)</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="6" placeholder="กรอกเนื้อหาบทความ">{{ old('content', $blog->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label fw-semibold">สถานะการเผยแพร่</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                    <option value="1" {{ old('status', $blog->status) == '1' ? 'selected' : '' }}>เผยแพร่ (Active)</option>
                    <option value="0" {{ old('status', $blog->status) == '0' ? 'selected' : '' }}>ฉบับร่าง (Draft)</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr class="my-4">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('blogs') }}" class="btn btn-light px-4 fw-bold me-md-2">ยกเลิก</a>
                <button type="submit" class="btn btn-primary px-4 fw-bold">💾 บันทึกการแก้ไข</button>
            </div>
        </form>
    </div>
</div>
@endsection
