@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
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
                        <input class="uk-input" type="text" name="to">
                    </div>
                    <div class="uk-margin">
                        <label>CC</label>
                        <input class="uk-input" type="text" name="to_cc">
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
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.validate.min.js') !!}"></script>
    <script src="{!! asset('assets/js/pages/ticket-create.js') !!}"></script>

    <script>
    $(document).ready(function() {

    });

    </script>
@endsection
