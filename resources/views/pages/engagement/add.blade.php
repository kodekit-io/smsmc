@extends('layouts.default')
@section('page-level-styles')
<style>
#progress-bar {
    background-color: #EC1C23;
    height: 5px;
    color: #FFFFFF;
    width: 0%;
}

#progress-div {
    border: #EC1C23 1px solid;
    padding: 5px 0px;
    margin: 30px 0px;
    text-align: center;
}

#targetLayer {
    width: 100%;
    text-align: center;
}
</style>
@endsection
@section('page-level-nav')
    @include('includes.subnav-engagement')
@endsection
@section('content')

    <section class="sm-main uk-container uk-container-expand">
        <div class="uk-card uk-card-hover uk-card-default uk-card-small">
            <div class="uk-card-header">
                <h5 class="uk-card-title">New Post</h5>
            </div>
            <div class="uk-card-body">
                <hr>
                <form id="engagementPost" class="uk-form-horizontal" action="{!! url('engagement/post') !!}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <fieldset class="uk-fieldset">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="post-to"><span uk-icon="icon: social"></span> Post to</label>
                            <div class="uk-form-controls">
                                <select class="uk-select uk-width-medium" id="post-to" name="media_id">
                                    @foreach($socmeds as $socmed => $name)
                                        <option value="{!! $socmed !!}">{!! $name !!}</option>
                                    @endforeach
                                </select>
                                <span class="uk-margin-left uk-margin-small-right">From account</span>
                                {{--  akun fb --}}
                                <select class="uk-select uk-width-medium sm-post-fb" id="accFb" name="accFb">
                                    @foreach($fbAccounts as $fbAccount)
                                        <option value="{{ $fbAccount->engagementId }}">{{ $fbAccount->engagementAuthor }}</option>
                                    @endforeach
                                </select>
                                {{--  akun tw --}}
                                <select class="uk-select uk-width-medium sm-post-tw" id="accTw" name="accTw">
                                    @foreach($twAccounts as $twAccount)
                                        <option value="{{ $twAccount->engagementId }}">{{ $twAccount->engagementAuthor }}</option>
                                    @endforeach
                                </select>
                                {{--  akun yt --}}
                                <select class="uk-select uk-width-medium sm-post-yt" id="accYt" name="accYt">
                                    @foreach($ytAccounts as $ytAccount)
                                        <option value="{{ $ytAccount->engagementId }}">{{ $ytAccount->engagementAuthor }}</option>
                                    @endforeach
                                </select>
                                {{--  akun ig --}}
                                <select class="uk-select uk-width-medium sm-post-ig" id="accIg" name="accIg">
                                    @foreach($igAccounts as $igAccount)
                                        <option value="{{ $igAccount->engagementId }}">{{ $igAccount->engagementAuthor }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- FORM FB --}}
                        <div class="sm-post-fb">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="postContentFb"><span uk-icon="icon: file-edit"></span> Content</label>
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea sm-required" id="postContentFb" rows="5" placeholder="What's up?" name="postContentFb"></textarea>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="postImgFb"><span uk-icon="icon: image"></span> Image</label>
                                <div class="uk-form-controls">
                                    <div uk-form-custom="target: true">
                                        <input type="file" id="postImgFb" name="postImgFb">
                                        <input class="uk-input uk-form-width-medium" type="text" placeholder="Select image file" disabled> (max filesize allowed 2MB)
                                    </div>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="postVidFb"><span uk-icon="icon: play-circle"></span> Video</label>
                                <div class="uk-form-controls">
                                    <div uk-form-custom="target: true">
                                        <input type="file" id="postVidFb" name="postVidFb">
                                        <input class="uk-input uk-form-width-medium" type="text" placeholder="Select video file" disabled> (max filesize allowed 1GB)
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- FORM TWITTER --}}
                        <div class="sm-post-tw">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="postContentTw"><span uk-icon="icon: file-edit"></span> Content</label>
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea sm-required" id="postContentTw" rows="5" placeholder="What's up?" name="postContentTw" ></textarea>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="img"><span uk-icon="icon: image"></span> Image</label>
                                <div class="uk-form-controls">
                                    <div class="uk-width-1-1 uk-margin-small-bottom" uk-form-custom="target: true">
                                        <input type="file" id="postImgTw1" name="postImgTw1">
                                        <input class="uk-input uk-form-width-medium" type="text" placeholder="Select image file" disabled> (max filesize allowed 2MB)
                                    </div>
                                    {{-- <div class="uk-width-1-1 uk-margin-small-bottom" uk-form-custom="target: true">
                                        <input type="file" id="postImgTw2" name="postImgTw2">
                                        <input class="uk-input uk-form-width-medium" type="text" placeholder="Select image file" disabled> (max filesize allowed 2MB)
                                    </div>
                                    <div class="uk-width-1-1 uk-margin-small-bottom" uk-form-custom="target: true">
                                        <input type="file" id="postImgTw3" name="postImgTw3">
                                        <input class="uk-input uk-form-width-medium" type="text" placeholder="Select image file" disabled> (max filesize allowed 2MB)
                                    </div>
                                    <div class="uk-width-1-1" uk-form-custom="target: true">
                                        <input type="file" id="postImgTw4" name="postImgTw4">
                                        <input class="uk-input uk-form-width-medium" type="text" placeholder="Select image file" disabled> (max filesize allowed 2MB)
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        {{-- FORM YUTUB --}}
                        <div class="sm-post-yt">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="vid"><span uk-icon="icon: play-circle"></span> Video</label>
                                <div class="uk-form-controls">
                                    <div class="uk-width-1-1 uk-margin-small-bottom" uk-form-custom="target: true">
                                        <input type="file" id="postVidYt" name="postVidYt">
                                        <input class="uk-input uk-form-width-medium" type="text" placeholder="Select video file" disabled> (max filesize allowed 1GB)
                                    </div>
                                    <input class="uk-input uk-margin-small-bottom" id="postContentYt" placeholder="Video Title" name="postTitleYt">
                                    <textarea class="uk-textarea uk-margin-small-bottom" id="postDescYt" rows="4" placeholder="Video Description" name="postDescYt" ></textarea>
                                    <input class="uk-input" id="postTagYt" placeholder="Video Tag" name="postTagYt">
                                </div>
                            </div>
                        </div>
                        {{-- FORM IG --}}
                        <div class="sm-post-ig">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="img"><span uk-icon="icon: image"></span> Image</label>
                                <div class="uk-form-controls">
                                    <div uk-form-custom="target: true">
                                        <input type="file" id="postImgIg" name="postImgIg">
                                        <input class="uk-input uk-form-width-medium" type="text" placeholder="Select image file" disabled> (max filesize allowed 2MB)
                                    </div>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="postContentIg"><span uk-icon="icon: file-edit"></span> Captions</label>
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea sm-required" id="postContentIg" rows="5" placeholder="What's up?" name="postContentIg" ></textarea>
                                </div>
                            </div>
                        </div>
                        {{--  --}}
                        <div class="uk-margin">
                            <label class="uk-form-label" for="img"><span uk-icon="icon: clock"></span> Scheduled Post?</label>
                            <div class="uk-form-controls">
                                <div class="uk-inline">
                                    <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                    <input id="schedule" class="uk-input uk-form-width-medium" type="text" name="post_date" />
                                </div>
                                <a id="set" class="uk-icon-button" uk-icon="icon: check" title="Confirm Date" uk-tooltip></a>
                                <a id="clear" class="uk-icon-button uk-hidden" uk-icon="icon: close" title="Clear date" uk-tooltip></a>
                            </div>
                        </div>
                        <hr>
                        <div class="uk-flex uk-flex-middle uk-flex-between">
                            <a class="uk-modal-close uk-button grey white-text" href="{!! url('/engagement/list') !!}">CANCEL</a>
                            <button id="postsave" class="uk-button uk-button-primary uk-hidden" type="submit">Save Post</button>
                            <button id="postnowsocmed" class="uk-button uk-button-danger red" type="submit">Post Now</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>

    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.validate.min.js') !!}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js" integrity="sha384-tIwI8+qJdZBtYYCKwRkjxBGQVZS3gGozr3CtI+5JF/oL1JmPEHzCEnIKbDbLTCer" crossorigin="anonymous"></script> --}}
    <script src="{!! asset('assets/js/pages/engagement-add.js') !!}"></script>
@endsection
