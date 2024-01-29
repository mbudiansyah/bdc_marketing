<style>
    /* Mengganti animasi modal */
    .modal.fade .modal-dialog {
        transition: transform 0.4s ease-out, opacity 0.4s ease-out;
    }

    /* Mengurangi opacity background hitam */
    .modal-backdrop {
        opacity: 0.1 !important;
        /* Sesuaikan dengan tingkat kecerahan yang diinginkan */
    }

    .custom-btn-close {
        position: absolute;
        top: 12px;
        right: 13px;
        color: red !important;
        opacity: 1;
        font-size: 0.7rem;
    }

    .upload {
        display: flex;
        flex-direction: column;
        align-items: space-between;
        gap: 20px;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        width: 300px;
        height: 200px;
        border: 2px dashed #cacaca;
        background: rgba(255, 255, 255, 1);
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0px 48px 35px -48px rgba(0, 0, 0, 0.1);
    }
</style>
<div class="container-fluid my-3">
    <div class="card border-0">
        <div class="card-body">
            <h3 class="text-capitalize fw-bold mb-5" style="color: #012970;">Data Prospek</h3>

            <div class="mb-2">
                <button class="btn btn-sm fw-semibold btn-primary" onclick="location.href='<?= base_url('assets/excel/Template Data Prospek.xlsx') ?>'">Template Excel</button>
                <button class="btn btn-sm fw-semibold btn-primary" id="btn_tambah">Tambah Data</button>
            </div>

            <!-- <div class="d-flex justify-content-between mb-5">
                <div>
                    <button class="btn btn-sm fw-semibold btn-primary">Template Excel</button>
                </div>

                <div>
                    <button class="btn btn-sm fw-semibold btn-primary">Tambah Data</button>
                </div>
            </div> -->
            <table class="table myTable compact " id="myTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Prodi</th>
                        <th scope="col">Kota</th>
                        <th scope="col">Email</th>
                        <th scope="col">Kampus</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg shadow-sm">
        <div class="modal-content border-0">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <form action="" enctype="multipart/form-data" id="add_data">
                    <h3 class="modal-title fw-bold text-center mb-3" id="staticBackdropLabel" style="color: #012970;">Tambah Data Prospek</h3>
                    <div class="mb-2">
                        <label class="form-label fw-semibold">Cara Upload Data</label>
                        <select class="form-select shadow-none" id="opsi">
                            <option value="single">Upload Satu Data</option>
                            <option value="bulk">Upload Banyak Data (Excel)</option>
                        </select>
                    </div>
                    <div class="my-3" id="opsi_bulk" style="display: none;">
                        <label for="file" class="upload m-auto">
                            <span class="material-symbols-sharp" style="font-size: 5rem;">
                                upload_file
                            </span>
                            <span id="text">
                                Click To Upload Excel
                            </span>
                            <input type="file" id="file" name="file" class="d-none" onchange="changeText(this)" accept=".xlsx, .xls, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">

                        </label>

                    </div>
                    <div class="row" id="opsi_single">
                        <div class="col-6 mb-2">
                            <label class="form-label fw-semibold">Sumber Data</label>
                            <select class="form-select shadow-none">
                                <option value="single">Facebook Ads</option>
                                <option value="bulk">Instagram Ads</option>
                            </select>
                        </div>
                        <div class="col-6 mb-2">
                            <label class="form-label fw-semibold">Pic Up</label>
                            <select class="form-select shadow-none">
                                <option value="single">Ya</option>
                                <option value="bulk">Tidak</option>
                            </select>
                        </div>
                        <div class="col-6 mb-2">
                            <label class="form-label fw-semibold">Prodi</label>
                            <select class="form-select shadow-none">
                                <option value="single">S1 - Manajemen</option>
                                <option value="bulk">Tidak</option>
                            </select>
                        </div>
                        <div class="col-6 mb-2">
                            <label class="form-label fw-semibold">Kota</label>
                            <input type="text" class="form-control shadow-none" id="" placeholder="Jakarta">
                        </div>
                        <div class="col-6 mb-2">
                            <label class="form-label fw-semibold">Nama Perusahaan</label>
                            <input type="text" class="form-control shadow-none" id="" placeholder="">
                        </div>
                        <div class="col-6 mb-2">
                            <label class="form-label fw-semibold">Alamat Perusahaan</label>
                            <input type="text" class="form-control shadow-none" id="" placeholder="">
                        </div>
                        <div class="col-6 mb-2">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="text" class="form-control shadow-none" id="" placeholder="">
                        </div>

                        <div class="col-6 mb-2">
                            <label class="form-label fw-semibold">Kampus</label>
                            <select class="form-select shadow-none">
                                <option value="single">UNKRIS</option>
                                <option value="bulk">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary fw-semibold" type="submit">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>




<script>
    $(document).ready(function() {

        $("#btn_tambah").on('click', function() {
            $("#modal_tambah").modal('show');
        })
        $("#opsi").on('change', function() {
            if ($(this).val() === 'single') {
                $("#opsi_single").show();
                $("#opsi_bulk").hide();
            } else {
                $("#opsi_single").hide();
                $("#opsi_bulk").show();
            }
        })

        $('#add_data').submit(function(e) {
            // $(".message").html(``);
            e.preventDefault();
            // Menonaktifkan tombol submit
            $(this).find(':submit').prop('disabled', true);
            var t = $(this);
            var formData = new FormData(this);
            // formData.append('aa', 'xx');
            $.ajax({
                url: `<?php echo base_url('data_prospek/store') ?>`,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $(this).find(':submit').prop('disabled', false);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    t.find(':submit').prop('disabled', false);
                    var errorResponse = jqXHR.responseJSON;
                    console.log(errorResponse);
                    $(".message").show().append(`${errorResponse.message}`)
                }
            });
        });

        let table = $('#myTable').DataTable({
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

    function changeText(input) {
        let fileName = input.files[0].name;
        document.getElementById('text').innerText = fileName;
    }
</script>