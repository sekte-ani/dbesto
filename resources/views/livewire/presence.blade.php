<div>
    <div class="m-12 p-6 rounded-md shadow-xl bg-[#fff]">
        <h1 class="text-black text-4xl font-bold flex justify-center p-4 rounded-md">Kehadiran Karyawan</h1>
        <form class="text-black" wire:submit="saveModalPresence">
            <div class="form-group mx-5">
                <table border="0">
                    <tr>
                        <td>
                            <p class="font-bold mt-4 mb-3">Shift</p>
                        </td>
                        <td>
                            <p class="mt-4 mb-3 font-bold">:</p>
                        </td>
                        <td>
                            <Select type="Select" class="btn btn-primary dropdown-toggle w-48 h-10 ml-4 @error('shift') is-invalid @enderror" data-bs-toggle="dropdown" aria-expanded="false" wire:model.blur="shift">
                                Pilih Shift
                                <option value="">Pilih Shift</option>
                                @foreach($shifts as $shift)
                                    <option value="{{$shift}}">{{$shift}}</option>
                                @endforeach
                            </Select>
                            @error('shift')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="font-bold mt-4 mb-3">Sesi</p>
                        </td>
                        <td>
                            <p class="mt-4 mb-3 font-bold">:</p>
                        </td>
                        <td>
                            <Select type="Select" class="btn btn-primary dropdown-toggle w-48 h-10 ml-4 @error('session') is-invalid @enderror" data-bs-toggle="dropdown" aria-expanded="false" wire:model.blur="session">
                                Pilih Sesi
                                <option value="">Pilih Sesi</option>
                                @foreach($sessions as $session)
                                    <option value="{{$session}}">{{$session}}</option>
                                @endforeach
                            </Select>
                            @error('session')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="mt-4 font-bold mb-3">Tanggal</p>
                        </td>
                        <td>
                            <p class="mt-4 mb-3 font-bold">:</p>
                        </td>
                        <td>
                            <input class="px-3 border-1 w-48 h-10 peer ml-4 rounded-md bg-primary text-white @error('date') is-invalid @enderror" type="date" wire:model.blur="date">
                            @error('date')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </td>
                    </tr>
                </table>

{{--                @for($i = 1; $i <= 3; $i++)--}}
{{--                    <div class="form-group mt-3">--}}
{{--                        <label for="karyawan1">Karyawan {{$i}} :</label>--}}
{{--                        <input type="text" class="form-control @error('name_' . $i) is-invalid @enderror" placeholder="Nama Karyawan" wire:model.blur="name_{{$i}}">--}}
{{--                        @error('name_' . $i)--}}
{{--                        <div class="invalid-feedback">--}}
{{--                            {{$message}}--}}
{{--                        </div>--}}
{{--                        @enderror--}}
{{--                        <select class="form-control mt-2 @error('status_' . $i) is-invalid @enderror" wire:model.live="status_{{$i}}">--}}
{{--                            <option value="">Pilih Status Kehadiran</option>--}}
{{--                            @foreach($stats as $stat)--}}
{{--                                <option value="{{$stat}}">{{$stat}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        @error('status_' . $i)--}}
{{--                        <div class="invalid-feedback">--}}
{{--                            {{$message}}--}}
{{--                        </div>--}}
{{--                        @enderror--}}
{{--                        @if(${'status_' . $i} == 'Izin' || ${'status_' . $i} == 'Telat')--}}
{{--                            <input type="text" class="form-control note mt-2 @error('status_note_' . $i) is-invalid @enderror"  placeholder="Keterangan" wire:model.blur="status_note_{{$i}}">--}}
{{--                            @error('status_note_' . $i)--}}
{{--                            {{$message}}--}}
{{--                            @enderror--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                @endfor--}}
                @foreach($employees as $index => $employee)
                    <div class="form-group mt-3">
                        <label for="karyawan{{$index+1}}">Karyawan {{$index+1}} :</label>
                        <input type="text" class="form-control @error('employees.' . $index . '.name') is-invalid @enderror" placeholder="Nama Karyawan" wire:model.blur="employees.{{$index}}.name">
                        @error('employees.' . $index . '.name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                        <select class="form-control mt-2 @error('employees.' . $index . '.status') is-invalid @enderror" wire:model.live="employees.{{$index}}.status">--}}
                            <option value="">Pilih Status Kehadiran</option>
                            @foreach($stats as $stat)
                                <option value="{{$stat}}">{{$stat}}</option>
                            @endforeach
                        </select>
                        @error('employees.' . $index . '.status')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                        @if($employees[$index]['status'] == 'Izin' || $employees[$index]['status'] == 'Telat')
                            <input type="text" class="form-control note mt-2 @error('employees.' . $index . '.status_note') is-invalid @enderror"  placeholder="Keterangan" wire:model.blur="employees.{{$index}}.status_note">
                            @error('employees.' . $index . '.status_note')
                            {{$message}}
                            @enderror
                        @endif
                    </div>
                @endforeach

                <button class="btn btn-primary w-32 " type="submit">Submit</button>

            </div>
        </form>
        <hr class="mt-4 mb-4">
        <div class="row" id="presence-table">
            <div class="col-3">
                <input type="date" class="form-control" wire:model.blur="startDate">
            </div>
            <div class="col-3">
                <input type="date" class="form-control" wire:model.blur="endDate" @if($startDate== null) disabled @endif>
            </div>
            <div class="col-1">
                <button class="btn btn-danger" type="button" @if($endDate == null) disabled @endif wire:click="resetFilter">Reset</button>
            </div>
            <div class="col-4">

            </div>
            <div class="col-1">
                <button class="btn btn-warning w-32 mb-4 float-end" type="button" wire:click="exportModalPresence" @if($presences->isEmpty()) disabled @endif>Export</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light text-center">
                <tr>
                    <th scope="col">Shift</th>
                    <th scope="col">Sesi</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Status</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody class="text-center">
                @forelse($presences as $presence)
                    @php
                        $carbonDate = \Carbon\Carbon::parse($presence->date);
                        $date = $carbonDate->format('d-m-Y');
                    @endphp
                    <tr>
                        <td>{{$presence->shift}}</td>
                        <td>{{$presence->session}}</td>
                        <td>{{$presence->name}}</td>
                        <td>{{$presence->status}}</td>
                        <td>{{$presence->status_note ?? '-'}}</td>
                        <td>{{$date}}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-danger" wire:click.prevent="deleteModalPresence({{$presence->id}})">Hapus</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            Tidak ada data kehadiran
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div>
                {{ $presences->links(data: ['scrollTo' => '#presence-table']) }}
            </div>
        </div>
    </div>
</div>
