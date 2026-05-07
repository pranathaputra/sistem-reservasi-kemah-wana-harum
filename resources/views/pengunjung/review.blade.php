@extends('layouts.pengunjung')

@section('content')

<div class="container py-5">

    <h2 class="fw-bold mb-4">Review Pengunjung</h2>

    <form action="#" method="POST">

        @csrf

        <div class="mb-3">
            <label class="form-label">Rating</label>

            <select class="form-control">
                <option>5 - Sangat Baik</option>
                <option>4 - Baik</option>
                <option>3 - Cukup</option>
                <option>2 - Kurang</option>
                <option>1 - Buruk</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Komentar</label>

            <textarea class="form-control"
                rows="4"
                placeholder="Tulis pengalaman Anda selama berkemah..."></textarea>
        </div>

        <button class="btn btn-success">
            Kirim Review
        </button>

    </form>

</div>

@endsection