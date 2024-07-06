<?php

namespace App\Livewire;

use App\Exports\PresenceExport;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Presence extends Component
{
    use WithPagination;

    public \App\Models\Presence $presenceModel;

    #[Validate('required|string')]
    public string $shift;

    #[Validate('required|string')]
    public string $session;

    public $employees = [];

    #[Validate('required|date')]
    public $date;

    #[Validate('nullable|date')]
    public $startDate = null;

    #[Validate('nullable|date')]
    public $endDate = null;

    public bool $edit = false;

    protected $rules = [
        'employees.*.name' => 'required|string|max:50',
        'employees.*.status' => 'required|string',
        'employees.*.status_note' => 'nullable|string|max:100',
    ];

    public function messages()
    {
        return [
            'employees.*.name.required' => 'The name field is required.',
            'employees.*.name.string' => 'The name field must be string.',
            'employees.*.name.max:50' => 'The name field is too long.',
            'employees.*.status.required' => 'The status field is required.',
            'employees.*.status.string' => 'The status field must be string.',
            'employees.*.status_note.string' => 'The status note field must be string.',
            'employees.*.status_note.max:100' => 'The status note field is too long.',
        ];
    }

    public function mount()
    {
        $this->employees = [
            [
                'name' => '',
                'status' => '',
                'status_note' => '',
            ],
            [
                'name' => '',
                'status' => '',
                'status_note' => '',
            ],
            [
                'name' => '',
                'status' => '',
                'status_note' => '',
            ]
        ];
    }

    public function saveModalPresence()
    {
        $this->validate();

        $this->dispatch('swal-dialog',
            title:  $this->edit ? 'Anda ingin mengubah data kehadiran?' : 'Anda ingin menyimpan data kehadiran?',
            showCancelButton: true,
            confirmButtonText: $this->edit ? 'Ubah' : 'Simpan',
            functionName: 'savePresence'
        );
    }

    #[On('savePresence')]
    public function savePresence()
    {
        $validated = $this->validate();

        try {

            if($this->edit){
                foreach ($this->employees as $employee){
                    $this->presenceModel->update([
                        'shift' => $validated['shift'],
                        'session' => $validated['session'],
                        'name' => $employee['name'],
                        'status' => $employee['status'],
                        'status_note' => $employee['status'] == 'Izin' || $employee['status'] == 'Telat' ? $employee['status_note'] : null,
                        'date' => $validated['date'],
                    ]);
                }

                $this->dispatch('swal',
                    icon: 'success',
                    title: 'Data kehadiran berhasil diubah',
                );
            }else{
                foreach ($this->employees as $employee){
                    \App\Models\Presence::create([
                        'shift' => $validated['shift'],
                        'session' => $validated['session'],
                        'name' => $employee['name'],
                        'status' => $employee['status'],
                        'status_note' => $employee['status_note'] == '' ? null : $employee['status_note'],
                        'date' => $validated['date'],
                    ]);
                }

                $this->dispatch('swal',
                    icon: 'success',
                    title: 'Data kehadiran berhasil disimpan',
                );
            }

            $this->reset();
            $this->redirectRoute('home', navigate: true);

        }catch (\Exception $e){
            $this->dispatch('swal',
                icon: 'error',
                title: $e->getMessage(),
            );
        }
    }

    public function editPresence(\App\Models\Presence $presence)
    {
        if($presence->exists){
            $this->edit = true;
            $this->presenceModel = $presence;

            $this->shift = $presence->shift;
            $this->session = $presence->session;
            $this->date = $presence->date;

            $this->employees = [
                [
                    'name' => $presence->name,
                    'status' => $presence->status,
                    'status_note' => $presence->status_note,
                ],
            ];
        }
    }

    public function exportModalPresence()
    {
        $this->dispatch('swal-dialog',
            title: 'Anda ingin export data kehadiran ke excel?',
            showCancelButton: true,
            confirmButtonText: 'Export',
            functionName: 'exportPresenceToExcel'
        );
    }

    #[On('exportPresenceToExcel')]
    public function exportPresenceToExcel()
    {
        try {
            return Excel::download(new PresenceExport($this->startDate, $this->endDate), 'Kehadiran-' . now()->format('d-m-Y') . '.xlsx');
        }catch (\Exception $e){
            return $this->dispatch('swal',
                icon: 'error',
                title: $e->getMessage(),
            );
        }
    }

    public function resetFilter()
    {
        $this->reset('startDate', 'endDate');
    }

    public function deleteModalPresence(int $id)
    {
        $this->dispatch('swal-dialog',
            title: 'Anda ingin menghapus data kehadiran?',
            showCancelButton: true,
            confirmButtonText: 'Oke',
            functionName: 'deleteExpense',
            id: $id,
        );
    }

    #[On('deleteExpense')]
    public function delete(int $id)
    {
        try {
            $presence = \App\Models\Presence::find($id);
            $presence->delete();

            $this->dispatch('swal',
                icon: 'success',
                title: 'Data kehadiran berhasil dihapus',
            );

        }catch (\Exception $e){
            $this->dispatch('swal',
                icon: 'error',
                title: $e->getMessage(),
            );
        }
    }

    #[Title('Kehadiran')]
    public function render()
    {
        $shifts = ['Siang','Malam'];
        $sessions = ['Kedatangan','Kepulangan'];
        $stats = ['Hadir','Izin','Tanpa Keterangan','Telat'];

        if($this->endDate == null){
            $presences = \App\Models\Presence::orderBy('date', 'desc')->paginate(15);
        }else{
            $presences = \App\Models\Presence::whereBetween('date', [$this->startDate, $this->endDate])->orderBy('date', 'desc')->paginate(15);
        }

        return view('livewire.presence', compact('shifts', 'sessions','stats', 'presences'));
    }
}
