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
                                <ul id="facebook" class="uk-list uk-list-divider uk-margin-remove-top">
                                @foreach($socmed->facebook as $fbAccount)
                                    <li class="uk-position-relative" data-id="{{ $fbAccount->id }}">
                                        <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                                            <div class="uk-width-auto"><div class="sm-number">{{ $fbAccount->id }}</div></div>
                                            <div class="uk-width-expand"><input class="uk-input field-facebook" name="field_facebook[{{ $fbAccount->id }}]" type="text" placeholder="facebook" value="{!! $fbAccount->name !!}"></div>
                                            <div class="uk-width-auto"><a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove" uk-tooltip></a></div>
                                        </div>
                                    </li>
                                    @php $latestFbId = $fbAccount->id; @endphp
                                @endforeach
                                </ul>
                            @else
                                <ul id="facebook" class="uk-list uk-list-divider uk-margin-remove-top">
                                    <li class="uk-position-relative" data-id="1">
                                        <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                                            <div class="uk-width-auto"><div class="sm-number">1</div></div>
                                            <div class="uk-width-expand"><input class="uk-input field-facebook" name="field_facebook[1]" type="text" placeholder="facebook"></div>
                                            <div class="uk-width-auto"><a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove" uk-tooltip uk-hidden></a></div>
                                        </div>
                                    </li>
                                </ul>
                            @endif
                            @if(count($socmed->facebook) < 10)
                                <a onclick="addRowItem('facebook')" class="uk-button uk-button-text" title="Add New Account" uk-tooltip>
                                    <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Facebook</span>
                                </a>
                            @endif
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
                                <ul id="twitter" class="uk-list uk-list-divider uk-margin-remove-top">
                                    @foreach($socmed->twitter as $twAccount)
                                        <li class="uk-position-relative" data-id="{{ $twAccount->id }}">
                                            <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                                                <div class="uk-width-auto"><div class="sm-number">{{ $twAccount->id }}</div></div>
                                                <div class="uk-width-expand"><input class="uk-input field-twitter" name="field_twitter[{{ $twAccount->id }}]" type="text" placeholder="twitter" value="{!! $twAccount->name !!}"></div>
                                                <div class="uk-width-auto"><a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove" uk-tooltip></a></div>
                                            </div>
                                        </li>
                                        @php $latestTwId = $twAccount->id; @endphp
                                    @endforeach
                                </ul>
                            @else
                                <ul id="twitter" class="uk-list uk-list-divider uk-margin-remove-top">
                                    <li class="uk-position-relative" data-id="1">
                                        <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                                            <div class="uk-width-auto"><div class="sm-number">1</div></div>
                                            <div class="uk-width-expand"><input class="uk-input field-twitter" name="field_twitter[1]" type="text" placeholder="twitter"></div>
                                            <div class="uk-width-auto"><a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove" uk-tooltip uk-hidden></a></div>
                                        </div>
                                    </li>
                                </ul>
                            @endif
                            @if(count($socmed->twitter) < 10)
                                <a onclick="addRowItem('twitter')" class="uk-button uk-button-text" title="Add New Account" uk-tooltip>
                                    <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Twitter</span>
                                </a>
                            @endif
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
                                <ul id="youtube" class="uk-list uk-list-divider uk-margin-remove-top">
                                    @foreach($socmed->youtube as $ytAccount)
                                        <li class="uk-position-relative" data-id="{{ $ytAccount->id }}">
                                            <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                                                <div class="uk-width-auto"><div class="sm-number">{{ $ytAccount->id }}</div></div>
                                                <div class="uk-width-expand"><input class="uk-input field-youtube" name="field_youtube[{{ $ytAccount->id }}]" type="text" placeholder="youtube" value="{!! $ytAccount->name !!}"></div>
                                                <div class="uk-width-auto"><a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove" uk-tooltip></a></div>
                                            </div>
                                        </li>
                                        @php $latestYtId = $ytAccount->id; @endphp
                                    @endforeach
                                </ul>
                            @else
                                <ul id="youtube" class="uk-list uk-list-divider uk-margin-remove-top">
                                    <li class="uk-position-relative" data-id="1">
                                        <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                                            <div class="uk-width-auto"><div class="sm-number">1</div></div>
                                            <div class="uk-width-expand"><input class="uk-input field-youtube" name="field_youtube[1]" type="text" placeholder="youtube"></div>
                                            <div class="uk-width-auto"><a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove" uk-tooltip uk-hidden></a></div>
                                        </div>
                                    </li>
                                </ul>
                            @endif
                            @if(count($socmed->youtube) < 10)
                                <a onclick="addRowItem('youtube')" class="uk-button uk-button-text" title="Add New Account" uk-tooltip>
                                    <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Youtube</span>
                                </a>
                            @endif
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
                                <ul id="instagram" class="uk-list uk-list-divider uk-margin-remove-top">
                                    @foreach($socmed->instagram as $igAccount)
                                        <li class="uk-position-relative" data-id="{{ $igAccount->id }}">
                                            <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                                                <div class="uk-width-auto"><div class="sm-number">{{ $igAccount->id }}</div></div>
                                                <div class="uk-width-expand"><input class="uk-input field-instagram" name="field_instagram[{{ $igAccount->id }}]" type="text" placeholder="instagram" value="{!! $igAccount->name !!}"></div>
                                                <div class="uk-width-auto"><a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove" uk-tooltip></a></div>
                                            </div>
                                        </li>
                                        @php $latestIgId = $igAccount->id; @endphp
                                    @endforeach
                                </ul>
                            @else
                                <ul id="instagram" class="uk-list uk-list-divider uk-margin-remove-top">
                                    <li class="uk-position-relative" data-id="1">
                                        <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                                            <div class="uk-width-auto"><div class="sm-number">1</div></div>
                                            <div class="uk-width-expand"><input class="uk-input field-instagram" name="field_instagram[1]" type="text" placeholder="instagram"></div>
                                            <div class="uk-width-auto"><a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove" uk-tooltip uk-hidden></a></div>
                                        </div>
                                    </li>
                                </ul>
                            @endif
                            @if(count($socmed->instagram) < 10)
                                <a onclick="addRowItem('instagram')" class="uk-button uk-button-text" title="Add New Account" uk-tooltip>
                                    <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Instagram</span>
                                </a>
                            @endif
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
