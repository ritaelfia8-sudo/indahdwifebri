@extends('layouts.app')

@section('title', 'Beranda - ' . $siteName)

@section('content')
<section class="py-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <span class="badge text-bg-success mb-3">
                Kursus teknologi untuk mahasiswa
            </span>

            <h1 class="display-5 fw-bold">
                Belajar lebih terarah bersama {{ $siteName }}
            </h1>

            <p class="lead text-secondary">
                Pilih kursus, cek ketersediaan kursi, lalu isi formulir pendaftaran.
            </p>

            <a href="{{ route('enrollments.create') }}" class="btn btn-success">
                Daftar Kursus
            </a>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
                Lihat Semua Kursus
            </a>
        </div>
    </div>
</section>

<section class="pb-5">
    <h2 class="h4 mb-3">Kursus Pilihan</h2>

    <div class="row g-3">
        @forelse ($featured as $course)
            <div class="col-md-4">
                <article class="card h-100">
                    <div class="card-body">
                        <small class="text-secondary">{{ $course->code }}</small>
                        <h3 class="h5">{{ $course->name }}</h3>
                        <p>{{ $course->description ?? 'Belum ada deskripsi.' }}</p>
                        <div class="small text-secondary">
                            Rp {{ number_format($course->fee, 0, ',', '.') }}
                            &middot; Mulai {{ $course->start_date->format('d/m/Y') }}
                        </div>
                    </div>
                </article>
            </div>
        @empty
            <p class="text-secondary">Belum ada kursus yang dibuka.</p>
        @endforelse
    </div>
</section>
@endsection