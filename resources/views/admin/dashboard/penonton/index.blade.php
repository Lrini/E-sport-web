@extends('admin.dashboard.layouts.main')
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
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left uppercase border-b text-muted-foreground">Lomba</th>
                       <th class=" px-4 py-3 text-xs font-medium tracking-wider text-left uppercase border-b text-muted-foreground">Acara</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left uppercase border-b text-muted-foreground">No hp</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left uppercase border-b text-muted-foreground" style="width: 15%;">Biaya Tiket</th>
                        <th class="px-4 py-3 text-xs font-medium tracking-wider text-left uppercase border-b text-muted-foreground" style="width: 15%;">Status Pembayaran</th>
                        <th class="w-1/6 px-4 py-3 text-xs font-medium tracking-wider text-center uppercase border-b text-muted-foreground">QR ticket</th>
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

@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
$(function() {
    // Inisialisasi DataTable
    var table = $('#penonton-table').DataTable({
        processing: true,
        serverSide: false, // Ubah ke false untuk memuat semua data sekaligus
        ajax: {
            url: '{{ route('penonton.data') }}',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            error: function(xhr, error, thrown) {
                console.error('DataTable AJAX Error:', xhr, error, thrown);
                alert('Gagal memuat data penonton. Periksa koneksi atau login Anda.');
            }
        },
        columns: [
            { data: 'nama_lengkap', name: 'nama_lengkap' },
            { data: 'nama_lomba', name: 'nama_lomba' },
            { data: 'nama_acara', name: 'nama_acara' },
            { data: 'no_hp', name: 'no_hp' },
            { data: 'biaya_tiket', name: 'biaya_tiket' },
            { data: 'status_pembayaran', name: 'status_pembayaran' },
            {
                data: null,
                name: 'qr_ticket',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    if (row.tiket_code) {
                        return `
                            <div class="p-2 bg-white inline-block">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${row.tiket_code}" alt="QR Code">
                            </div>
                            <p class="text-sm mt-2 font-mono">${row.tiket_code}</p>
                        `;
                    } else {
                        return '<span class="text-red-500">Belum ada tiket</span>';
                    }
                }
            },
            {
                data: null,
                name: 'aksi',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="flex flex-col space-y-2">
                            <a class="px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-blue-500 rounded-md hover:bg-blue-600 w-20" href="/admin/dashboard/penonton/${row.id}/edit">
                                Update
                            </a>
                            <form action="/admin/dashboard/penonton/${row.id}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus penonton ini?')" class="inline">
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
@endpush
