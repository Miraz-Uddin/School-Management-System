<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Deleted Categories <a href="{{ route('category.all') }}" class="btn btn-success" style="float: right;">View
                All Categories</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if (session('restore'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>{{ session('restore') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('destroy'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('destroy') }}</strong>
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
                                <th>Deleted At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($datas as $data)
                                <tr>
                                    <td>{{ $datas->firstItem() + $loop->index }}</td>
                                    <td>{{ $data->category_name }}</td>
                                    <td>{{ $data->deleted_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('category.restore', $data->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-info btn-sm mr-2">Restore</button>
                                            </form>
                                            <form action="{{ route('category.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">P Delete</button>
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
