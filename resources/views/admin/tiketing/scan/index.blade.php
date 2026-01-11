@extends('admin.tiketing.layouts.main')
@section('section')
<div class="overflow-hidden bg-white rounded-lg shadow-lg">
    <div class="px-6 py-4 text-white bg-gradient-to-r from-primary to-accent">
        <h2 class="text-2xl font-bold">Daftar Penonton</h2>
        <p class="text-sm opacity-90">Kelola penonton</p>
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
                Total: <span id="total-count">0</span> penonton
            </div>
        </div>
        <div class="overflow-x-auto">
            <table id="penonton-table" class="w-full border-collapse table-auto">
                <thead class="bg-muted">
                    <tr>
                        <th class="w-1/4 px-4 py-3 text-xs font-medium tracking-wider text-left uppercase border-b text-muted-foreground">Nama</th>
                        <th class="w-1/6 px-4 py-3 text-xs font-medium tracking-wider text-left uppercase border-b text-muted-foreground">Checked In At</th>
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
#penonton-table_wrapper .dataTables_length,
#penonton-table_wrapper .dataTables_filter,
#penonton-table_wrapper .dataTables_info,
#penonton-table_wrapper .dataTables_paginate {
    margin-bottom: 1rem;
    color: #6b7280;
    font-size: 0.875rem;
}

#penonton-table_wrapper .dataTables_length select,
#penonton-table_wrapper .dataTables_filter input {
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    background-color: #ffffff;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

#penonton-table_wrapper .dataTables_length select:focus,
#penonton-table_wrapper .dataTables_filter input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

#penonton-table_wrapper .dataTables_info {
    padding-top: 0.5rem;
}

#penonton-table_wrapper .dataTables_paginate .paginate_button {
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

#penonton-table_wrapper .dataTables_paginate .paginate_button:hover {
    background: #f3f4f6;
    border-color: #9ca3af;
    color: #111827;
}

#penonton-table_wrapper .dataTables_paginate .paginate_button.current {
    background: #3b82f6;
    border-color: #3b82f6;
    color: #ffffff;
}

#penonton-table_wrapper .dataTables_paginate .paginate_button.disabled {
    background: #f9fafb;
    border-color: #e5e7eb;
    color: #9ca3af;
    cursor: not-allowed;
}

#penonton-table tbody tr {
    transition: background-color 0.15s ease-in-out;
}

#penonton-table tbody tr:hover {
    background-color: #f8fafc;
}

#penonton-table tbody tr:nth-child(even) {
    background-color: #f9fafb;
}

#penonton-table tbody tr:nth-child(odd) {
    background-color: #ffffff;
}

#penonton-table_processing {
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

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
$(function() {
    // Inisialisasi DataTable
    var table = $('#penonton-table').DataTable({
        processing: true,
        serverSide: false, // Ubah ke false untuk memuat semua data sekaligus
        ajax: {
            url: '{{ route('penonton.data') }}',
            error: function(xhr, error, thrown) {
                console.error('DataTable AJAX Error:', xhr, error, thrown);
                alert('Gagal memuat data penonton. Periksa koneksi atau login Anda.');
            }
        },
        columns: [
            { data: 'nama_lengkap', name: 'nama_lengkap' },
            { data: 'checked_in_at', name: 'checked_in_at' },
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
    $('#open-penonton-modal').on('click', function() {
        $('#penonton-modal').removeClass('hidden');
    });

    $('#close-penonton-modal, #cancel-penonton').on('click', function() {
        $('#penonton-modal').addClass('hidden');
    });

    // Close modal when clicking outside
    $('#penonton-modal').on('click', function(e) {
        if (e.target === this) {
            $(this).addClass('hidden');
        }
    });
});
</script>
@endsection
