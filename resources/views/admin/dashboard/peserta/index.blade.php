@extends('admin.dashboard.layouts.main')
@section('section')
<div class="overflow-hidden bg-white rounded-lg shadow-lg">
    <div class="px-6 py-4 text-white bg-gradient-to-r from-primary to-accent">
        <h2 class="text-2xl font-bold">Daftar Peserta</h2>
        <p class="text-sm opacity-90">Kelola peserta</p>
    </div>
     @if (session()->has('success'))
                <div class="relative px-4 py-3 mb-6 text-green-700 bg-green-100 border border-green-400 rounded-lg" role="alert">
                    {{ session('success') }}
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3 text-green-700 hover:text-green-900" onclick="this.parentElement.style.display='none'" aria-label="Close">
                        &times;
                    </button>
                </div>
            @endif
    <div class="p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="text-sm text-muted-foreground">
                Total: <span id="total-count">0</span> peserta
            </div>
        </div>
        <div class="overflow-x-auto">
            <table id="peserta-table" class="w-full border-collapse table-auto">
                <thead class="bg-muted">
                    <tr>
                        <th class="w-1/4 px-4 py-3 text-xs font-medium tracking-wider text-left uppercase border-b text-muted-foreground">Penanggung Jawab</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left uppercase border-b text-muted-foreground">Nama Sekolah</th>
                       <th class=" px-4 py-3 text-xs font-medium tracking-wider text-left uppercase border-b text-muted-foreground">Lomba</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left uppercase border-b text-muted-foreground">Grade</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left uppercase border-b text-muted-foreground">No Hp</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left uppercase border-b text-muted-foreground">Status Pembayaran</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-center uppercase border-b text-muted-foreground">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Data will be loaded here by DataTables -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
/* Custom DataTables Styling */
#peserta-table_wrapper .dataTables_length,
#peserta-table_wrapper .dataTables_filter,
#peserta-table_wrapper .dataTables_info,
#peserta-table_wrapper .dataTables_paginate {
    margin-bottom: 1rem;
    color: #6b7280;
    font-size: 0.875rem;
}

#peserta-table_wrapper .dataTables_length select,
#peserta-table_wrapper .dataTables_filter input {
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    background-color: #ffffff;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

#peserta-table_wrapper .dataTables_length select:focus,
#peserta-table_wrapper .dataTables_filter input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

#peserta-table_wrapper .dataTables_info {
    padding-top: 0.5rem;
}

#peserta-table_wrapper .dataTables_paginate .paginate_button {
    padding: 0.5rem 0.75rem;
    margin: 0 0.125rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    background: #ffffff;
    color: #374151;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.15s ease-in-out;
}

#peserta-table_wrapper .dataTables_paginate .paginate_button:hover {
    background: #f3f4f6;
    border-color: #9ca3af;
    color: #111827;
}

#peserta-table_wrapper .dataTables_paginate .paginate_button.current {
    background: #3b82f6;
    border-color: #3b82f6;
    color: #ffffff;
}

#peserta-table_wrapper .dataTables_paginate .paginate_button.disabled {
    background: #f9fafb;
    border-color: #e5e7eb;
    color: #9ca3af;
    cursor: not-allowed;
}

#peserta-table tbody tr {
    transition: background-color 0.15s ease-in-out;
}

#peserta-table tbody tr:hover {
    background-color: #f8fafc;
}

#peserta-table tbody tr:nth-child(even) {
    background-color: #f9fafb;
}

#peserta-table tbody tr:nth-child(odd) {
    background-color: #ffffff;
}

#peserta-table_processing {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    padding: 1rem 2rem;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    font-size: 0.875rem;
    color: #374151;
}
</style>

@endsection

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-medium text-gray-900">Bukti Pembayaran</h3>
            <button onclick="closeImageModal()" class="text-gray-400 hover:text-gray-600">
                <span class="text-2xl">&times;</span>
            </button>
        </div>
        <div class="mt-3">
            <img id="modalImage" src="" alt="Bukti Pembayaran" class="w-full h-auto">
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
$(function() {
    // Inisialisasi DataTable
    var table = $('#peserta-table').DataTable({
        processing: true,
        serverSide: false, // Ubah ke false untuk memuat semua data sekaligus
        ajax: {
            url: '{{ route('peserta.data') }}',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            error: function(xhr, error, thrown) {
                console.error('DataTable AJAX Error:', xhr, error, thrown);
                alert('Gagal memuat data peserta. Periksa koneksi atau login Anda.');
            }
        },
        columns: [
            { data: 'penanggung_jawab', name: 'penanggung_jawab' },
            { data: 'nama_sekolah', name: 'nama_sekolah' },
            { data: 'nama_lomba', name: 'nama_lomba' },
            { data: 'tingkat', name: 'tingkat' },
            { data: 'no_hp', name: 'no_hp' },
            { data: 'status_pembayaran', name: 'status_pembayaran' },
            {
                data: null,
                name: 'aksi',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="flex flex-col space-y-2">
                            <a class="px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-blue-500 rounded-md hover:bg-blue-600 w-20" href="/admin/dashboard/peserta/${row.id}/edit">
                                Update
                            </a>
                            <form action="/admin/dashboard/peserta/${row.id}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta ini?')" class="inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-red-500 rounded-md hover:bg-red-600 w-20">
                                    Delete
                                </button>
                            </form>
                        </div>
                    `;
                }
            }
        ],
        language: {
            processing: "Memproses...",
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ entri",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
            infoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
            infoPostFix: "",
            loadingRecords: "Memuat...",
            zeroRecords: "Tidak ada data yang sesuai",
            emptyTable: "Tidak ada data di dalam tabel",
            paginate: {
                first: "Pertama",
                previous: "Sebelumnya",
                next: "Selanjutnya",
                last: "Terakhir"
            },
            aria: {
                sortAscending: ": aktifkan untuk mengurutkan kolom secara ascending",
                sortDescending: ": aktifkan untuk mengurutkan kolom secara descending"
            }
        },
        initComplete: function() {
            // Update total count
            var info = table.page.info();
            $('#total-count').text(info.recordsTotal);
        }
    });

    // Update total count on table draw
    table.on('draw', function() {
        var info = table.page.info();
        $('#total-count').text(info.recordsTotal);
    });

    // Modal functionality
    $('#open-peserta-modal').on('click', function() {
        $('#peserta-modal').removeClass('hidden');
    });

    $('#close-peserta-modal, #cancel-peserta').on('click', function() {
        $('#peserta-modal').addClass('hidden');
    });

    // Close modal when clicking outside
    $('#peserta-modal').on('click', function(e) {
        if (e.target === this) {
            $(this).addClass('hidden');
        }
    });

    // Image Modal functionality
    window.openImageModal = function(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.remove('hidden');
    };

    window.closeImageModal = function() {
        document.getElementById('imageModal').classList.add('hidden');
    };

    // Close modal when clicking outside
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageModal();
        }
    });
});
</script>
@endpush
