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

        // Blokir Ctrl + scroll mouse
        document.addEventListener('wheel', function(e) {
            if (e.ctrlKey) {
                e.preventDefault();
            }
        }, { passive: false });

        // Blokir Ctrl + / Ctrl - / Ctrl 0 (keyboard zoom)
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && (e.key === '+' || e.key === '-' || e.key === '0' || e.key === '=')) {
                e.preventDefault();
            }
        }, false);
    </script>
    <form id="realLogoutForm" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>

    @include('mentor.partials.navbar')

    <div class="toast-box" id="toastBox" aria-live="polite"></div>

    @include('mentor.partials.profile-modal')
    <div id="mentorBiodata" class="bio-modal">
        <div class="bio-card">

            <button class="bio-close" onclick="tutupBiodata()">
                ✕
            </button>

            <h2>Biodata Mahasiswa</h2>

            <table class="bio-table">
                <tr>
                    <td>Nama</td>
                    <td id="bioNama"></td>
                </tr>

                <tr>
                    <td>NIM</td>
                    <td id="bioNim"></td>
                </tr>

                <tr>
                    <td>No WA</td>
                    <td>
                        <a id="bioWa" target="_blank"></a>
                    </td>
                </tr>
            </table>

            <button class="btn-brn" onclick="tutupBiodata()">
                Tutup
            </button>

        </div>
    </div>

    <div class="page-wrap">
        <div class="page-body">
            @include('mentor.partials.dashboard')
            @include('mentor.partials.penilaian')
        </div>
        @include('layouts.partials.footer')
    </div>


@endsection
