@extends('app')
@section('content')
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kehadiran Karyawan</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #38bdf8;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 50px;
        }

        .form-group label {
            font-weight: bold;
        }

        .note {
            display: none;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .modal-header,
        .modal-footer {
            border: none;
        }
    </style>
</head>

<body>
    <div class="container form-container">
        <h2 class="text-center mb-4">Kehadiran Karyawan</h2>
        <form id="attendanceForm">
            <div class="form-group">
                <label for="shift">Shift :</label>
                <Select type="Select" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Pilih Shift
                    <option selected>Pilih Shift Kehadiran</option>
                    <option value="1">Siang</option>
                    <option value="2">Malam</option>
                </Select>
            </div>

            <div class="form-group">
                <label for="sesi">Sesi :</label>
                <Select type="Select" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Pilih Sesi
                    <option selected>Pilih Sesi</option>
                    <option value="1">Kedatangan</option>
                    <option value="2">kepulangan</option>
                </Select>
            </div>

            <div class="form-group">
                <label for="date">Masukkan Tanggal :</label>
                <input type="date" class="form-control col-sm-2 col-form-label" id="date" name="date">
            </div>

            <div class="form-group">
                <label for="karyawan1">Karyawan 1:</label>
                <input type="text" class="form-control" id="karyawan1" name="karyawan1" placeholder="Nama Karyawan">
                <select class="form-control mt-2" id="status1" name="status1" onchange="toggleNoteField(1)">
                    <option value="hadir">Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="tanpa_keterangan">Tanpa Keterangan</option>
                    <option value="telat">Telat</option>
                </select>
                <input type="text" class="form-control note mt-2" id="note1" placeholder="Keterangan">
            </div>

            <div class="form-group">
                <label for="karyawan2">Karyawan 2:</label>
                <input type="text" class="form-control" id="karyawan2" name="karyawan2" placeholder="Nama Karyawan">
                <select class="form-control mt-2" id="status2" name="status2" onchange="toggleNoteField(2)">
                    <option value="hadir">Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="tanpa_keterangan">Tanpa Keterangan</option>
                    <option value="telat">Telat</option>
                </select>
                <input type="text" class="form-control note mt-2" id="note2" placeholder="Keterangan">
            </div>

            <div class="form-group">
                <label for="karyawan3">Karyawan 3:</label>
                <input type="text" class="form-control" id="karyawan3" name="karyawan3" placeholder="Nama Karyawan">
                <select class="form-control mt-2" id="status3" name="status3" onchange="toggleNoteField(3)">
                    <option value="hadir">Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="tanpa_keterangan">Tanpa Keterangan</option>
                    <option value="telat">Telat</option>
                </select>
                <input type="text" class="form-control note mt-2" id="note3" placeholder="Keterangan">
            </div>

            <button type="button" class="btn btn-primary btn-block" onclick="submitForm()">Submit</button>
        </form>

        <div id="popup" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Data anda telah tersimpan.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="confirmPopup(true)">Oke</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="confirmPopup(false)">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function toggleNoteField(karyawanNumber) {
            const status = document.getElementById(`status${karyawanNumber}`).value;
            const noteField = document.getElementById(`note${karyawanNumber}`);
            if (status === 'izin' || status === 'telat') {
                noteField.style.display = 'block';
            } else {
                noteField.style.display = 'none';
            }
        }

        function submitForm() {
            $('#popup').modal('show');
        }

        function confirmPopup(isConfirmed) {
            if (isConfirmed) {
                alert('Program akan kembali mengarah ke halaman utama.');
                window.location.href = 'menuscreen.blade.php';
            } else {
                $('#popup').modal('hide');
            }
        }
    </script>
</body>

</html>