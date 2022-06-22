@extends('layouts.app')

@section('title', 'Tambah Teman Ke Dalam Grup')

@section('content')
    {{-- @dd($friends) --}}
    <form action="/groups/addmember/{{ $group->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Teman</label>
            <select class="form-select" aria-label="Default select example" name="friend_id">
                <option selected>Pilih Teman Untuk Dimasukan Ke Group</option>
                @foreach ($friends as $friend)
                    <option value="{{ $friend->id }}">{{ $friend->nama }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-info text-white">Tambahkan Ke Group</button>
    </form>

@endsection
