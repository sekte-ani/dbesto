@extends('app')
@section('content')
<div class="m-12 p-6 rounded-md shadow-xl bg-[#fff]">
    <h1 class="text-black text-4xl font-bold flex justify-center p-4 rounded-md">Pengeluaran</h1>
    <div class="flex items-center my-8 overflow-hidden justify-evenly text-black">
        
        <form class="text-black" id="pengeluaranForm">
            <table class="table-fixed">
                <tr>
                        <td class="items-end"><label class="text-lg  font-semibold " for="shift">Pilih Shift Anda </label></td>
                        <td class="pl-3 items-center">:</td>
                        <td>
                                <select class="p-2 border-2 w-40 peer ml-4 rounded-md bg-[#007bff] text-white " name="shift" id="">
                                    <option value="pagi">Pagi</option>
                                    <option value="malam">Malam</option>
                                </select>
                        </td>
                        
                    </div>
                </tr>
                <tr>
                    
                        <td><label class=" flex flex-col text-lg font-semibold" for="tanggal">Tanggal Pemasukan </label></td>
                        <td class="pl-3">:</td>
                        <td><input class="px-3 border-2 w-48 peer ml-4 rounded-md bg-[#007bff] text-white" type="date" name="tanggal" id=""></td>
                  
                </tr>
            </table>
            
            
            
            <div class="flex justify-end">
                <button class="btn-warning p-2 mx-2 rounded-md">Print Data</button>
            </div>
            <div class="flex justify-center ">
                <table id="productTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider">Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider">Sub Produk / Produk Lainnya</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider">Total Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider">Keterangan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-black uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody" class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4">1</td>
                            <td class="px-6 py-4 text-white">
                                <select class="w-full p-2  bg-blue-500 rounded-md border-0 border-gray-200 peer" onchange="handleProductChange(this)">
                                    <option value="">Pilih Produk</option>
                                    <option value="Gas">Gas</option>
                                    <option value="Sayuran">Sayuran</option>
                                    <option value="Sabun Cuci Piring">Sabun Cuci Piring</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 ">
                                <select class="w-full p-2 text-white  bg-blue-500 rounded-md border-0 border-gray-200 peer sub-product" style="display:none;">
                                    <option value="">Pilih Sub Produk</option>
                                    <!-- Sub produk bisa diisi sesuai kebutuhan -->
                                </select>
                                <input type="text" class="w-full p-2 border-0 border-b-2 border-gray-200 peer other-product" style="display:none;" placeholder="Masukkan Produk Lainnya"/>
                            </td>
                            <td class="px-6 py-4"><input type="number" class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer harga" oninput="calculateTotal(this)" placeholder="-" /></td>
                            <td class="px-6 py-4"><input type="number" class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer jumlah" oninput="calculateTotal(this)" placeholder="-" /></td>
                            <td class="px-6 py-4"><input type="number" class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer total" disabled placeholder="-" /></td>
                            <td class="px-6 py-4"><input type="text" class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer keterangan" placeholder="-" /></td>
                            <td class="px-6 py-4">
                                <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="addRow()">Tambah Barang</button>
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="removeRow(this)" style="display:none;">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            
            </div>
            <button class="btn btn-primary w-32 " type="button" onclick="submitForm()">Submit</button>
            <button class="btn btn-danger w-32 " type="button" onclick="resetForm()">Cancel</button>  
        </form>

        <script>
            function handleProductChange(selectElement) {
                const subProductSelect = selectElement.parentElement.nextElementSibling.querySelector('.sub-product');
                const otherProductInput = selectElement.parentElement.nextElementSibling.querySelector('.other-product');
                const productValue = selectElement.value;
    
                subProductSelect.innerHTML = ''; // Clear previous options
                if (productValue === "Lainnya") {
                    subProductSelect.style.display = "none";
                    otherProductInput.style.display = "block";
                } else {
                    subProductSelect.style.display = "block";
                    otherProductInput.style.display = "none";
    
                    let subProducts = [];
                    if (productValue === "Gas") {
                        subProducts = ["Gas Kecil", "Gas Besar"];
                    } else if (productValue === "Sayuran") {
                        subProducts = ["Sayuran", "Cabe", "Sayuran dan Cabe"];
                    } else if (productValue === "Sabun Cuci Piring") {
                        subProducts = ["Mama Lemon", "Sunlight"];
                    }
    
                    subProducts.forEach(subProduct => {
                        const option = document.createElement("option");
                        option.value = subProduct;
                        option.text = subProduct;
                        subProductSelect.appendChild(option);
                    });
                }
            }
    
            function calculateTotal(element) {
                const row = element.parentElement.parentElement;
                const harga = parseFloat(row.querySelector('.harga').value) || 0;
                const jumlah = parseFloat(row.querySelector('.jumlah').value) || 0;
                const total = row.querySelector('.total');
                total.value = harga * jumlah;
            }
    
            function addRow() {
                
                const tableBody = document.getElementById('productTableBody');
                const newRow = tableBody.rows[0].cloneNode(true);
    
                newRow.querySelectorAll('input').forEach(input => input.value = '');
                newRow.querySelectorAll('select').forEach(select => select.value = '');
                newRow.querySelector('.total').value = '';
                newRow.querySelector('.sub-product').style.display = 'none';
                newRow.querySelector('.other-product').style.display = 'none';
    
                newRow.querySelector('button[onclick="addRow()"]').style.display = 'none';
                newRow.querySelector('button[onclick="removeRow(this)"]').style.display = 'inline-block';
    
                // Set row number
                newRow.cells[0].textContent = tableBody.rows.length + 1;
    
                tableBody.appendChild(newRow);
            }
    
            function removeRow(button) {
                const row = button.parentElement.parentElement;
                row.remove();
    
                // Update row numbers
                const tableBody = document.getElementById('productTableBody');
                for (let i = 0; i < tableBody.rows.length; i++) {
                    tableBody.rows[i].cells[0].textContent = i + 1;
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

    function resetForm() {
        document.getElementById('pengeluaranForm').reset();
    }
        </script>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="confirmPopup(false)">Cancel</button>yyy
                        <button type="button" class="btn btn-primary" onclick="confirmPopup(true)">Oke</button>
                        
                    </div>
                </div>
            </div>
        </div>
<!-- Modal HTML -->
        
@endsection
{{-- <script>
    


</script> --}}

