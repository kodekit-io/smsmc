@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
@endsection
@section('page-level-nav')
    @include('includes.subnav-engagement-ticket-details')
@endsection
@section('content')

    <section class="sm-main uk-container uk-container-expand">
        <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
            <div class="uk-card-header uk-clearfix">
                <h5 class="uk-card-title uk-float-left uk-margin-small-top">Ticket #76324</h5>
                <ul class="uk-subnav uk-float-right uk-margin-small-top">
                    <li><span>Updates: <span class="uk-label sm-label uk-label-success">Mon, Jan 2, 2017 8:23 AM</span></span></li>
                    <li><span>Status: <span class="uk-label sm-label uk-label-danger">OPEN</span></span></li>
                </ul>
            </div>
            <div class="uk-card-body">
                <hr>
                <div uk-grid>
                    <div class="uk-width-1-2">
                        <table class="uk-table uk-table-small">
                            <tr>
                                <td width="25%">Create Date</td>
                                <td>Mon, Jan 2, 2017 8:23 AM</td>
                            </tr>
                            <tr>
                                <td>Ticket Sender</td>
                                <td>Jon Snow (Manager)</td>
                            </tr>
                            <tr>
                                <td>To</td>
                                <td>Pulp & Paper</td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td>Content - Pulp & Paper</td>
                            </tr>
                        </table>
                    </div>
                    <div class="uk-width-1-2">
                        <h6>Additional Message</h6>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <h5 class="uk-card-title uk-margin-bottom-remove">Related Post</h5>
                <hr class="uk-margin-small-top">
                <div uk-grid>
                    <div class="uk-width-1-2">
                        <table class="uk-table uk-table-small">
                            <tr>
                                <td width="25%">Channel</td>
                                <td>Facebook</td>
                            </tr>
                            <tr>
                                <td>Author</td>
                                <td>Petyr Baelish</td>
                            </tr>
                            <tr>
                                <td>Post Date</td>
                                <td>Mon, Jan 2, 2017 8:23 AM</td>
                            </tr>
                            <tr>
                                <td>Sentiment</td>
                                <td>Negative</td>
                            </tr>
                        </table>
                    </div>
                    <div class="uk-width-1-2">
                        <h6>Post Details</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>
                <h5 class="uk-card-title">Respond</h5>
                <hr class="uk-margin-small-top">
                <form action="./engagement-ticket">
                    <fieldset class="uk-fieldset">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="channel">Channel</label>
                            <div class="uk-form-controls">
                                <select class="uk-select" id="channel">
                                    <option>Facebook</option>
                                    <option>Twitter</option>
                                    <option>Youtube</option>
                                    <option>Instagram</option>
                                    <option>Online News</option>
                                    <option>Forum</option>
                                    <option>Blog</option>
                                </select>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label" for="post">Your Post</label>
                            <textarea class="uk-textarea" id="post" rows="8" placeholder="What's up?"></textarea>
                        </div>
                        <div class="uk-margin">
                            <span class="uk-text-middle">Post with Image</span>
                            <div uk-form-custom>
                                <input type="file">
                            </div>
                        </div>
                        <hr>
                        <div class="uk-clearfix">
                            <span><i uk-icon="icon: clock"></i> SCHEDULE POST: </span><input id="schedule" class="uk-input uk-form-width-medium" type="date"></input><a id="clear" class="uk-button uk-button-default uk-hidden" uk-icon="icon: close" style="width:40px;padding:0;" title="Clear date" uk-tooltip></a>

                            <button id="postsave" class="uk-button uk-button-primary uk-hidden uk-float-right" type="submit">Save Post</button>

                            <button id="postnow" class="uk-button uk-button-danger red uk-float-right" type="submit">Post Now</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </section>
    {{--<div class="uk-alert-danger sm-alert" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
    </div>--}}
@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/dataTables.smsmc.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/extensions/dataTables.buttons.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/extensions/jszip.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/extensions/buttons.html5.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/extensions/pdfmake.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/extensions/vfs_fonts.js') !!}"></script>

    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    {{--<script src="{!! asset('assets/js/pages/ticket-details.js') !!}"></script>--}}
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
                $('#postnow').addClass('uk-hidden');
                $('#clear').removeClass('uk-hidden');
            } else {
                $('#postnow').removeClass('uk-hidden');
                $('#postsave').addClass('uk-hidden');
                $('#clear').addClass('uk-hidden');
            }
        });
        $('#clear').click(function(){
            $(this).addClass('uk-hidden');
            $('#schedule').val('');
            $('#postnow').removeClass('uk-hidden');
            $('#postsave').addClass('uk-hidden');
        });
    });
    </script>

@endsection