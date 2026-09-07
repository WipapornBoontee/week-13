@extends('layout')

@section('title')
ดูบทความ
@endsection

@section('content')
<div class="container mt-3" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">ดูบทความ</h2>
        <a href="{{ route('blogs') }}" class="btn btn-outline-secondary btn-sm fw-semibold">
            ⬅️ กลับหน้าบทความ
        </a>
    </div>

    <div class="card shadow-sm border-0 p-4">
        <form action="{{ route('blog.view', $blog->id) }}" method="get">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label fw-semibold">หัวข้อบทความ (Title)</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $blog->title) }}" placeholder="กรอกหัวข้อบทความ" readonly>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label fw-semibold">เนื้อหาบทความ (Content)</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="6" placeholder="กรอกเนื้อหาบทความ" readonly>{{ old('content', $blog->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label fw-semibold">สถานะการเผยแพร่</label>
                <input type="text" class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="{{ old('status', $blog->status == 1 ? 'เผยแพร่' : 'ฉบับร่าง') }}" placeholder="กรอกสถานะการเผยแพร่" readonly>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr class="my-4">

        </form>
    </div>
</div>
@endsection
