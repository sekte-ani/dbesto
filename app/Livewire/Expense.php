<?php

namespace App\Livewire;

use App\Exports\ExpenseExport;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Expense extends Component
{
    use WithPagination;

    public \App\Models\Expense $expenseModel;

    #[Validate('required|string')]
    public string $shift;

    #[Validate('required|date')]
    public $date;

    #[Validate('nullable|date')]
    public $startDate = null;

    #[Validate('nullable|date')]
    public $endDate = null;

    public $products = [];
    public $options = [];

    public bool $edit = false;

    protected $rules = [
        'products.*.name' => 'required|string|max:50',
        'products.*.price' => 'required|integer|min:1',
        'products.*.quantity' => 'required|integer|min:1',
        'products.*.total_price' => 'required|integer',
        'products.*.note' => 'max:100'
    ];

    public function messages()
    {
        return [
            'products.*.name.required' => 'The name field is required.',
            'products.*.name.string' => 'The name field must be string.',
            'products.*.name.max:50' => 'The name field is too long.',
            'products.*.price.required' => 'The price field is required.',
            'products.*.price.int' => 'The price field must be number.',
            'products.*.price.min:1' => 'The price field must be more than 1.',
            'products.*.quantity.required' => 'The quantity field is required.',
            'products.*.quantity.int' => 'The quantity field must be number.',
            'products.*.quantity.min:1' => 'The quantity field must be more than 1.',
            'products.*.total_price.int' => 'The total price field must be number.',
            'products.*.total_price.min:1' => 'The total price field must be more than 1.',
            'products.*.note.string' => 'The note field must be string.',
            'products.*.note.max:100' => 'The note field is too long.',
        ];
    }

    public function mount()
    {
        $this->products[] = [
            'option' => '',
            'show_option' => '',
            'name' => '',
            'price' => '',
            'quantity' => '',
            'total_price' => 0,
            'note' => null
        ];
    }

    public function updated($key, $value)
    {
        $parts = explode('.', $key);

        if($parts[0] == 'products'){
            if($parts[2] == 'option'){
                $this->products[$parts[1]]['option'] = $value;

                if($value == 'Lainnya' || $value == ''){
                    $this->products[$parts[1]]['name'] = '';
                    $this->products[$parts[1]]['show_option'] = false;
                }else{
                    $this->products[$parts[1]]['name'] = '';
                    $this->products[$parts[1]]['show_option'] = true;

                    if($value == 'Gas'){
                        $this->options[$parts[1]] = ['Gas Kecil', 'Gas Besar'];
                    }elseif($value == 'Sayuran'){
                        $this->options[$parts[1]] = ['Sayuran', 'Sayuran + Cabe', 'Cabe'];
                    }elseif($value == 'Sabun Cuci Piring'){
                        $this->options[$parts[1]] = ['Mamalemon', 'Sunlight'];
                    }
                }
            }elseif($parts[2] == 'quantity'){
                if($this->products[$parts[1]]['price'] != ''){
                    $this->products[$parts[1]]['total_price'] = (int)$value * (int)$this->products[$parts[1]]['price'];
                }
            }elseif($parts[2] == 'price'){
                if($this->products[$parts[1]]['quantity'] != ''){
                    $this->products[$parts[1]]['total_price'] = (int)$value * (int)$this->products[$parts[1]]['quantity'];
                }
            }
        }
    }

    public function addProduct()
    {
        $this->products[] = [
            'option' => '',
            'show_option' => '',
            'name' => '',
            'price' => '',
            'quantity' => '',
            'total_price' => 0,
            'note' => null
        ];
    }

    public function removeProduct($index)
    {
        unset($this->products[$index]);
        $this->products = array_values($this->products);
    }

    public function saveModalExpense()
    {
        if($this->products == []){
            $this->dispatch('swal',
                icon: 'error',
                title: 'Tambahkan produk terlebih dahulu',
            );
        }else{
            $this->validate();

            $this->dispatch('swal-dialog',
                title: $this->edit ? 'Anda ingin mengubah data pengeluaran?' : 'Anda ingin menyimpan data pengeluaran?',
                showCancelButton: true,
                confirmButtonText: $this->edit ? 'Ubah' : 'Simpan',
                functionName: 'saveExpense'
            );
        }
    }

    public function resetFilter()
    {
        $this->reset('startDate', 'endDate');
    }

    public function editExpense(\App\Models\Expense $expense)
    {
        if($expense->exists){
            $this->edit = true;

            $this->expenseModel = $expense;
            $products = Product::where('expense_id', $expense->id)->get();

            $this->shift = $expense->shift;
            $this->date = $expense->date;

            unset($this->products[0]);
            $this->products = array_values($this->products);

            foreach ($products as $product){
                if($product->name == 'Gas Kecil' || $product->name == 'Gas Besar'){
                    $option = 'Gas';
                    $show_option = true;
                }elseif($product->name == 'Sayuran' || $product->name == 'Sayuran + Cabe'){
                    $option = 'Sayuran';
                    $show_option = true;
                }else if($product->name == 'Mamalemon' || $product->name == 'Sunlight'){
                    $option = 'Sabun Cuci Piring';
                    $show_option = true;
                }else{
                    $option = 'Lainnya';
                    $show_option = false;
                }

                $this->products[] = [
                    'id' => $product->id,
                    'option' => $option,
                    'show_option' => $show_option,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $product->quantity,
                    'total_price' => $product->total_price,
                    'note' => $product->note
                ];
            }

            foreach($this->products as $index => $product){
                if($product['option'] == 'Gas'){
                    $this->options[$index] = ['Gas Kecil', 'Gas Besar'];
                }elseif($product['option'] == 'Sayuran'){
                    $this->options[$index] = ['Sayuran', 'Sayuran + Cabe', 'Cabe'];
                }elseif($product['option'] == 'Sabun Cuci Piring'){
                    $this->options[$index] = ['Mamalemon', 'Sunlight'];
                }
            }
        }
    }

    #[On('saveExpense')]
    public function saveExpense()
    {
        $validated = $this->validate();

        try {

            if($this->edit){

                $total_price = 0;

                foreach ($this->products as $product){
                    $total_price += $product['total_price'];

                    if(array_key_exists('id',$product)){
                        $productModel = Product::find($product['id']);

                        $productModel->update([
                            'name' => $product['name'],
                            'price' => $product['price'],
                            'quantity' => $product['quantity'],
                            'total_price' => $product['total_price'],
                            'note' => $product['note'] ?? null
                        ]);

                    }else{
                        Product::create([
                            'expense_id' => $this->expenseModel->id,
                            'name' => $product['name'],
                            'price' => $product['price'],
                            'quantity' => $product['quantity'],
                            'total_price' => $product['total_price'],
                            'note' => $product['note'] ?? null
                        ]);
                    }

                }

                $this->expenseModel->update([
                    'shift' => $validated['shift'],
                    'date' => $validated['date'],
                    'total_price' => $total_price,
                ]);

                DB::commit();

                $this->dispatch('swal',
                    icon: 'sucess',
                    title: 'Data pengeluaran berhasil diubah',
                );

            }else{
                $expense = \App\Models\Expense::create([
                    'shift' => $validated['shift'],
                    'date' => $validated['date']
                ]);

                $total_price = 0;

                foreach ($this->products as $product){
                    $total_price += $product['total_price'];

                    Product::create([
                        'expense_id' => $expense->id,
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'quantity' => $product['quantity'],
                        'total_price' => $product['total_price'],
                        'note' => $product['note'] ?? null
                    ]);
                }

                $expense->update([
                    'total_price' => $total_price
                ]);

                DB::commit();

                $this->dispatch('swal',
                    icon: 'sucess',
                    title: 'Data pengeluaran berhasil disimpan',
                );
            }

            $this->reset();
            $this->redirectRoute('home', navigate: true);

        }catch (\Exception $e){
            DB::rollBack();
            $this->dispatch('swal',
                icon: 'error',
                title: $e->getMessage(),
            );
        }
    }

    public function deleteModalExpense(int $id)
    {
        $this->dispatch('swal-dialog',
            title: 'Anda ingin menghapus data pengeluaran?',
            showCancelButton: true,
            confirmButtonText: 'Oke',
            functionName: 'deleteExpense',
            id: $id,
        );
    }

    #[On('deleteExpense')]
    public function deleteExpense(int $id)
    {
        try {
            $expense = \App\Models\Expense::find($id);
            $expense->delete();

            $this->dispatch('swal',
                icon: 'success',
                title: 'Data pengeluaran berhasil dihapus',
            );

        }catch (\Exception $e){
            return $this->dispatch('swal',
                icon: 'error',
                title: $e->getMessage(),
            );
        }
    }

    public function exportModalExpense()
    {
        $this->dispatch('swal-dialog',
            title: 'Anda ingin export data pengeluaran ke excel?',
            showCancelButton: true,
            confirmButtonText: 'Export',
            functionName: 'exportExpenseToExcel'
        );
    }

    #[On('exportExpenseToExcel')]
    public function exportExpenseToExcel()
    {
        try {
            return Excel::download(new ExpenseExport($this->startDate, $this->endDate), 'Pengeluaran-' . now()->format('d-m-Y') . '.xlsx');
        }catch (\Exception $e){
            return $this->dispatch('swal',
                icon: 'error',
                title: $e->getMessage(),
            );
        }
    }

    #[Title('Pengeluaran')]
    public function render()
    {
        $shifts = ['Siang','Malam'];
        $option_products = ['Gas', 'Sayuran', 'Sabun Cuci Piring', 'Lainnya'];

        if($this->endDate == null){
            $expenses = \App\Models\Expense::with('products')->withCount('products')->orderBy('date', 'desc')->paginate(15);
        }else{
            $expenses = \App\Models\Expense::whereBetween('date', [$this->startDate, $this->endDate])->orderBy('date', 'desc')->paginate(15);
        }
        return view('livewire.expense', compact('shifts', 'expenses','option_products'));
    }
}
