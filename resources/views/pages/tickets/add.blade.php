@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('page-level-nav')
    @include('includes.subnav-engagement-ticket')
@endsection
@section('content')

    <section class="sm-main uk-container uk-container-expand">
        <div class="uk-card uk-card-hover uk-card-default uk-card-small">
            <div class="uk-card-header">
                <h5 class="uk-card-title">Create New Ticket</h5>
            </div>
            <div class="uk-card-body">
                <hr>
                <form class="open-ticket" method="post" action="{!! url('ticket/create') !!}">
                    {!! csrf_field() !!}
                    <div class="uk-margin">
                        <label>To</label>
                        <select name="to[]" id="to_select" class="uk-input" multiple>
                        @foreach($users as $to)
                            <option value="{!! $to->idLogin !!}">{!! $to->name !!}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="uk-margin">
                        <label>CC</label>
                        <select name="to_cc[]" id="to_cc_select" class="uk-input" multiple>
                            @foreach($users as $toCc)
                                <option value="{!! $toCc->idLogin !!}">{!! $toCc->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="uk-margin">
                        {{-- <div class="uk-inline">
                            <a class="uk-button uk-button-default uk-button-small">Send to <span uk-icon="icon: chevron-down"></span></a>
                            <div class="sm-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav uk-list-line">
                                    <li><label><input class="uk-checkbox" type="checkbox"> Pulp & Paper</label></li>
                                    <li><label><input class="uk-checkbox" type="checkbox"> Agribusiness & Food</label></li>
                                    <li><label><input class="uk-checkbox" type="checkbox"> President Office</label></li>
                                    <li><label><input class="uk-checkbox sendtoall" type="checkbox"> Send To All</label></li>
                                </ul>
                            </div>
                        </div> --}}
                        <div class="uk-inline">
                            <a class="uk-button uk-button-default uk-button-small">Ticket Type <span uk-icon="icon: chevron-down"></span></a>
                            <div class="sm-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav uk-list-line">
                                    @if(count($ticketTypes) > 0)
                                        @foreach($ticketTypes as $ticketType)
                                            <li><label>
                                                <input class="uk-checkbox" type="checkbox" name="types[]" value="{!! $ticketType->id !!}"> {!! strtoupper($ticketType->name) !!}
                                            </label></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label>Message</label>
                        <textarea class="uk-textarea" name="message" rows="3" placeholder="What's up?"></textarea>
                    </div>
                    <div class="uk-flex uk-flex-between">
                        <a class="uk-modal-close uk-button grey white-text" href="{!! url('ticket') !!}">CANCEL</a>
                        <input type="submit" class="uk-modal-close uk-button uk-float-right red white-text" value="SEND" />
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
    {{--<script src="{!! asset('assets/js/pages/ticket-create.js') !!}"></script>--}}

    <script>
    $(document).ready(function() {
        $("#to_select").select2();
        $("#to_cc_select").select2();
    });
    </script>
@endsection
