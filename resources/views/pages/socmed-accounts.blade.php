@extends('layouts.default')
@section('page-level-styles')
@endsection
@section('page-level-nav')
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <form id="socmed_acc" class="" action="{!! url('socmed-accounts/save') !!}" method="post">
            {!! csrf_field() !!}
            <div class="uk-grid-small uk-grid-match uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-2@m " uk-grid>
                <div>
                    <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                        <div class="uk-card-header uk-clearfix">
                            <h5 class="uk-card-title color-text-facebook"><i class="fa fa-facebook fa-fw"></i> Facebook</h5>
                        </div>
                        <div class="uk-card-body">
                            @php $latestFbId = 0; @endphp
                            @if(count($socmed->facebook) > 0)
                                <ol id="facebook" class="uk-list-divider sm-list-item uk-margin-remove-top">
                                @foreach($socmed->facebook as $fbAccount)
                                    <li data-id="{{ $fbAccount->id }}">
                                        <input class="uk-input field-facebook" name="field_facebook[{!! $loop->iteration !!}]" type="text" placeholder="facebook" value="{!! $fbAccount->name !!}">
                                        <a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove this account" uk-tooltip></a>
                                    </li>
                                    @php $latestFbId = $fbAccount->id; @endphp
                                @endforeach
                                </ol>
                            @else
                                <ol id="facebook" class="uk-list-divider sm-list-item uk-margin-remove-top">
                                    <li data-id="1"><input class="uk-input field-facebook" name="field_facebook[1]" type="text" placeholder="facebook"></li>
                                </ol>
                            @endif
                            <a onclick="addRowItem('facebook')" class="uk-button uk-button-text" title="Add New Account" uk-tooltip>
                                <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Facebook</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                        <div class="uk-card-header uk-clearfix">
                            <h5 class="uk-card-title color-text-twitter"><i class="fa fa-twitter fa-fw"></i> Twitter</h5>
                        </div>
                        <div class="uk-card-body">
                            @php $latestTwId = 0; @endphp
                            @if(count($socmed->twitter) > 0)
                                <ol id="twitter" class="uk-list-divider sm-list-item uk-margin-remove-top">
                                    @foreach($socmed->twitter as $twAccount)
                                        <li data-id="{{ $twAccount->id }}">
                                            <input class="uk-input field-twitter" name="field_twitter[{!! $twAccount->id !!}]" type="text" placeholder="twitter" value="{!! $twAccount->name !!}">
                                            <a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove this account" uk-tooltip></a>
                                        </li>
                                        @php $latestTwId = $twAccount->id; @endphp
                                    @endforeach
                                </ol>
                            @else
                                <ol id="twitter" class="uk-list-divider sm-list-item uk-margin-remove-top">
                                    <li data-id="1"><input class="uk-input field-twitter" name="field_twitter[1]" type="text" placeholder="twitter"></li>
                                </ol>
                            @endif
                            <a onclick="addRowItem('twitter')" class="uk-button uk-button-text" title="Add New Account" uk-tooltip>
                                <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Twitter</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                        <div class="uk-card-header uk-clearfix">
                            <h5 class="uk-card-title color-text-youtube"><i class="fa fa-youtube fa-fw"></i> Youtube</h5>
                        </div>
                        <div class="uk-card-body">
                            @php $latestYtId = 0; @endphp
                            @if(count($socmed->youtube) > 0)
                                <ol id="youtube" class="uk-list-divider sm-list-item uk-margin-remove-top">
                                    @foreach($socmed->youtube as $ytAccount)
                                        <li data-id="{{ $ytAccount->id }}">
                                            <input class="uk-input field-youtube" name="field_youtube[{!! $loop->iteration !!}]" type="text" placeholder="youtube" value="{!! $ytAccount->name !!}">
                                            <a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove this account" uk-tooltip></a>
                                        </li>
                                        @php $latestYtId = $ytAccount->id; @endphp
                                    @endforeach
                                </ol>
                            @else
                                <ol id="youtube" class="uk-list-divider sm-list-item uk-margin-remove-top">
                                    <li data-id="1"><input class="uk-input field-youtube" name="field_youtube[1]" type="text" placeholder="youtube"></li>
                                </ol>
                            @endif
                            <a onclick="addRowItem('youtube')" class="uk-button uk-button-text" title="Add New Account" uk-tooltip>
                                <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Youtube</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                        <div class="uk-card-header uk-clearfix">
                            <h5 class="uk-card-title color-text-instagram"><i class="fa fa-instagram fa-fw"></i> Instagram</h5>
                        </div>
                        <div class="uk-card-body">
                            @php $latestIgId = 0; @endphp
                            @if(count($socmed->instagram) > 0)
                                <ol id="instagram" class="uk-list-divider sm-list-item uk-margin-remove-top">
                                    @foreach($socmed->instagram as $igAccount)
                                        <li data-id="{{ $igAccount->id }}">
                                            <input class="uk-input field-instagram" name="field_instagram[{!! $loop->iteration !!}]" type="text" placeholder="instagram" value="{!! $igAccount->name !!}">
                                            <a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove this account" uk-tooltip></a>
                                        </li>
                                        @php $latestIgId = $igAccount->id; @endphp
                                    @endforeach
                                </ol>
                            @else
                                <ol id="instagram" class="uk-list-divider sm-list-item uk-margin-remove-top">
                                    <li data-id="1"><input class="uk-input field-instagram" name="field_instagram[1]" type="text" placeholder="instagram"></li>
                                </ol>
                            @endif
                            <a onclick="addRowItem('instagram')" class="uk-button uk-button-text" title="Add New Account" uk-tooltip>
                                <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Instagram</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-1">
                    <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small uk-card-body uk-clearfix">
                        <button class="uk-button red white-text uk-float-right" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/pages/socmed-accounts.js') !!}"></script>
@endsection
