@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
@endsection
@section('page-level-nav')
    @include('includes.subnav-engagement-ticket-details')
@endsection
@section('content')

    <section class="sm-main uk-container uk-container-expand">
        <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small uk-margin">
            <div class="uk-card-header uk-clearfix sm-card-toolbar">
                <h5 class="uk-card-title uk-float-left">Ticket #{!! $ticket->ticketId !!}</h5>
                <ul class="uk-subnav uk-float-right uk-margin-remove">
                    <li><span>Updates: <span class="uk-label sm-label uk-label-success">Mon, Jan 2, 2017 8:23 AM</span></span></li>
                    <li><span>Status: <span class="uk-label sm-label uk-label-danger">{!! strtoupper($ticket->type) !!}</span></span></li>
                </ul>
            </div>
            <div class="uk-card-body">
                <div uk-grid>
                    <div class="uk-width-1-2">
                        <table class="uk-table uk-table-small">
                            <thead>
                                    <tr>
                                        <th colspan="2">Ticket Details</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="25%">Create Date</td>
                                    <td>{!! $ticket->date !!}</td>
                                </tr>
                                <tr>
                                    <td>From</td>
                                    <td>{!! $ticket->fromName !!} ({!! $ticket->fromGroup !!})</td>
                                </tr>
                                <tr>
                                    <td>To</td>
                                    <td>{!! $ticket->sendName !!} ({!! $ticket->sendGroup !!})</td>
                                </tr>
                                <tr>
                                    <td>CC</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Type</td>
                                    <td>{!! strtoupper($ticket->type) !!}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <p>Content :</p>
                                        <div>{!! $ticket->content !!}</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="uk-width-1-2">
                        @if(count((array)$ticket->post) > 0)
                        <table class="uk-table uk-table-small">
                            <thead>
                                    <tr>
                                        <th colspan="2">Related Post</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="25%">Channel</td>
                                    <td>{!! $ticket->media !!}</td>
                                </tr>
                                <tr>
                                    <td>Author</td>
                                    <td>{!! $ticket->post->author !!}</td>
                                </tr>
                                <tr>
                                    <td>Post Date</td>
                                    <td>{!! $ticket->post->date !!}</td>
                                </tr>
                                <tr>
                                    <td>Sentiment</td>
                                    <td>{!! $ticket->post->sentiment !!}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <p>Post Details:</p>
                                        <div>{!! $ticket->post->post !!}</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{--Thread--}}

        <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small uk-margin">
            <div class="uk-card-header sm-card-toolbar">
                <h5 class="uk-card-title">Ticket Thread</h5>
            </div>
            <div class="uk-card-body">
                @if(count($threads) > 0)
                <ul class="sm-thread" uk-accordion="multiple: true">
                    @foreach($threads as $thread)
                    <li>
                        <h6 class="uk-accordion-title">Reply from {!! $thread->sender !!} on {!! $thread->date !!}</h6>
                        <div class="uk-accordion-content">
                            <p>{!! $thread->content !!}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @endif
                <h5 class="uk-card-title">New Respond</h5>
                <hr class="uk-margin-small-top">
                <form action="{!! url('ticket/' . $ticketId . '/reply') !!}" method="post">
                    {!! csrf_field() !!}
                    <fieldset class="uk-fieldset">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="post">Your Post</label>
                            <textarea class="uk-textarea" id="post" rows="4" placeholder="What's up?" name="reply_content"></textarea>
                        </div>
                        {{--<div class="uk-margin">--}}
                            {{--<label class="uk-form-label" for="img">Post with Image</label>--}}
                            {{--<input type="file" id="img">--}}
                        {{--</div>--}}
                        <hr>
                        <div class="uk-clearfix">
                            {{--<span><i uk-icon="icon: clock"></i> SCHEDULE POST: </span><input id="schedule" class="uk-input uk-form-width-medium" type="date"></input><a id="clear" class="uk-button uk-button-default uk-hidden" uk-icon="icon: close" style="width:40px;padding:0;" title="Clear date" uk-tooltip></a>--}}

                            {{--<button id="postsave" class="uk-button uk-button-primary uk-hidden uk-float-right" type="submit">Save Post</button>--}}

                            <button id="postnow" class="uk-button uk-button-danger red uk-float-right" type="submit">Post Now</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
        {{--end of threads--}}

        <form action="{!! url('ticket/' . $ticketId .'/change-status') !!}" method="post">
        {!! csrf_field() !!}
        <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small uk-card-body">
            <h5 class="uk-card-title uk-inline uk-margin-small-right">Change Ticket Status</h5>
            <div class="uk-inline">
                <select name="ticket_status" class="uk-select">
                    <option value="3">Close Ticket</option>
                    {{--<option value="">Change to Responded</option>--}}
                    {{--<option value="">Change to Waiting</option>--}}
                </select>
            </div>
            <button class="uk-button uk-button-danger black uk-float-right" type="submit">SAVE</button>
        </div>
        </form>
    </section>

@endsection

@section('page-level-scripts')
    {{--<script src="{!! asset('assets/js/pages/ticket-details.js') !!}"></script>--}}
    <script>
    $(document).ready(function() {
        var dt = new Date();
        $('#schedule').datetimepicker({
            'format': 'd-m-y H:i',
            'minDate': 0,
            'minDateTime': dt,
            'closeOnDateSelect' : true,
            'validateOnBlur' : true,
        });
        $('#schedule').blur(function () {
            if ($(this).val()) {
                $('#postsave').removeClass('uk-hidden');
                $('#postnow').addClass('uk-hidden');
                $('#clear').removeClass('uk-hidden');
            } else {
                $('#postnow').removeClass('uk-hidden');
                $('#postsave').addClass('uk-hidden');
                $('#clear').addClass('uk-hidden');
            }
        });
        $('#clear').click(function(){
            $(this).addClass('uk-hidden');
            $('#schedule').val('');
            $('#postnow').removeClass('uk-hidden');
            $('#postsave').addClass('uk-hidden');
        });
    });
    </script>

@endsection
