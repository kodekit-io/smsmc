@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
@endsection
@section('page-level-nav')
    {{-- @include('includes.subnav-engagement-ticket-details') --}}
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <div class="uk-animation-fade uk-card-default uk-card-small uk-card-body uk-margin">
            <div class="uk-flex uk-flex-middle uk-flex-between">
                <h3 class="uk-margin-remove uk-width-auto">Ticket #{!! $ticket->ticketId !!}</h3>
                <div class="uk-width-expand uk-margin-left">Status: <span class="uk-label sm-label sm-label-{!! strtolower($ticket->status) !!}">{!! $ticket->status !!}</span></div>
                <a href="{!! url('ticket') !!}" class="uk-button uk-button-primary uk-button-small uk-width-auto black">
                    <i class="fa fa-arrow-left"></i> Back to My Ticket
                </a>
            </div>
            <hr>
            <div class="uk-grid-medium" uk-grid>
                <div class="uk-width-1-3">
                    <h5 class="uk-text-uppercase">Ticket Details</h5>
                    <table class="uk-width-1-1 sm-table">
                        <tr>
                            <td width="30%" class="sm-text-bold">Create Date</td>
                            <td>{{ Carbon\Carbon::parse($ticket->date)->toDayDateTimeString() }}</td>
                        </tr>
                        <tr>
                            <td class="sm-text-bold">From</td>
                            <td>{!! $ticket->fromName !!} ({!! $ticket->fromGroup !!})</td>
                        </tr>
                        <tr>
                            <td class="sm-text-bold">To</td>
                            <td>{!! $ticket->sendName !!} ({!! $ticket->sendGroup !!})</td>
                        </tr>
                        <tr>
                            <td class="sm-text-bold">Type</td>
                            <td>{!! $ticket->type !!}</td>
                        </tr>
                        <tr>
                            <td class="sm-text-bold">Message</td>
                            <td>{!! $ticket->content !!}</td>
                        </tr>
                    </table>
                </div>
                @if(count((array)$ticket->post) > 0)
                <div class="uk-width-2-3">
                    <h5 class="uk-text-uppercase">Related Post</h5>
                    <div class="uk-flex uk-flex-top uk-grid-collapse" uk-grid>
                        <div class="uk-width-2-5">
                            <table class="uk-width-1-1">
                                <tr>
                                    <td width="25%" class="sm-text-bold">Channel</td>
                                    <td><span class="media-{!! $ticket->media !!}"></span></td>
                                </tr>
                                <tr>
                                    <td class="sm-text-bold">Author</td>
                                    <td>{!! $ticket->post->author !!}</td>
                                </tr>
                                <tr>
                                    <td class="sm-text-bold">Post Date</td>
                                    <td>{!! Carbon\Carbon::parse($ticket->post->date)->toDayDateTimeString() !!}</td>
                                </tr>
                                <tr>
                                    <td class="sm-text-bold">Sentiment</td>
                                    <td>{!! $ticket->post->sentiment !!}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="uk-width-3-5">
                            <div class="uk-margin-small-bottom">{!! $ticket->post->post !!}</div>
                            <div class="uk-flex uk-flex-middle">
                                <a href="{!! $ticket->post->url !!}" class="uk-button uk-button-text uk-margin-right" target="_blank">
                                    <i class="fa fa-link"></i> See original post
                                </a>
                                <a href="{!! url('/engagement/add') !!}" class="uk-button uk-button-text">
                                    <i class="fa fa-share"></i> Post Engagement
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if(count($threads) > 0)
                <div class="uk-width-1-1">
                    <h5 class="uk-text-uppercase">Ticket Thread</h5>
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
                </div>
                @endif
                @if($ticket->status != 'close')
                <div class="uk-width-1-1">
                    <h5 class="uk-text-uppercase">Reply Ticket</h5>
                    <form action="{!! url('ticket/' . $ticketId . '/reply') !!}" method="post">
                        {!! csrf_field() !!}
                        <fieldset class="uk-fieldset">
                            <div class="uk-margin">
                                <textarea class="uk-textarea uk-height-small" id="post" rows="4" placeholder="What's up?" name="reply_content"></textarea>
                            </div>
                            <div class="uk-flex uk-flex-right">
                                <button id="postnow" class="uk-button uk-button-secondary red sm-text-bold" type="submit">Post Reply</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
                @endif

            </div>
        </div>
        <div class="uk-card uk-text-center">
            <form action="{!! url('ticket/' . $ticketId .'/change-status') !!}" method="post">
                {!! csrf_field() !!}
                @if($ticket->status == 'close')
                    <input type="hidden" name="ticket_status" value="2">
                    <button class="uk-button uk-button-secondary teal" type="submit">RE-OPEN THIS TICKET</button>
                @else
                    <input type="hidden" name="ticket_status" value="3">
                    <button class="uk-button uk-button-secondary" type="submit">CLOSE THIS TICKET</button>
                @endif
            </form>
        </div>
    </section>

<?php /*

        <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small uk-margin">
            <div class="uk-card-header uk-clearfix sm-card-toolbar">
                <h5 class="uk-card-title uk-float-left">Ticket #{!! $ticket->ticketId !!}</h5>
                <ul class="uk-subnav uk-float-right uk-margin-remove">
                    {{-- <li><span>Updates: <span class="uk-label sm-label uk-label-success">{{ Carbon\Carbon::parse($ticket->date)->toDayDateTimeString() }}</span></span></li> --}}
                    <li><span>Status: <span class="uk-label sm-label uk-label-danger">{!! $ticket->status !!}</span></span></li>
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
        @if($ticket->status != 'close')
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

        </div>
        @endif
        {{--end of threads--}}

        <form action="{!! url('ticket/' . $ticketId .'/change-status') !!}" method="post">
            {!! csrf_field() !!}
            <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small uk-card-body">
                <h5 class="uk-card-title uk-inline uk-margin-small-right">Change Ticket Status</h5>
                <div class="uk-inline">
                    <select name="ticket_status" class="uk-select">
                        @if($ticket->status == 'close')
                            <option value="1">Open Ticket</option>
                        @else
                            <option value="3">Close Ticket</option>
                        @endif
                        {{--<option value="">Change to Responded</option>--}}
                        {{--<option value="">Change to Waiting</option>--}}
                    </select>
                </div>
                <button class="uk-button uk-button-danger black uk-float-right" type="submit">SAVE</button>
            </div>
        </form>
*/ ?>

@endsection

@section('page-level-scripts')
    {{--<script src="{!! asset('assets/js/pages/ticket-details.js') !!}"></script>--}}

@endsection
