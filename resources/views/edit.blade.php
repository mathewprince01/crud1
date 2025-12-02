@extends('layout.app')
@section('title', 'Editform')
@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('emp.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 form-control">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name"value="{{ old('name',$employee->name) }}">
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 form-control">
                            <label for="name">Email</label>
                            <input type="email" id="name" name="email" value="{{ old('email',$employee->email) }}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-control">
                            <label for="profile_image">profile Image</label>
                            <input type="file" id="profile_image" name="profile_image"
                                value="{{ old('profile_image',$employee->profile_image) }}">
                            @error('profile_image')
                                <div class="alert aler-danger">

                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 form-control">
                            <label for="phonenumber">Phone Number</label>
                            <input type="numbeer" id="phonenumber" name="phonenumber" value="{{ old('phonenumber',$employee->phonenumber) }}">
                            @error('phonenumber')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 form-control">
                            <label for="dateofjoin">Date Of Join</label>
                            <input type="date" id="dateofjoin" name="dateofjoin" value="{{ old('dateofjoin',$employee->dateofjoin) }}">
                            @error('dateofjoin')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @php
                            $departments = ['Hr', 'IT', 'Sales', 'Support'];
                        @endphp
                        <div class="mb-3 form-control">
                            <label for="department">Department</label>
                            <select name="department" id="department">
                                <option value="">--select---</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department }}" @selected(old('department',$employee->department) == $department)>{{ $department }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @php
                            $selectedSkills=explode(',',$employee->skills);
                            $skills = ['Laravel', 'sql', 'react', 'VueJs'];
                        @endphp

                        <div class="mb-3 form-control">
                            <div>
                                <label for="skills">Skill</label>
                            </div>
                           @foreach ($skills as $i=>$skill)
                            <input type="checkbox" name="skills[]" id="skill{{$i}}" value="{{$skill}}" @checked(in_array($skill,old('skills',$selectedSkills)))>
                            <label for="skill{{$i}}">{{$skill}}</label>
                        @endforeach
                            @error('skills')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-control">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address"value="{{ old('address',$employee->address) }}">
                        </div>
                        <div>
                            <label for="country">Country</label>
                            <select name="country" id="country">
                                <option value="">--select--country</option>
                                {{-- @foreach ($countries as $country) --}}
                                @foreach ($countries as $id => $name)
                                    <option value="{{ $id }}" @selected(old('country',$employee->country) == $id)>{{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3" class="form-control">
                            <label for="city">City</label>
                            <select name="city" id="city">
                                <option value="">--select city--</option>
                            </select>

                        </div>
                        @php
                            $oldDates = old('exp',$employee->experiences);
                        @endphp

                        <div class="mb-2">
                            <div class="rowGroup border p-2 bg-light">
                                <div class="cardHead">
                                    <h3>Experience</h3>
                                </div>

                                @if (count($oldDates) > 0)
                                    @foreach ($oldDates as $i => $oldData)
                                        <div class="rowItem border d-flex gap-2 p-2">
                                              <input type="hidden"
                                                            name="exp[{{ $i }}][id]"
                                                            value="{{ $oldData['id'] ?? '' }}">
                                            <div class=" col-2">
                                                <label for="companyname{{ $i }}">Company Name</label>
                                                <input type="text"
                                                    name="exp[{{ $i }}][companyname]"id="companyname{{ $i }}"
                                                    value="{{ $oldData['companyname'] }}" class="form-control">
                                                @error("exp.$i.companyname")
                                                    <div class="alert alert-danger">{{ $message }} </div>
                                                @enderror

                                            </div>
                                            <div class=" col-2">
                                                <label for="designation{{ $i }}">Designation</label>
                                                <input type="text"
                                                    name="exp[{{ $i }}][designation]"id="designation{{ $i }}"
                                                    value="{{ $oldData['designation'] }}" class="form-control">
                                                @error("exp.$i.designation")
                                                    <div class="alert alert-danger">{{ $message }} </div>
                                                @enderror

                                            </div>
                                            <div class=" col-2">
                                                <label for="duration{{ $i }}">Duration</label>
                                                <input type="text"
                                                    name="exp[{{ $i }}][duration]"id="duration{{ $i }}"
                                                    value="{{ $oldData['duration'] }}" class="form-control">
                                                @error("exp.$i.duration")
                                                    <div class="alert alert-danger">{{ $message }} </div>
                                                @enderror

                                            </div>
                                            <div class="col-1 mt-3 text-center">
                                                <a class="btn btn-danger removeRow">-</a>

                                            </div>
                                        </div>
                            </div>
                            @endforeach
                        @else
                            <div class="rowItem border d-flex gap-2 p-2">
                                <div class=" col-4">
                                    <label for="companyname0">Company Name</label>
                                    <input type="text" name="exp[0][companyname]"id="companyname0"
                                        value="{{ old('exp.0.companyname') }}" class="form-control">
                                    @error('exp.0.companyname')
                                        <div class="alert alert-danger">{{ $message }} </div>
                                    @enderror

                                </div>
                                <div class=" col-4">
                                    <label for="designation0">Designation</label>
                                    <input type="text" name="exp[0][designation]"id="designation0"
                                        value="{{ old('exp.0.designation') }}" class="form-control">
                                    @error('exp.0.designation')
                                        <div class="alert alert-danger">{{ $message }} </div>
                                    @enderror

                                </div>
                                <div class=" col-4">
                                    <label for="duration0">Duration</label>
                                    <input type="text" name="exp[0][duration]"id="duration0"
                                        value="{{ old('exp.0.duration') }}" class="form-control">
                                    @error('exp.0.duration')
                                        <div class="alert alert-danger">{{ $message }} </div>
                                    @enderror

                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <a class="btn btn-success addRow">+</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                'header': {
                    'X-CSRF-TOken': $('meta[name="csrf-token"]').val(),
                }
            })

            $(document).on('click', '.addRow', function() {
                let maxRow = 4;
                let rowCount = $('.rowItem').length;
                if (rowCount < maxRow) {
                    let html = `
                <div class="rowItem border d-flex gap-2 p-2">
                  <div class="col-4">
                    <label for="companyname${rowCount}">Company Name</label>
                    <input type="text" name="exp[${rowCount}][companyname]" id="companyname${rowCount}"class="form-control">
                    @error('exp[${rowCount}][companyname]')
                     <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                     </div>
                     <div class="col-4">
                        <label for="designation${rowCount}">Designation</label>
                         <input type="text" name="exp[${rowCount}][designation]" id="designation${rowCount}" class="form-control">
                           @error('exp[${rowCount}][designation]')
                           <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                         </div>
                        <div class="col-3">
                          <label for="duration${rowCount}">Duration</label>
                          <input type="text" name="exp[${rowCount}][duration]" id="duration${rowCount}" class="form-control">
                             @error('exp[${rowCount}][duration]')
                              <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          <div class="col-1 mt-3 text-center">
                          <a class="btn btn-danger removeRow">-</a>
                       </div>
                <div>
                `
                    $(".rowGroup").append(html);
                }
            })
            $(document).on('change', '#country', function() {
                let city = "{{ old('city') }}";
                let id = $(this).val();
                $.ajax({
                    url: "{{ route('getCountryCities') }}",
                    method: 'GET',
                    data: {
                        id: id,
                        city: city
                    },
                    success: function(result) {
                        $('#city').html(result);
                    }
                });
            });
            let country = $('#country').val();
            if (country) {
                $('#country').trigger('change')
            }
        })
    </script>
@endpush
