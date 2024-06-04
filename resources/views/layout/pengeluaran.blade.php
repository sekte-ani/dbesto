@extends('app')
@section('content')
<div class="m-12 bg-sky-400 p-6">
    <h1 class="text-white text-4xl font-bold flex justify-center bg-sky-300 p-4 rounded-md">Pengeluaran</h1>
    <div class="flex items-center my-8 overflow-hidden justify-evenly text-black">
        
        <form class="text-black" action="" method="POST">
            <div class="rounded-md bg-sky-200 p-2">
                <label class="text-2xl w-full font-semibold" for="shift">Pilih Shift Anda :</label>
                <select class="w-48 px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" name="shift" id="">
                    <option value="pagi">Pagi</option>
                    <option value="malam">Malam</option>
                </select>
            </div>
            
            <div class="rounded-md bg-sky-200 p-2 mt-4">
                <label class=" flex flex-col text-2xl font-semibold" for="tanggal">Tanggal Pemasukan :</label>
                <input class="px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer" type="date" name="tanggal" id="">
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
            <button class="btn btn-primary w-32 " type="submit">Submit</button> 
            <a class="btn btn-danger w-32 " href="/">Cancel</a>

        </form>
    </div>  
</div>
@endsection