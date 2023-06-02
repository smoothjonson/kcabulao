<div>
<div class="card-body">
    <h5>Add New Residents</h5>
    <form wire:submit.prevent="saveResident">
        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-label">First Name</div>
                                    <input type="" wire:model="firstname" class="form-control">
                                    @error('firstname')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="form-label">Middle Name</div>
                                    <input type="" wire:model="middlename" class="form-control">
                                    @error('middlename')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-label">Last Name</div>
                                    <input type="" wire:model="lastname" class="form-control">
                                    @error('lastname')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="form-label">Suffix</div>
                                    <input type="" wire:model="suffix" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-label">Date of Birth</div>
                                    <input type="date" wire:model="dob" class="form-control">
                                    @error('dob')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-label">Civil Status</div>
                                    <select wire:model="civilstatus" class="form-control">
                                        <option value="">--Select Status--</option> 
                                        <option value="Single">Single</option> 
                                        <option value="Married">Married</option> 
                                        <option value="Separated">Separated</option> 
                                        <option value="Widow">Widow</option> 
                                    </select>
                                    @error('civilstatus')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-label">Place of Birth</div>
                                    <input type="" wire:model="placeofbirth" class="form-control">
                                    @error('placeofbirth')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                @if($forUpdate)
                                <button class="btn btn-primary form-group mt-2">Update</button>
                                @else
                                <button class="btn btn-primary form-group mt-2">Save</button>
                                @endif
                             </div>
                        </div>
                    </form>
    </div>
 
                <hr>
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-table me-1"></i>
                                Residents List
                            </div>
                            <div>
                                <input type="text" wire:model="searchTerm" placeholder="Search..." class="form-control">
                            </div>
                        </div>
                    </div>
                <table class="table">
                    <thead>
                        <th>QRcode</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Suffix</th>
                        <th>Date of Birth</th>
                        <th>Place of Birth</th>
                        <th>Civil Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        
                            @foreach($residents as $resident)
                                <tr>
                                <td>{!! QrCode::size(40)->generate($resident->firstname . ' ' . $resident->middlename . ' ' . $resident->lastname )!!}</td>
                                    <td>{{ $resident->firstname }}</td>
                                    <td>{{ $resident->firstname }}</td>
                                    <td>{{ $resident->middlename }}</td>
                                    <td>{{ $resident->lastname }}</td>
                                    <td>{{ $resident->suffix }}</td>
                                    <td>{{ $resident->dob }}</td>
                                    <td>{{ $resident->placeofbirth }}</td>
                                    <td>{{ $resident->civilstatus }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm"
                                        wire:click="update('{{ $resident->id }}')">
                                        Edit</button>

                                        <button class="btn btn-danger btn-sm"
                                        wire:click="delete('{{ $resident->id }}')">
                                        Remove</button>
                                    </td>
                                </tr>
                            @endforeach
                        
                    </tbody>
    </table>
    {{ $residents->links() }}
    </hr>
</div>