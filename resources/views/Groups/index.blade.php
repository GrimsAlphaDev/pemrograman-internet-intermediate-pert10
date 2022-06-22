@extends('layouts.app')

@section('title', 'Groups')

@section('content')
    <a href="/groups/create" class="btn btn-primary mb-2">Tambah Group</a>
    @foreach ($groups as $group)
        <div class="card mt-2 mb-2" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><a href="/groups/addmember/{{ $group['id'] }}"
                        class="text-decoration-none">{{ $group['name'] }}</a></h5>
                <p class="card-text">{{ $group['description'] }}</p>

                <hr>
                <a href="/groups/addmember/{{ $group->id }}" class="btn btn-primary mb-2">Tambah Anggota</a>
                <ul class="list-group">
                    @foreach ($group->friends as $friend)
                        <li class="list-group-item d-flex justify-content-between align-items-center ">
                            {{ $friend->nama }}
                            <span >
                              <form action="/groups/deleteaddmember/{{ $friend->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="badge bg-danger " type="submit"
                                    onclick="return confirm(`Apakah Anda Yakin Ingin Menghapus Data {{ $group['nama'] }}`)">X</button>
                            </form>
                            </span>
                        </li>
                    @endforeach
                </ul>
                <hr>

                <a href="/groups/{{ $group['id'] }}/edit" class="card-link btn btn-warning mb-1">Edit Group</a>
                <form action="/groups/{{ $group['id'] }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="card-link btn btn-danger"
                        onclick="return confirm(`Apakah Anda Yakin Ingin Menghapus Data {{ $group['nama'] }}`)">Delete
                        Group</button>
                </form>
            </div>
        </div>
    @endforeach

    <div class="">{{ $groups->links() }}</div>

@endsection
