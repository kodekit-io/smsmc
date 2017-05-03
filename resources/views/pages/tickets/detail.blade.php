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
                    <li><span>Updates: <span class="uk-label sm-label uk-label-success">{{ Carbon\Carbon::parse($ticket->date)->toDayDateTimeString() }}</span></span></li>
                    <li><span>Status: <span class="uk-label sm-label uk-label-danger">{!! strtoupper($ticket->type) !!}</span></span></li>
                </ul>
            </div>
            <div class="uk-card-body">
                <div uk-grid>
                    <div class="uk-width-1-2">
                        <h6 class="uk-margin-small-bottom uk-text-uppercase">Ticket Details</h6>
                        <table class="uk-width-1-1">
                            <tbody>
                                <tr>
                                    <td width="25%" class="uk-text-bold">Create Date</td>
                                    <td>{{ Carbon\Carbon::parse($ticket->date)->toDayDateTimeString() }}</td>
                                </tr>
                                <tr>
                                    <td class="uk-text-bold">From</td>
                                    <td>{!! $ticket->fromName !!} ({!! $ticket->fromGroup !!})</td>
                                </tr>
                                <tr>
                                    <td class="uk-text-bold">To</td>
                                    <td>{!! $ticket->sendName !!} ({!! $ticket->sendGroup !!})</td>
                                </tr>
                                {{-- <tr>
                                    <td>CC</td>
                                    <td>-</td>
                                </tr> --}}
                                <tr>
                                    <td class="uk-text-bold">Type</td>
                                    <td>{!! $ticket->type !!}</td>
                                </tr>
                                <tr>
									<td class="uk-text-bold">Message</td>
                                    <td>{!! $ticket->content !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="uk-width-1-2">
                        @if(count((array)$ticket->post) > 0)
                        <h6 class="uk-margin-small-bottom uk-text-uppercase">Related Post</h6>
                        <table class="uk-width-1-1">
                            <tbody>
                                <tr>
                                    <td width="25%" class="uk-text-bold">Channel</td>
                                    <td><span class="media-{!! $ticket->media !!}"></span></td>
                                </tr>
                                <tr>
                                    <td class="uk-text-bold">Author</td>
                                    <td>{!! $ticket->post->author !!}</td>
                                </tr>
                                <tr>
                                    <td class="uk-text-bold">Post Date</td>
                                    <td>{!! Carbon\Carbon::parse($ticket->post->date)->toDayDateTimeString() !!}</td>
                                </tr>
                                <tr>
                                    <td class="uk-text-bold">Sentiment</td>
                                    <td>{!! $ticket->post->sentiment !!}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <p class="uk-text-bold">Post Details</p>
                                        <div class="uk-margin">{!! $ticket->post->post !!}</div>
                                        <div class="uk-flex uk-flex-middle">
                                            <a href="{!! $ticket->post->url !!}" class="uk-button uk-button-small uk-text-capitalize green white-text uk-margin-small-right" target="_blank">See original post</a>
                                            <a href="{!! url('/engagement/reply') !!}" class="uk-button uk-button-small uk-text-capitalize blue white-text">Respond to this post</a>
                                        </div>
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
        <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small uk-card-body uk-margin">
            @if(count($threads) > 0)
                {{-- <h5 class="uk-card-title">Ticket Thread</h5> --}}
                <ul class="sm-thread" uk-accordion="multiple: true">
                    @foreach($threads as $thread)
                    <li class="uk-open">
                        <h6 class="uk-accordion-title">Reply from {!! $thread->sender !!} on {{ Carbon\Carbon::parse($thread->date)->toDayDateTimeString() }}</h6>
                        <div class="uk-accordion-content">
                            <p>{!! $thread->content !!}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            @endif
            <h6 class="uk-margin-small-bottom">Your Reply</h6>
            <form action="{!! url('ticket/' . $ticketId . '/reply') !!}" method="post">
                {!! csrf_field() !!}
                <fieldset class="uk-fieldset">
                    <div class="uk-margin">
                        <textarea class="uk-textarea" id="post" rows="4" placeholder="What's up?" name="reply_content"></textarea>
                    </div>
                    <div class="uk-flex uk-flex-right">
                        <button id="postnow" class="uk-button uk-button-danger red" type="submit">Post Reply</button>
                    </div>
                </fieldset>
            </form>
            {{--
            <ul uk-tab>
                <li class="uk-active"><a href="#">Reply Ticket</a></li>
                <li><a href="#">Social Media Post</a></li>
            </ul>
            <ul class="uk-switcher uk-margin">
                <li>

                </li>
                <li>
                    <form class="uk-form-horizontal" action="{!! url('ticket/' . $ticketId . '/reply') !!}" method="post">
                        {!! csrf_field() !!}
                        <fieldset class="uk-fieldset">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="post-to">Post to</label>
                                <div class="uk-form-controls">
                                    <select class="uk-select uk-width-medium" id="post-to">
                                        <option>Facebook</option>
                                        <option>Twitter</option>
                                        <option>Youtube</option>
                                        <option>Instagram</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="postSocmed">Content</label>
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea" id="postSocmed" rows="4" placeholder="What's up?" name="socmed_content"></textarea>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="img">Image</label>
                                <div class="uk-form-controls">
                                    <input type="file" id="img">
                                </div>
                            </div>
                            <hr>
                            <div class="uk-flex uk-flex-middle uk-flex-between">
                                <div>
                                    <span><i uk-icon="icon: clock"></i> SCHEDULE POST: </span><input id="schedule" class="uk-input uk-form-width-medium uk-margin-small-left" type="date"></input><a id="clear" class="uk-button uk-button-default uk-hidden" uk-icon="icon: close" style="width:40px;padding:0;" title="Clear date" uk-tooltip></a>
                                </div>
                                <button id="postsave" class="uk-button uk-button-primary uk-hidden" type="submit">Save Post</button>
                                <button id="postnowsocmed" class="uk-button uk-button-danger red" type="submit">Post Now</button>
                            </div>
                        </fieldset>
                    </form>
                </li>
            </ul> --}}
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

@endsection
