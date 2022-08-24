<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Todo as ModelsTodo;
use Livewire\Component;

class Todo extends Component
{
    public $company ;
    public $accordion_show;
    public $todoes;

    public $todoBody;

    public function mount($company)
    {
        $this->company = $company;
    }

    public function render()
    {
        $this->todoes = $this->company->todoes;
        return view('livewire.todo');
    }

    public function storeTodo()
    {
        $this->company->todoes()->create([
            'body' => $this->todoBody,
            'added_by' => auth()->id()
        ]);

        $this->resetForm();

        return redirect() -> route('company.show',$this->company);
    }

    private function resetForm()
    {
        $this->todoBody = "";
    }

}
