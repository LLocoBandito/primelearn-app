{{-- resources/views/partials/sidebar_course_item.blade.php --}}

@foreach ($courses as $course)
    <div class="small-post-item">
        <div class="small-post-text">
            {{-- Pastikan route('materi.detail') ada dan menggunakan ID materi --}}
            <a href="{{ route('materi.detail', $course->id) }}">
                <p><strong>{{ $course->title }}</strong></p>
            </a>
            <small>
                {{ substr($course->description, 0, 50) }}
                {{ strlen($course->description) > 50 ? '...' : '' }}
            </small>
        </div>
    </div>
@endforeach