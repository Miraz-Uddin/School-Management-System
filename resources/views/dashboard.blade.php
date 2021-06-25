<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi.. <b> {{ Auth::user()->name }} </b>
            <b style="float: right;"> Total users
                <span class="badge badge-danger">{{ count($users) }}</span>
            </b>
        </h2>    
    </x-slot>

    <div class="py-12">
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div> --}}
        <div class="container">
            <div class="row">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1; 
                        @endphp
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $user -> name }}</td>
                            <td>{{ $user -> email }}</td>
                            <td>{{ $user -> created_at -> diffForHumans() }}</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
