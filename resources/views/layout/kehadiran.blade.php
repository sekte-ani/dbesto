@extends('app')
@section('content')
<div class="m-12 p-6 rounded-md shadow-xl bg-[#fff]">
    <h1 class="text-black text-4xl font-bold flex justify-center p-4 rounded-md">Kehadiran Karyawan</h1>
    <form class="text-black" id="kehadiranForm">
        <div class="form-group mx-5">
            <table border="0">
                <tr>
                    <td>
                        <p class="font-bold mt-4 mb-4">Shift</p>
                    </td>
                    <td>
                        <p class="mt-4 mb-4 font-bold">:</p>
                    </td>
                    <td> <Select type="Select" class="btn btn-primary dropdown-toggle w-48 h-10 ml-4" data-bs-toggle="dropdown" aria-expanded="false">
                            Pilih Shift
                            <option selected>Pilih Shift</option>
                            <option value="1">Siang</option>
                            <option value="2">Malam</option>
                        </Select> </td>
                </tr>

                <tr>
                    <td>
                        <p class="font-bold mt-4 mb-4">Sesi</p>
                    </td>
                    <td>
                        <p class="mt-4 mb-4 font-bold">:</p>
                    </td>
                    <td><Select type="Select" class="btn btn-primary dropdown-toggle w-48 h-10 ml-4" data-bs-toggle="dropdown" aria-expanded="false">
                            Pilih Sesi
                            <option selected>Pilih Sesi</option>
                            <option value="1">Kedatangan</option>
                            <option value="2">kepulangan</option>
                        </Select>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p class="mt-4 mb-4 font-bold">Masukkan Tanggal</p>
                    </td>
                    <td>
                        <p class="mt-4 mb-4 font-bold">:</p>
                    </td>
                    <td><input class="px-3 border-1 w-48 h-10 peer ml-4 rounded-md bg-primary text-white " type="date" name="tanggal" id=""></td>
                </tr>
            </table>

            <div class="form-group mt-3">
                <label for="karyawan1">Karyawan 1 :</label>
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
                <label for="karyawan2">Karyawan 2 :</label>
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
                <label for="karyawan3">Karyawan 3 :</label>
                <input type="text" class="form-control" id="karyawan3" name="karyawan3" placeholder="Nama Karyawan">
                <select class="form-control mt-2" id="status3" name="status3" onchange="toggleNoteField(3)">
                    <option value="hadir">Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="tanpa_keterangan">Tanpa Keterangan</option>
                    <option value="telat">Telat</option>
                </select>
                <input type="text" class="form-control note mt-2" id="note3" placeholder="Keterangan">
            </div>

            <button class="btn btn-primary w-32 " type="button" onclick="submitForm()">Submit</button>
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
                    <p>Data anda akan disimpan. Lanjutkan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="confirmPopup(false)">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="confirmPopup(true)">Oke</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script start -->
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
            window.location.href = '/menu';
        } else {
            $('#popup').modal('hide');
        }
    }
</script>
<!-- Script end -->
@endsection