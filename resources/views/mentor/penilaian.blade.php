<section id="penilaian" class="px-8 pb-10">

<div class="bg-white rounded-2xl shadow-lg p-6">

    {{-- Judul --}}
    <div class="mb-6">

        <h2 class="text-3xl font-bold text-[#214F3D]">
            Penilaian Mahasiswa
        </h2>

        <p class="text-gray-500">
            Input nilai setiap kegiatan mahasiswa.
        </p>

    </div>

    {{-- Biodata --}}
    <div class="grid grid-cols-2 gap-6 mb-8">

        <div>

            <p><b>Nama</b> : Shafa Shafiyyah Haris</p>
            <p><b>NIM</b> : 230101001</p>
            <p><b>Offering</b> : A</p>

        </div>

        <div>

            <p><b>Mentor</b> : Mentor Adi</p>

            <span
            class="inline-block mt-2 bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">

                Sedang Dikerjakan

            </span>

        </div>

    </div>

    {{-- Tabel Penilaian --}}
    <div class="overflow-x-auto">

        <table class="w-full border">

            <thead class="bg-[#F4E8CC]">

            <tr>

                <th class="p-3">Kegiatan</th>
                <th>Maksimal</th>
                <th>Nilai</th>
                <th>Status</th>
                <th>Aksi</th>

            </tr>

            </thead>

            <tbody>

            @for($i=1;$i<=4;$i++)

            <tr class="border-b">

                <td class="p-4">

                    Kegiatan {{ $i }}

                </td>

                <td>

                    {{ [25,30,25,20][$i-1] }}

                </td>

                <td>

                    <input
                    type="number"
                    min="0"
                    class="border rounded-lg px-3 py-2 w-24">

                </td>

                <td>

                    <span
                    class="bg-red-100 text-red-600 px-3 py-1 rounded-full">

                        Belum Dinilai

                    </span>

                </td>

                <td>

                    <button
                    class="bg-[#214F3D] text-white px-4 py-2 rounded-lg">

                        Simpan

                    </button>

                </td>

            </tr>

            @endfor

            </tbody>

        </table>

    </div>

    {{-- Total --}}
    <div class="mt-8 flex justify-end">

        <div class="bg-[#F4F0E8] rounded-xl p-5 w-72">

            <h3 class="font-bold text-xl">

                Total Nilai

            </h3>

            <h1 class="text-5xl font-bold text-[#214F3D] mt-3">

                0

            </h1>

        </div>

    </div>

</div>

</section>