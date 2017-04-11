@extends('layouts.default')
@section('page-level-styles')
@endsection
@section('page-level-nav')
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <div class="uk-animation-fade uk-card no-header uk-card-hover uk-card-default uk-card-small">
            <form method="post" action="{!! url('setting/account/update') !!}">
            {!! csrf_field() !!}
            <div class="uk-card-body">
                <div class="uk-grid-medium" data-uk-grid-match data-uk-grid-margin uk-grid>
            		<div class="uk-width-1-2">
                        <h5 class="uk-card-title">Profile</h5>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="name">Name</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="name" type="text" name="name" value="{!! $user->name !!}">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="email">Email</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="email" type="email" name="email" value="{!! $user->email !!}">
                            </div>
                        </div>
            		</div>
                    <div class="uk-width-1-2">
                        <h5 class="uk-card-title">Edit Password</h5>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="pwd">New Password</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="pwd" type="password" name="password">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="pwd2">Repeat New Password</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="pwd2" type="password" name="password2">
                            </div>
                        </div>
            		</div>
            	</div>
            </div>
            <div class="uk-card-footer uk-clearfix">
                <button class="uk-button red white-text uk-float-right" type="submit">Save Changes</button>
            </div>
            </form>
        </div>
    </section>

@endsection

@section('page-level-scripts')
@endsection