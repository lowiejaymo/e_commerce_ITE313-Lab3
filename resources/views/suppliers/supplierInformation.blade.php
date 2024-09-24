@extends('layouts.app')

@section('content')
@if (session('update_success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: 'Supplier information updated successfully',
            icon: 'success'
        });
    </script>
@endif
<div class="mt-2">
    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back to Supplier List</a>
</div>
<div class="container my-2">
    <div class="card shadow-lg">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><strong>Supplier Information</strong></h3>
            <a href="{{ route('suppliers.edit', $supplier->supplier_id) }}" class="btn btn-dark">Edit</a>
        </div>
        <div class="row g-0">
            <div class="col-md-8">
                <div class="card-body p-5">
                    <h1 class="card-title mb-2"><strong>{{ $supplier->name }}</strong></h1>
                    <div class="mt-1"><strong>ID:</strong> {{ $supplier->supplier_id }}</div>
                    <div class="mt-1"><strong>Contact Number:</strong> {{ $supplier->contact_num }}</div>
                    <div class="mt-1"><strong>Email:</strong> {{ $supplier->email }}</div>
                    <div class="mt-1"><strong>Address:</strong> {{ $supplier->address }}</div>
                    <div class="mt-1"><strong>Created At:</strong> {{ $supplier->created_at->format('F j, Y g:ia') }}</div>
                </div>
            </div>
        </div>
        <div class="card-body text-center">
            <form id="delete-form-{{ $supplier->supplier_id }}" action="{{ route('suppliers.destroy', $supplier->supplier_id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            <button class="btn btn-danger" onclick="confirmDelete('{{ $supplier->name }}', {{ $supplier->supplier_id }})">Delete Supplier</button>
        </div>
    </div>
</div>

<script>
    function confirmDelete(type, supplierID) {
        Swal.fire({
            title: `Are you sure you want to delete "${type}"?`,
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${supplierID}`).submit();
            }
        });
    }
</script>
@endsection
