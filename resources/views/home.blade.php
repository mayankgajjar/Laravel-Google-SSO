@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" style="text-align: center;font-size: 16px;"><strong>User
                                                    information</strong></td>
                                        </tr>
                                        @if (!empty($response_array->user->id))
                                            <tr>
                                                <th scope="row">ID</th>
                                                <td><?= $response_array->user->id ?></td>
                                            </tr>
                                        @endif
                                        @if (!empty($response_array->user->first_name))
                                            <tr>
                                                <th scope="row">First Name</th>
                                                <td><?= $response_array->user->first_name ?></td>
                                            </tr>
                                        @endif
                                        @if (!empty($response_array->user->last_name))
                                            <tr>
                                                <th scope="row">Last Name</th>
                                                <td><?= $response_array->user->last_name ?></td>
                                            </tr>
                                        @endif
                                        @if (!empty($response_array->user->email))
                                            <tr>
                                                <th scope="row">Email</th>
                                                <td><?= $response_array->user->email ?></td>
                                            </tr>
                                        @endif
                                        @if (!empty($response_array->user->status))
                                            <tr>
                                                <th scope="row">Status</th>
                                                <td><?= $response_array->user->status ?></td>
                                            </tr>
                                        @endif
                                        @if (!empty($response_array->user->created_at))
                                            <tr>
                                                <th scope="row">Created At</th>
                                                <td><?= $response_array->user->created_at ?></td>
                                            </tr>
                                        @endif
                                        @if (!empty($response_array->user->updated_at))
                                            <tr>
                                                <th scope="row">Updated At</th>
                                                <td><?= $response_array->user->updated_at ?></td>
                                            </tr>
                                        @endif
                                        @if (!empty($response_array->user->profile))
                                            <tr>
                                                <th scope="row">Profile</th>
                                                <td><img src="{{ $response_array->user->profile }}" style="height: 60px;" />
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" style="text-align: center;font-size: 16px;"><strong>Weather
                                                    information</strong></td>
                                        </tr>
                                        @if (!empty($response_array->main->city))
                                            <tr>
                                                <th scope="row">City</th>
                                                <td><?= $response_array->main->city ?></td>
                                            </tr>
                                        @endif
                                        @if (!empty($response_array->main->temp))
                                            <tr>
                                                <th scope="row">Temperature</th>
                                                <td><?= $response_array->main->temp ?></td>
                                            </tr>
                                        @endif
                                        @if (!empty($response_array->main->temp_min))
                                            <tr>
                                                <th scope="row">Minimum Temperature</th>
                                                <td><?= $response_array->main->temp_min ?></td>
                                            </tr>
                                        @endif
                                        @if (!empty($response_array->main->temp_max))
                                            <tr>
                                                <th scope="row">Maximum Temperature</th>
                                                <td><?= $response_array->main->temp_max ?></td>
                                            </tr>
                                        @endif
                                        @if (!empty($response_array->main->pressure))
                                            <tr>
                                                <th scope="row">Pressure</th>
                                                <td><?= $response_array->main->pressure ?></td>
                                            </tr>
                                        @endif
                                        @if (!empty($response_array->main->humidity))
                                            <tr>
                                                <th scope="row">Humidity</th>
                                                <td><?= $response_array->main->humidity ?></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
