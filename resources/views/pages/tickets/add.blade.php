@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('page-level-nav')
    @include('includes.subnav-engagement-ticket-details')
@endsection
@section('content')

    <section class="sm-main uk-container uk-container-expand">
        <div class="uk-card uk-card-hover uk-card-default uk-card-small">
            <div class="uk-card-header">
                <h5 class="uk-card-title">Create New Ticket</h5>
            </div>
            <div class="uk-card-body">
                <form class="open-ticket uk-form-horizontal" method="post" action="{!! url('ticket/create') !!}">
                    {!! csrf_field() !!}
                    <div uk-grid>
                        <div class="uk-width-1-2">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="to_select">Send to</label>
                                <div class="uk-form-controls">
                                    <select name="to[]" id="to_select" class="uk-input uk-width-1-1" multiple>
                                    @foreach($users as $to)
                                        <option value="{!! $to->idLogin !!}">{!! $to->name !!}</option>
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
                                                    {!! strtoupper($ticketType->name) !!}
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
