<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
            <a href="{{ route('category.trashed') }}" class="btn btn-dark"
                style="float: right;margin-left: 15px">Trashed Categories</a>
            <a href="{{ route('category.create') }}" class="btn btn-success" style="float: right;">Add Category</a>

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if (session('update'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>{{ session('update') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('delete') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Created At</th>
                                <th>Added By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($datas as $data)
                                <tr>
                                    <td>{{ $datas->firstItem() + $loop->index }}</td>
                                    <td>{{ $data->category_name }}</td>
                                    <td>{{ $data->created_at->diffforHUmans() }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>
                                        <div class="btn-group" aria-label="Basic example">
                                            <form action="{{ route('category.edit', $data->id) }}" method="GET">
                                                @csrf
                                                <button type="submit" class="btn btn-info btn-sm mr-2">Edit</button>
                                            </form>
                                            <form action="{{ route('category.delete', $data->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No Categories Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $datas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
