@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Categories'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">Categories</h6>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Add Category
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form role="form" action="{{ route('categories.store') }}" method="POST">
                                    @csrf
                                        <div class="modal-body">
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="form-group">
                                                    <label for="name" class="text-sm font-weight-bold text-dark">Name</label>
                                                    <input type="text" name="name" id="name" 
                                                        class="form-control" 
                                                        placeholder="Type product name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description" class="text-sm font-weight-bold text-dark">Description</label>
                                                    <textarea name="description" id="description" 
                                                        class="form-control" rows="3" 
                                                        placeholder="Enter product description"></textarea>
                                                </div>                                            
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="width: 15%;">Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="width: 20%;">Description</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td class="ps-4 text-nowrap"><p class="text-xs text-secondary mb-0">{{ $category->id }}</p></td>
                                        <td class="text-nowrap"><p class="text-xs font-weight-bold mb-0">{{ $category->name }}</p></td>
                                        <td class=""><p class="text-xs text-secondary mb-0">{{ $category->description }}</p></td>
                                        <td class="align-middle text-nowrap">
                                            <!-- Edit Button -->
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs mr-2" data-toggle="modal" data-target="#editCategoryModal-{{ $category->id }}">
                                                Edit
                                            </a>
                                            <!-- Delete Button -->
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-danger border-0 bg-transparent font-weight-bold text-xs"
                                                    onclick="return confirm('Are you sure you want to delete this category?');">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>                                        
                                    </tr>
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editCategoryModal-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form role="form" action="{{ route('categories.update', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name-{{ $category->id }}" class="text-sm font-weight-bold text-dark">Name</label>
                                                            <input type="text" name="name" id="name-{{ $category->id }}" class="form-control" value="{{ $category->name }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description-{{ $category->id }}" class="text-sm font-weight-bold text-dark">Description</label>
                                                            <textarea name="description" id="description-{{ $category->id }}" class="form-control" rows="3">{{ $category->description }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </form>
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
        @include('layouts.footers.auth.footer')
    </div>
@endsection
