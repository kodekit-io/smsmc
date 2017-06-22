@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
@endsection
@section('page-level-nav')
    @include('includes.subnav-admin')
@endsection
@section('content')

    <section class="sm-main uk-container uk-container-expand">
        <div class="uk-card uk-card-hover uk-card-default uk-card-small">
            <div class="uk-card-header">
                <h5 class="uk-card-title">Edit Group</h5>
            </div>
            <div class="uk-card-body">
                <hr>
                <form id="editGroup" method="post" action="{!! url('setting/group/' . $id. '/update') !!}">
                    {!! csrf_field() !!}
                    <ul class="uk-child-width-1-2 uk-grid-small uk-grid-match uk-margin" uk-grid>
                        <li><div class="uk-position-relative">
                            <label>Name</label>
                            <input class="uk-input" type="text" name="name" value="{!! $group->groupName !!}">
                        </div></li>
                        <li><div class="uk-position-relative">
                            <label>Pillar</label>
                            <select name="id_business" class="uk-select">
                                @foreach($pilars as $pilar)
                                   <option value="{{ $pilar->id }}">{{ $pilar->pilarName }}</option>
                                @endforeach
                            </select>
                        </div></li>
                        <li class="uk-width-1-1"><div class="uk-position-relative">
                            <label>Description</label>
                            <input class="uk-input" type="text" name="group_desc">
                        </div></li>
                    </ul>
                    <div class="uk-flex uk-flex-between">
                        <a class="uk-modal-close uk-button grey white-text" href="{!! url('setting/group') !!}">CANCEL</a>
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
    {{--<script src="{!! asset('assets/js/pages/ticket-create.js') !!}"></script>--}}

    <script>
        $(document).ready(function() {
            $('#editGroup').validate({
                rules: {
                    name: {
                        required: true
                    },
                    id_business: {
                        required: true
                    }
                }
            });
        });

    </script>
@endsection
