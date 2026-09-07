@extends('layouts.app')

@section('title')
    บทความทั้งหมด
@endsection

@section('content')
    <div class="container mt-3">
        <h2 class="text-center mb-4 text-primary fw-bold">บทความทั้งหมด</h2>

        <!-- Alert Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <strong>สำเร็จ!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mb-4 align-items-center">
            <!-- Search Lookup Bar -->
            <div class="col-md-8 mb-2 mb-md-0">
                <form action="{{ route('blogs') }}" method="GET" class="input-group shadow-sm">
                    <input type="text" name="search" class="form-control" placeholder="ค้นหาชื่อบทความ หรือเนื้อหา..." value="{{ $search ?? '' }}">
                    <button class="btn btn-primary" type="submit">🔍 ค้นหา</button>
                    @if(!empty($search))
                        <a href="{{ route('blogs') }}" class="btn btn-outline-secondary">ล้างตัวกรอง</a>
                    @endif
                </form>
            </div>
            <!-- Add Button -->
            <div class="col-md-4 text-md-end">
                <a href="{{ route('blog.create') }}" class="btn btn-success shadow-sm fw-semibold">
                    ➕ เขียนบทความใหม่
                </a>
            </div>
        </div>

        @if(count($blogs) > 0)
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-striped table-hover table-bordered text-center align-middle m-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 25%;">ชื่อบทความ</th>
                            <th scope="col" style="width: 40%;">เนื้อหา</th>
                            <th scope="col" style="width: 15%;">สถานะการเผยแพร่</th>
                            <th scope="col" style="width: 20%;">จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $item)
                            <tr>
                                <td class="fw-semibold text-start px-3">{{ $item->title }}</td>
                                <td class="text-start px-3">{{ Str::limit($item->content, 100) }}</td>
                                <td>
                                    @if($item->status)
                                        <span class="badge bg-success px-3 py-2">เผยแพร่</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2">ไม่เผยแพร่</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('blog.view', $item->id) }}" class="btn btn-info btn-sm fw-bold">
                                            👁️ 
                                        </a>
                                        <!-- Edit button -->
                                        <a href="{{ route('blog.edit', $item->id) }}" class="btn btn-warning btn-sm fw-bold">
                                            ✏️ 
                                        </a>
                                        <!-- Delete button -->
                                        <form action="{{ route('blog.destroy', $item->id) }}" method="POST" onsubmit="return confirm('คุณต้องการลบบทความนี้จริงหรือไม่?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm fw-bold">
                                                🗑️ 
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $blogs->links() }}
            </div>
        @else
            <div class="text-center py-5 shadow-sm rounded bg-light">
                <h3 class="text-muted mb-3">ไม่พบข้อมูลบทความ</h3>
                @if(!empty($search))
                    <p class="text-secondary">ไม่พบผลลัพธ์ที่ตรงกับคำว่า "{{ $search }}"</p>
                    <a href="{{ route('blogs') }}" class="btn btn-secondary mt-2">กลับไปหน้าทั้งหมด</a>
                @endif
            </div>
        @endif
    </div>
@endsection
