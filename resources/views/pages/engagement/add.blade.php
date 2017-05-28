@extends('layouts.default')
@section('page-level-styles')

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
                                        @if(isset($socmedAttributes[$socmed]))
                                        <option value="{!! $socmed !!}">{!! $name !!}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="uk-margin-left uk-margin-small-right">From account</span>
                                <select class="uk-select uk-width-medium" id="acc-from" name="acc_id">
                                    <option value="">Akun 1</option>
                                </select>
                                {{-- <p><em>* Note: News, Blog, Forum should be posted manually</em></p> --}}
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="postSocmed"><span uk-icon="icon: file-edit"></span> Content</label>
                            <div class="uk-form-controls">
                                <input class="uk-input uk-margin-small-bottom sm-formyoutube" id="videoTitle" placeholder="Video Title" name="videoTitle">
                                <textarea class="uk-textarea uk-margin-small-bottom sm-formyoutube" id="videoDescription" rows="4" placeholder="Video Description" name="videoDescription" ></textarea>
                                <input class="uk-input sm-formyoutube" id="videoTags" placeholder="Video Tag" name="videoTags">
                                <textarea class="uk-textarea sm-forminput" id="postSocmed" rows="8" placeholder="What's up?" name="content" ></textarea>
                            </div>
                        </div>
                        <div class="uk-margin sm-img">
                            <label class="uk-form-label" for="img"><span uk-icon="icon: image"></span> Image </label>
                            <div class="uk-form-controls">
                                <div uk-form-custom="target: true">
                                    <input type="file" id="img" name="image">
                                    <input class="uk-input uk-form-width-medium" type="text" placeholder="Select image file" disabled> (max filesize allowed 2MB)
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin sm-vid">
                            <label class="uk-form-label" for="vid"><span uk-icon="icon: play-circle"></span> Video</label>
                            <div class="uk-form-controls">
                                <div uk-form-custom="target: true">
                                    <input type="file" id="vid" name="video">
                                    <input class="uk-input uk-form-width-medium" type="text" placeholder="Select video file" disabled> (max filesize allowed 1GB)
                                </div>
                            </div>
                        </div>
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
    <script src="{!! asset('assets/js/pages/engagement-add.js') !!}"></script>
@endsection
