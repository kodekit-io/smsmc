@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
@endsection
@section('page-level-nav')
    @include('includes.subnav-engagement')
@endsection
@section('content')

    <section class="sm-main uk-container uk-container-expand">
        <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small uk-margin">
            <div class="uk-card-header">
                <h5 class="uk-card-title">Engagement Thread</h5>
            </div>
            <div class="uk-card-body">
                {{--Thread--}}
                    <ul class="sm-thread" uk-accordion="multiple: true">
                        <li class="uk-open">
                            <h6 class="uk-accordion-title">Your post on Mon, Jan 2, 2017 1:23 AM on Facebook</h6>
                            <div class="uk-accordion-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        </li>
                    </ul>
                    <h6 class="uk-margin-small-bottom">Your Reply</h6>
                    <form class="uk-form-horizontal" action="" method="post">
                        {!! csrf_field() !!}
                        <fieldset class="uk-fieldset">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="postSocmed"><span uk-icon="icon: file-edit"></span> Content</label>
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea" id="postSocmed" rows="8" placeholder="What's up?" name="socmed_content"></textarea>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="img"><span uk-icon="icon: image"></span> Image</label>
                                <div class="uk-form-controls">
                                    <input type="file" id="img">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="img"><span uk-icon="icon: clock"></span> Scheduled Post?</label>
                                <div class="uk-form-controls">
                                    <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                        <input id="schedule" class="uk-input uk-form-width-medium" type="text">
                                    </div>
                                    <a id="clear" class="uk-icon-button uk-hidden" uk-icon="icon: close" title="Clear date" uk-tooltip></a>
                                </div>
                            </div>
                            <hr>
                            <div class="uk-flex uk-flex-middle uk-flex-between">
                                <a class="uk-modal-close uk-button grey white-text" href="{!! url('/engagement/timeline') !!}">CANCEL</a>
                                <button id="postsave" class="uk-button uk-button-primary uk-hidden" type="submit">Save Post</button>
                                <button id="postnowsocmed" class="uk-button uk-button-danger red" type="submit">Post Now</button>
                            </div>
                        </fieldset>
                    </form>
                {{--end of threads--}}
            </div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.validate.min.js') !!}"></script>

    <script>
    $(document).ready(function() {
        var dt = new Date();
        $('#schedule').datetimepicker({
            'format': 'd-m-y H:i',
            'minDate': 0,
            'minDateTime': dt,
            'closeOnDateSelect' : true,
            'validateOnBlur' : true,
        });
        $('#schedule').blur(function () {
            if ($(this).val()) {
                $('#postsave').removeClass('uk-hidden');
                $('#postnowsocmed').addClass('uk-hidden');
                $('#clear').removeClass('uk-hidden');
            } else {
                $('#postnowsocmed').removeClass('uk-hidden');
                $('#postsave').addClass('uk-hidden');
                $('#clear').addClass('uk-hidden');
            }
        });
        $('#clear').click(function(){
            $(this).addClass('uk-hidden');
            $('#schedule').val('');
            $('#postnowsocmed').removeClass('uk-hidden');
            $('#postsave').addClass('uk-hidden');
        });
    });
    </script>
@endsection
