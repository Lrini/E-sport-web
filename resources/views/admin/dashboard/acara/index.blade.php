@extends('admin.dashboard.layouts.main')
@section('section')
<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="px-6 py-4 bg-gradient-to-r from-primary to-accent text-white">
        <h2 class="text-2xl font-bold">Daftar Acara</h2>
        <p class="text-sm opacity-90">Kelola acara lomba</p>
    </div>
    <div class="p-6">
        <div class="mb-4 flex justify-between items-center">
            <div>
                <button id="open-acara-modal" class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-md font-medium transition-colors duration-200">
                    Tambah Acara Baru
                </button>
            </div>
            <div class="text-sm text-muted-foreground">
                Total: <span id="total-count">0</span> acara
            </div>
        </div>
        <div class="overflow-x-auto">
            <table id="acara-table" class="w-full table-auto border-collapse">
                <thead class="bg-muted">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider border-b">Nama Acara</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider border-b">Tanggal Acara</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider border-b">Keterangan</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-muted-foreground uppercase tracking-wider border-b">Aksi</th>
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
#acara-table_wrapper .dataTables_length,
#acara-table_wrapper .dataTables_filter,
#acara-table_wrapper .dataTables_info,
#acara-table_wrapper .dataTables_paginate {
    margin-bottom: 1rem;
    color: #6b7280;
    font-size: 0.875rem;
}

#acara-table_wrapper .dataTables_length select,
#acara-table_wrapper .dataTables_filter input {
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    background-color: #ffffff;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

#acara-table_wrapper .dataTables_length select:focus,
#acara-table_wrapper .dataTables_filter input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

#acara-table_wrapper .dataTables_info {
    padding-top: 0.5rem;
}

#acara-table_wrapper .dataTables_paginate .paginate_button {
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

#acara-table_wrapper .dataTables_paginate .paginate_button:hover {
    background: #f3f4f6;
    border-color: #9ca3af;
    color: #111827;
}

#acara-table_wrapper .dataTables_paginate .paginate_button.current {
    background: #3b82f6;
    border-color: #3b82f6;
    color: #ffffff;
}

#acara-table_wrapper .dataTables_paginate .paginate_button.disabled {
    background: #f9fafb;
    border-color: #e5e7eb;
    color: #9ca3af;
    cursor: not-allowed;
}

#acara-table tbody tr {
    transition: background-color 0.15s ease-in-out;
}

#acara-table tbody tr:hover {
    background-color: #f8fafc;
}

#acara-table tbody tr:nth-child(even) {
    background-color: #f9fafb;
}

#acara-table tbody tr:nth-child(odd) {
    background-color: #ffffff;
}

#acara-table_processing {
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
    var table = $('#acara-table').DataTable({
        processing: true,
        serverSide: false, // Ubah ke false untuk memuat semua data sekaligus
        ajax: '{{ route('acara.data') }}',
        columns: [
            { data: 'nama_acara', name: 'nama_acara' },
            { data: 'tanggal_acara', name: 'tanggal_acara' },
            { data: 'keterangan', name: 'keterangan' },
            {
                data: null,
                name: 'aksi',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="flex space-x-2 justify-center">
                            <a class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm font-medium transition-colors duration-200" href="/admin/dashboard/acara/${row.id}/update">
                                Update
                            </a>
                            <form action="/admin/dashboard/acara/${row.id}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus acara ini?')">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm font-medium transition-colors duration-200">
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
    $('#open-acara-modal').on('click', function() {
        $('#acara-modal').removeClass('hidden');
    });

    $('#close-acara-modal, #cancel-acara').on('click', function() {
        $('#acara-modal').addClass('hidden');
    });

    // Close modal when clicking outside
    $('#acara-modal').on('click', function(e) {
        if (e.target === this) {
            $(this).addClass('hidden');
        }
    });
});
</script>
@endsection

@include('admin.dashboard.modals.acaraCreate')
