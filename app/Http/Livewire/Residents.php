<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Resident;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class Residents extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $civilstatus, $firstname, $middlename, $lastname, $suffix, $dob, $placeofbirth, $forUpdate;
    public $searchTerm;
    public $list;


    protected $paginationTheme = 'bootstrap'; // Optional: Set the pagination theme

    public function render()
    {
        $residents = $this->getResidentList(); // Call the getResidentList() method
        $residents = $this->getResidentList()->paginate(2); // Set the number of items per page
    
        return view('livewire.residents', compact('residents'));
    }

    public function delete($id)
    {
        $delete = Resident::where('id', $id)->delete();
        if($delete)
            $this->alert('success','Successfully deleted!');
    }
 
    public function update($id)
    {
        $this->forUpdate = $id;
    
        $resident = Resident::find($id);
    
        $this->firstname = $resident->firstname;
        $this->middlename = $resident->middlename;
        $this->lastname = $resident->lastname;
        $this->suffix = $resident->suffix;
        $this->dob = $resident->dob;
        $this->placeofbirth = $resident->placeofbirth;
        $this->civilstatus = $resident->civilstatus;
    }

    public function saveResident()
    {
        $validatedData = $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'suffix' => '',
            'dob' => 'required',
            'placeofbirth' => 'required',
            'civilstatus' => 'required',
        ]);

        if ($this->forUpdate) {
            $resident = Resident::find($this->forUpdate);
            if (!$resident) {
                $this->alert('success', 'resident Successfully Updated');
                return;
            }
        } else {
            $resident = new Resident;
            $resident->ResidentNo = strtoupper(uniqid());
        }

        $resident->firstname = $this->firstname;
        $resident->lastname = $this->lastname;
        $resident->middlename = $this->middlename;
        $resident->suffix = $this->suffix;
        $resident->dob = $this->dob;
        $resident->placeofbirth = $this->placeofbirth;
        $resident->civilstatus = $this->civilstatus;

        $resident->save();

        if ($this->forUpdate) {
            $this->alert('success', 'resident Successfully Updated');
        } else {
            $this->alert('success', $this->firstname.' '.$this->lastname.' has been added', ['toast' => false, 'position' => 'center']);
        }

        $this->reset(['firstname', 'middlename', 'lastname', 'suffix', 'dob', 'placeofbirth', 'civilstatus']);

        $this->list = resident::orderBy('id', 'DESC')->get();
    }
    public function getResidentList()
    {
        $query = Resident::query();

        if ($this->searchTerm) {
            $query->where(function ($q) {
                $q->where('firstname', 'LIKE', '%' . $this->searchTerm . '%')
                    ->orWhere('lastname', 'LIKE', '%' . $this->searchTerm . '%');
            });
        }

        return $query->orderBy('id', 'DESC');
    }

      

}



