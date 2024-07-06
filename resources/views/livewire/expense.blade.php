<div>
    <div class="m-12 p-6 rounded-md shadow-xl bg-[#fff]">
        <h1 class="text-black text-4xl font-bold flex justify-center p-4 rounded-md">Pengeluaran</h1>
            <div class="flex items-center my-8 overflow-hidden justify-evenly text-black">
            <form class="text-black" wire:submit="saveModalExpense">
                <table class="table-fixed">
                    <tr>
                        <td>
                            <p class="font-bold mt-4 mb-3">Shift</p>
                        </td>
                        <td>
                            <p class="mt-4 mb-3 font-bold">:</p>
                        </td>
                        <td>
                            <Select type="Select" class="btn btn-primary dropdown-toggle w-48 h-10 ml-4 @error('shift') is-invalid @enderror" data-bs-toggle="dropdown" aria-expanded="false" wire:model.blur="shift">
                                Pilih Shift
                                <option value="">Pilih Shift</option>
                                @foreach($shifts as $shift)
                                    <option value="{{$shift}}">{{$shift}}</option>
                                @endforeach
                            </Select>
                            @error('shift')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <p class="mt-4 font-bold mb-3">Tanggal</p>
                        </td>
                        <td>
                            <p class="mt-4 mb-3 font-bold">:</p>
                        </td>
                        <td>
                            <input class="px-3 border-1 w-48 h-10 peer ml-4 rounded-md bg-primary text-white @error('date') is-invalid @enderror" type="date" wire:model.blur="date">
                            @error('date')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                    </tr>
                </table>
        <div class="flex justify-center mt-3 mb-3 table-responsive">
            <table id="productTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr class="text-center">
                    <th class="px-6 py-3 text-xs font-semibold text-black uppercase">No</th>
                    <th class="px-6 py-3 text-xs font-semibold text-black uppercase">Produk</th>
                    <th class="px-6 py-3 text-xs font-semibold text-black uppercase">Harga</th>
                    <th class="px-6 py-3 text-xs font-semibold text-black uppercase">Jumlah</th>
                    <th class="px-6 py-3 text-xs font-semibold text-black uppercase">Total</th>
                    <th class="px-6 py-3 text-xs font-semibold text-black uppercase">Keterangan</th>
                    <th class="px-6 py-3 text-xs font-semibold text-black uppercase"></th>
                </tr>
                </thead>
                <tbody id="productTableBody" class="bg-white divide-y divide-gray-200">
                @foreach($products as $index => $product)
                    <tr>
                        <td class="px-6 py-4">{{$index + 1}}</td>
                        <td class="px-6 py-4" style="width: 250px">
                            <select class="w-full p-2 bg-blue-500 text-white rounded-md border-0 border-gray-200 peer text-center" wire:model.live="products.{{$index}}.option">
                                <option value="">Pilih Produk</option>
                                @foreach($option_products as $option)
                                    <option value="{{$option}}">{{$option}}</option>
                                @endforeach
                            </select>
                            @if($products[$index]['show_option'] == true)
                                <select class="w-full p-2 mt-2 text-white bg-blue-500 rounded-md border-0 border-gray-200 peer sub-product text-center" wire:model.blur="products.{{$index}}.name">
                                    <option value="">Pilih Sub Produk</option>
                                    @foreach($options[$index] as $option)
                                        <option value="{{$option}}">{{$option}}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text" class="w-full mt-2 p-2 border-0 border-b-2 border-gray-200 peer other-product text-center" placeholder="Produk" wire:model.blur="products.{{$index}}.name"/>
                            @endif
                            @error('products.' . $index . '.name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </td>
                        <td class="px-6 py-4" style="width: 150px">
                            <input type="number" class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer harga text-center" placeholder="0" wire:model.blur="products.{{$index}}.price" min="1"/>
                            @error('products.' . $index . '.name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td class="px-6 py-4" style="width: 75px">
                            <input type="number" class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer jumlah text-center" placeholder="0" wire:model.blur="products.{{$index}}.quantity" min="1"/>
                            @error('products.' . $index . '.quantity')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td class="px-6 py-4" style="width: 200px">
                            <input type="number" class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer total text-center" disabled placeholder="0" wire:model.blur="products.{{$index}}.total_price"/>
                            @error('products.' . $index . '.total_price')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td class="px-6 py-4" style="width: 200px">
                            <input type="text" class="w-full px-0 bg-transparent border-0 border-b-2 border-gray-200 appearance-none peer keterangan text-center" placeholder="-" wire:model.blur="products.{{$index}}.note"/>
                        </td>
                        @error('products.' . $index . '.note')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                        <td class="px-6 py-4">
                            @if($index > 0 && $loop->last)
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded" wire:click="removeProduct({{$index}})" type="button">
                                    X
                                </button>
                            @endif
                        </td>
                </tr>
                @endforeach

                        </tbody>
                    </table>
                </div>
                <button class="btn btn-success w-40" type="button" wire:click="addProduct">Tambah Produk</button>
                <button class="btn btn-primary w-32" type="submit">Simpan</button>
            </form>

    </div>
        <hr class="mt-4 mb-4">
        <div class="row" id="expense-table">
            <div class="col-3">
                <input type="date" class="form-control" wire:model.blur="startDate">
            </div>
            <div class="col-3">
                <input type="date" class="form-control" wire:model.blur="endDate" @if($startDate== null) disabled @endif>
            </div>
            <div class="col-1">
                <button class="btn btn-danger" type="button" @if($endDate == null) disabled @endif wire:click="resetFilter">Reset</button>
            </div>
            <div class="col-4">

            </div>
            <div class="col-1">
                <button class="btn btn-warning w-32 mb-4 float-end" type="button" wire:click="exportModalExpense" @if($expenses->isEmpty()) disabled @endif>Export</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light text-center">
                <tr>
                    <th scope="col">Shift</th>
                    <th scope="col">Total Produk</th>
                    <th scope="col">Total Pengeluaran</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody class="text-center">
                @forelse($expenses as $expense)
                    @php
                        $carbonDate = \Carbon\Carbon::parse($expense->date);
                        $date = $carbonDate->format('d-m-Y');
                    @endphp
                    <tr>
                        <td>{{$expense->shift}}</td>
                        <td>{{$expense->products_count}}</td>
                        <td>@currency($expense->total_price)</td>
                        <td>{{$date}}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary" wire:click.prevent="editExpense({{$expense->id}})">Edit</a>
                            <a href="#" class="btn btn-sm btn-danger" wire:click.prevent="deleteModalExpense({{$expense->id}})">Hapus</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            Tidak ada data pengeluaran
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div>
                {{ $expenses->links(data: ['scrollTo' => '#expense-table']) }}
            </div>
        </div>
</div>
</div>
