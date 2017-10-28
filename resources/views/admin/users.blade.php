@extends('admin.master')

@section('content')

	<div class="row">
	    <div class="col-lg-12">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table id="dataTable" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Points</th>
                                <th>Registered</th>
                                <th>Last active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)

                            <tr>
                                <td @if($user->banned_until)
                                		class="text-danger"
                                	@endif
                                >
                                	{{ $user->name }}
                                </td>
                                <td>{{ $user->points }}</td>
                                <td>
                                	{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                                </td>
                                <td>
                                	<a href="https://laracasts.com/discuss/channels/laravel/update-users-last-activity/replies/189841">
                                		Coming Soon
                                	</a>
                                	<a href="https://laravel.io/forum/03-03-2014-sentry-3-users-online"> Alt</a>
                                </td>
                                <td>
                                	<a class="text-danger" title="Ban user {{ $user->name }}"
                                		href="users/ban/{{ $user->id }}">
                                		<i class="fa fa-ban" aria-hidden="true"></i>
                                	</a>&nbsp;
                                	<a class="text-success" title="Unban user {{ $user->name }}"
                                		href="users/unban/{{ $user->id }}">
                                		<i class="fa fa-check" aria-hidden="true"></i>
                                	</a>
                                </td>
                            </tr>

						@endforeach

                        </tbody>
                    </table>
                </div>
            </div>
	    </div>
	</div>

@endsection