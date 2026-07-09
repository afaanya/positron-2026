@extends('layouts.mentor')

@section('title', 'POSITRON 2026 – Portal Mentor')

@section('content')

    {{-- Server data consumed by resources/js/mentor-portal.js --}}
    <script>
        window.__MENTOR__   = @json(['user' => session('mentor_user', 'Mentor')]);
        window.__STUDENTS__ = @json($students ?? []);
        window.__ASSESS__   = @json((object) ($assessments ?? []));
        window.__SAVE_URL__ = @json(route('mentor.penilaian.save'));
        window.__CSRF__     = @json(csrf_token());
    </script>
    <form id="realLogoutForm" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>

    @include('mentor.partials.navbar')

    <div class="toast-box" id="toastBox" aria-live="polite"></div>

    @include('mentor.partials.profile-modal')

    <div class="page-wrap">
        <div class="page-body">
            @include('mentor.partials.dashboard')
            @include('mentor.partials.penilaian')
        </div>
        @include('layouts.partials.footer')
    </div>

@endsection
