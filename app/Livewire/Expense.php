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

    #[Validate('required|string|max:25')]
    public string $shift;

    #[Validate('required|date')]
    public $date;

    #[Validate('nullable|date')]
    public $startDate = null;

    #[Validate('nullable|date')]
    public $endDate = null;

    public $products = [];
    public $options = [];

    protected $rules = [
        'products.*.name' => 'required|string|max:255',
        'products.*.price' => 'required|integer|min:1',
        'products.*.quantity' => 'required|integer|min:1',
        'products.*.total_price' => 'required|integer',
        'products.*.note' => 'max:225'
    ];

    public function messages()
    {
        return [
            'products.*.name.required' => 'The name field is required.',
            'products.*.name.string' => 'The name field must be string.',
            'products.*.name.max:225' => 'The name field is too long.',
            'products.*.price.required' => 'The price field is required.',
            'products.*.price.int' => 'The price field must be number.',
            'products.*.price.min:1' => 'The price field must be more than 1.',
            'products.*.quantity.required' => 'The quantity field is required.',
            'products.*.quantity.int' => 'The quantity field must be number.',
            'products.*.quantity.min:1' => 'The quantity field must be more than 1.',
            'products.*.total_price.int' => 'The total price field must be number.',
            'products.*.total_price.min:1' => 'The total price field must be more than 1.',
            'products.*.note.string' => 'The note field must be string.',
            'products.*.note.max:225' => 'The note field is too long.',
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
                title: 'Anda ingin menyimpan data pengeluaran?',
                showCancelButton: true,
                confirmButtonText: 'Oke',
                functionName: 'saveExpense'
            );
        }
    }

    public function resetFilter()
    {
        $this->reset('startDate', 'endDate');
    }

    #[On('saveExpense')]
    public function saveExpense()
    {
        $validated = $this->validate();

        try {

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
