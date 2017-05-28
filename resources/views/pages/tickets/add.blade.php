@extends('layouts.default')
@section('page-level-styles')
    {{-- <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" /> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('page-level-nav')
    {{-- @include('includes.subnav-engagement-ticket-details') --}}
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <div class="uk-animation-fade uk-card-default uk-card-small uk-card-body uk-margin">
            <div class="uk-flex uk-flex-middle uk-flex-between">
                <h3 class="uk-margin-remove uk-width-auto">Create New Ticket</h3>
                <a href="{!! url('ticket') !!}" class="uk-button uk-button-primary uk-button-small uk-width-auto black">
                    <i class="fa fa-arrow-left"></i> Back to My Ticket
                </a>
            </div>
            <hr>
            <form class="open-ticket uk-form-horizontal" method="post" action="{!! url('ticket/create') !!}">
                {!! csrf_field() !!}
                <div uk-grid>
                    <div class="uk-width-1-2">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="to_select">Send to</label>
                            <div class="uk-form-controls">
                                <select name="to[]" id="to_select" class="uk-input uk-width-1-1" multiple>
                                @foreach($users as $to)
                                    <option value="{!! $to->id !!}">{!! $to->name !!}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label">Ticket Type</label>
                            <div class="uk-form-controls" style="padding-top:7px;">
                                <ul class="uk-subnav">
                                    @if(count($ticketTypes) > 0)
                                        @foreach($ticketTypes as $ticketType)
                                            <li>
                                                <label>
                                                    <input class="uk-checkbox type" type="checkbox" name="types[]" value="{!! $ticketType->id !!}">
                                                    {!! $ticketType->name !!}
                                                </label>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="message">Message</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-textarea uk-width-1-1" name="message" rows="5" placeholder="What's up?"></textarea>
                            </div>
                        </div>
                        <div class="uk-margin uk-flex uk-flex-right">
                            <a class="uk-modal-close uk-button grey white-text uk-margin-right" href="{!! url('ticket') !!}">CANCEL</a>
                            <input type="submit" class="uk-modal-close uk-button uk-float-right red white-text" value="SEND" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.validate.min.js') !!}"></script>

    <script>
    $(document).ready(function() {
        // $('form').validate();

        $("#to_select").select2();
        $("#to_cc_select").select2();
    });
    </script>
@endsection
