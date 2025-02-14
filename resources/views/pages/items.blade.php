@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Items'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">Items</h6>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Add Items
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form role="form" action="{{ route('items.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name" class="text-sm font-weight-bold text-dark">Name</label>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Item Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="category_id" class="text-sm font-weight-bold text-dark">Category</label>
                                                <select name="category_id" id="category_id" class="form-control" required>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="serial_number" class="text-sm font-weight-bold text-dark">Serial Number</label>
                                                <input type="text" name="serial_number" id="serial_number" class="form-control" placeholder="Serial Number" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="status" class="text-sm font-weight-bold text-dark">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="Available">Available</option>
                                                    <option value="In Use">In Use</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Lost">Lost</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="location_id" class="text-sm font-weight-bold text-dark">Location</label>
                                                <select name="location_id" id="location_id" class="form-control" required>
                                                    @foreach ($locations as $location)
                                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>                                                                                    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Serial Number</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">QR Code</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                    <tr>
                                        <td class="ps-4 text-nowrap"><p class="text-xs text-secondary mb-0">{{ $item->id }}</p></td>
                                        <td class="text-nowrap"><p class="text-xs font-weight-bold mb-0">{{ $item->name }}</p></td>
                                        <td class="text-nowrap"><p class="text-xs text-secondary mb-0">{{ $item->category->name }}</p></td>
                                        <td class="text-nowrap"><p class="text-xs text-secondary mb-0">{{ $item->serial_number }}</p></td>
                                        <td class="text-nowrap">
                                            <p class="text-xs text-secondary mb-0">
                                                <a href="{{ route('items.show', ['serial_number' => $item->serial_number]) }}">
                                                    <img src="{{ asset('storage/' . $item->qr_code) }}" alt="QR Code" width="100" height="100">
                                                </a>                                                
                                            </p>
                                        </td>                                                                              
                                        <td class="text-nowrap"><p class="text-xs text-secondary mb-0">{{ $item->status }}</p></td>
                                        <td class="text-nowrap"><p class="text-xs text-secondary mb-0">{{ $item->location->name }}</p></td>
                                        <td class="align-middle text-nowrap">
                                            <!-- Edit Button -->
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs mr-2" data-toggle="modal" data-target="#editItemModal-{{ $item->id }}">
                                                Edit
                                            </a>
                                            <!-- Delete Button -->
                                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-danger border-0 bg-transparent font-weight-bold text-xs"
                                                    onclick="return confirm('Are you sure you want to delete this item?');">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>                                        
                                    </tr>
                                    <!-- Edit Item Modal -->
                                    <div class="modal fade" id="editItemModal-{{ $item->id }}" tabindex="-1" aria-labelledby="editItemModalLabel-{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editItemModalLabel-{{ $item->id }}">Edit Item</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('items.update', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        <!-- Name -->
                                                        <div class="form-group">
                                                            <label for="name-{{ $item->id }}">Name</label>
                                                            <input type="text" class="form-control" id="name-{{ $item->id }}" name="name" value="{{ $item->name }}" required>
                                                        </div>

                                                        <!-- Category -->
                                                        <div class="form-group">
                                                            <label for="category_id-{{ $item->id }}">Category</label>
                                                            <select class="form-control" id="category_id-{{ $item->id }}" name="category_id" required>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                                                        {{ $category->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Serial Number -->
                                                        <div class="form-group">
                                                            <label for="serial_number-{{ $item->id }}">Serial Number</label>
                                                            <input type="text" class="form-control" id="serial_number-{{ $item->id }}" name="serial_number" value="{{ $item->serial_number }}" required>
                                                        </div>

                                                        <!-- Status -->
                                                        <div class="form-group">
                                                            <label for="status-{{ $item->id }}">Status</label>
                                                            <select class="form-control" id="status-{{ $item->id }}" name="status" required>
                                                                <option value="Available" {{ $item->status == 'Available' ? 'selected' : '' }}>Available</option>
                                                                <option value="In Use" {{ $item->status == 'In Use' ? 'selected' : '' }}>In Use</option>
                                                                <option value="Maintenance" {{ $item->status == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                                                <option value="Lost" {{ $item->status == 'Lost' ? 'selected' : '' }}>Lost</option>
                                                            </select>
                                                        </div>

                                                        <!-- Location -->
                                                        <div class="form-group">
                                                            <label for="location_id-{{ $item->id }}">Location</label>
                                                            <select class="form-control" id="location_id-{{ $item->id }}" name="location_id" required>
                                                                @foreach ($locations as $location)
                                                                    <option value="{{ $location->id }}" {{ $item->location_id == $location->id ? 'selected' : '' }}>
                                                                        {{ $location->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>                    
                </div>                
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
</div>
@endsection