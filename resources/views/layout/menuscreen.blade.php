@extends('app')
@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="flex flex-col  p-24">
            <a href="/pengeluaran" class="text-4xl text-white hover:text-black bg-blue-700 p-7 my-4 rounded-md text-center hover:bg-blue-400 hover:no-underline"> Pengeluaran </a>
            <a href="/kehadiran" class="text-4xl text-white hover:text-black bg-green-600 p-7 my-4 rounded-md text-center hover:bg-green-400 hover:no-underline"> Kehadiran </a>
            <a href="/login" class="text-4xl text-white hover:text-black bg-red-600 p-7 my-4 rounded-md text-center hover:bg-green-400 hover:no-underline"> Log Out</a>
        </div>
    
    </div>
@endsection