<!-- The timeline -->
@if(!empty($timeline))
    <div class="timeline timeline-inverse">
    @foreach($timeline as $date => $actions)
        <!-- timeline time label -->
            <div class="time-label">
            <span class="bg-info">
                {{ date('d M. Y', strtotime($date)) }}
            </span>
            </div>
            <!-- /.timeline-label -->
        @foreach($actions as $action)
            <!-- timeline item -->
                <div>
                    <i class="fas fa-user bg-primary"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($action->created_at)->format('h:i a')  }}</span>
                        <h3 class="timeline-header">
                            <a href="{{ route('admin.users.show', $action->user->id) }}">
                                {{ $action->user->name }}</a> {{ ucwords($action->event) }} this
                            permission
                        </h3>

                        <div class="timeline-body">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <td>
                                        Event
                                    </td>
                                    <td>
                                        {{ ucwords($action->event) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        IP Address
                                    </td>
                                    <td>
                                        {{ $action->ip_address }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        User Agent
                                    </td>
                                    <td>
                                        {{ $action->user_agent }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Old Value
                                    </td>
                                    <td>
                                        @dump($action->old_values)
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        New Value
                                    </td>
                                    <td>
                                        @dump($action->new_values)
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Entry DateTime
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($action->created_at)->format(config('app.datetime')) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Update DateTime
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($action->updated_at)->format(config('app.datetime')) }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </div>
                </div>
                <!-- END timeline item -->
            @endforeach
        @endforeach
        <div>
            <i class="far fa-clock bg-gray"></i>
        </div>
    </div>
@else
    <h1 class="text-center">No Event Record</h1>
@endif
