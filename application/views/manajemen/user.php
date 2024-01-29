<div class="container-fluid my-3">
    <div class="card border-0">
        <div class="card-body">
            <h3 class="text-capitalize fw-bold mb-4" style="color: #012970;">Manajemen User</h3>

            <table class="table myTable compact " id="myTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Status</th>
                        <th scope="col">Level</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        let table = $('#myTable').DataTable({
            /* 
            (1)
             kalo ga mau pagination kasih paging: false
             paging: false,
            */

            /*
            (2)
            kalo mau ngatur tinggiinya, jadi si paginationnya juga ada dibawah
            scrollY: 500,
            */

            /*
            (3)
            kalo ga mau ada searchingnya
            searching: false,
            */

            /*
            (4)
            ini untuk menghilahkan tanda panah pada head table, atau order-column
            "columnDefs": [{
                "orderable": false,
                "targets": [2, 3, 4]
            }],
            */

            "pageLength": 20, // Menampilkan 20 entri per halaman secara default
            "lengthMenu": [10, 20, 50, 100], // Opsi dropdown untuk memilih jumlah entri per halaman
            "processing": true,
            "serverSide": true,
            "order": [],
            "columnDefs": [{
                "orderable": false,
                "targets": [0]
            }],
            "ajax": {
                "url": "<?= base_url('manajemen/get_users') ?>", // Sesuaikan dengan nama file API PHP
                "type": "POST"
            },
            "columns": [{
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1; // Nomor urut baris dimulai dari 1
                    }
                },
                {
                    "data": "nama"
                },
                {
                    "data": "username"
                },
                {
                    "data": "status"
                },
                {
                    "data": "level"
                }
            ],
            "language": {
                "sProcessing": "Sedang memproses...",
                "sLengthMenu": "Tampilkan _MENU_ data",
                "sZeroRecords": "Tidak ditemukan data yang sesuai",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sInfoPostFix": "",
                "sSearch": "Cari:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Terakhir"
                }
            }
        });
        $("#myTable_filter label input").attr('placeholder', 'Search..');
        $("#myTable_filter label").append(`<span class="material-symbols-sharp search-icon">search</span>`)
        $("#myTable_filter label").contents().first().remove();
    });
</script>