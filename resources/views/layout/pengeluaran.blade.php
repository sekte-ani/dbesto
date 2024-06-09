@extends('app')
@section('content')
<div class="m-12 p-6 rounded-md shadow-xl bg-[#fff]">
    <h1 class="text-black text-4xl font-bold flex justify-center p-4 rounded-md">Pengeluaran</h1>
    <div class="flex items-center my-8 overflow-hidden justify-evenly text-black">
        
        <form class="text-black" id="pengeluaranForm">
            <div class="rounded-md p-2 flex items-center ">
                <label class="text-lg  font-semibold" for="shift">Pilih Shift Anda :</label>
                <select class="p-2 border-2 w-40 peer ml-4 rounded-md bg-[#007bff] text-white" name="shift" id="">
                    <option value="pagi">Pagi</option>
                    <option value="malam">Malam</option>
                </select>
            </div>
            
            <div class="rounded-md p-2 mt-4 flex items-center">
                <label class=" flex flex-col text-lg font-semibold" for="tanggal">Tanggal Pemasukan :</label>
                <input class="px-3 border-2 w-48 peer ml-4 rounded-md bg-[#007bff] text-white" type="date" name="tanggal" id="">
            </div>
            <div class="flex justify-center">
                <table class="table table-bordered mt-3 max-w-screen-2xl w-screen justify-center text-black rounded-md ">
                    <thead class="">
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Pengeluaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Makan Karyawan</td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><select class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" name="Gas" id="">
                            <option value="gas_besar">Gas Besar</option>
                            <option value="gas_kecil">Gas Kecil</option>   
                            </select></td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Pulsa Listrik</td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                            <select class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" name="Sayuran" id="">
                                <option value="">Sayuran</option>
                                <option value="">Cabe dan Sayuran</option>
                                <option value="">Cabe</option>
                            </select></td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Sabun Cuci Piring</td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Pembersih Lantai</td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Rinso</td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Isi Ulang Air</td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Air Bu Haji</td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Tissue</td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>Keju Slice</td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                            <td>
                                <input class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="number" placeholder = "-">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button class="btn btn-primary w-32 " type="button" onclick="submitForm()">Submit</button> 
            <a class="btn btn-danger w-32 " href="/">Cancel</a>
        </form>
    </div> 
</div>
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
<!-- Modal HTML -->
        
@endsection
<script>
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

