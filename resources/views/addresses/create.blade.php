@extends('layouts.main')

@section('title', 'Add Address | ' . config('app.name'))

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
@endsection

@section('content')
    <div class="wrapper user-wrap">
        <div class="user-container">
            @include('layouts.userprofile')
            <div class="width1140">
                @include('layouts.userside')
                <div id="user-main">
                    <form method="POST" action="{{ route('addresses.store') }}">
                        @csrf
                        <div class="user-edit">
                            <h3 class="side_title">
                                Add Address
                                <span class="required"><em class="ico_required">*</em> Required input</span>
                            </h3>
                            <div class="user-table">
                                <table border="0" summary="">
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                <em class="ico_required">*</em>Name
                                            </th>
                                            <td>
                                                <input placeholder="Name" id="name" name="name" class="form-control"
                                                    value="{{ old('name') }}" type="text" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <em class="ico_required">*</em>Phone
                                            </th>
                                            <td>
                                                <input placeholder="Phone Number" id="phone" name="phone"
                                                    class="form-control" value="{{ old('phone') }}"type="text" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <em class="ico_required">*</em>Province
                                            </th>
                                            <td>
                                                <select id="province" name="province" class="select-form form-control">
                                                    <option value="">Select Province</option>
                                                    @foreach ($provinces as $province)
                                                        <option value="{{ $province['province_id'] }}">
                                                            {{ $province['province'] }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <em class="ico_required">*</em>City
                                            </th>
                                            <td>
                                                <select id="city" name="city" class="select-form form-control">
                                                    <option value="">Select City</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <em class="ico_required">*</em>Address
                                            </th>
                                            <td>
                                                <input id="address" name="address" placeholder="Address" value=""
                                                    type="text" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <em class="ico_required">*</em>Postal Code
                                            </th>
                                            <td>
                                                <input id="postal_code" name="postal_code" placeholder="Postal Code"
                                                    value="" type="text" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="clear-both user-buttons">
                                <button type="submit" class="button-confirm btnripple">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#province').change(function() {
            var provinceId = $(this).val();
            var url = "{{ route('cities.by_province', ':provinceId') }}";
            url = url.replace(':provinceId', provinceId);

            $.get(url, function(data) {
                var cityOptions = '<option value="">Select City</option>';

                $.each(data, function(index, city) {
                    cityOptions += '<option value="' + city.city_id + '">' + city
                        .city_name + '</option>';
                });

                $('#city').html(cityOptions);
            });
        });
    });
</script>
