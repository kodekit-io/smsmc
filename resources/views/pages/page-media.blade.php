@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
    <style>
    div.dataTables_filter { text-align: left !important;}
    table.dataTable td { font-size: 14px; padding: 3px 10px; border: none !important;}
    </style>
@endsection
@section('page-level-nav')
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <div class="uk-card uk-card-hover uk-card-default uk-card-small uk-width-1-1 uk-card-body">
            <div uk-grid>
                <div class="uk-width-1-3">
                    <h5 class="uk-card-title">News</h5>
                    <table id="medialist" class="uk-table uk-table-condensed uk-width-1-1 sm-table uk-margin-remove"></table>
                </div>
                <div class="uk-width-1-3">
                    <h5 class="uk-card-title">Forum</h5>
                    <table id="forumlist" class="uk-table uk-table-condensed uk-width-1-1 sm-table uk-margin-remove"></table>
                </div>
                <div class="uk-width-1-3">
                    <h5 class="uk-card-title">Blog</h5>
                    <table id="bloglist" class="uk-table uk-table-condensed uk-width-1-1 sm-table uk-margin-remove"></table>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/dataTables.smsmc.js') !!}"></script>

    <script>
        $(document).ready(function() {
            getMediaList('medialist');
            getMediaList('forumlist');
            getMediaList('bloglist');
            function getMediaList(type) {
                $.ajax({
                    url : baseUrl + '/' + type,
                    beforeSend : function(xhr) {
                    },
                    complete : function(xhr, status) {
                    },
                    success : function(result) {
                        result = jQuery.parseJSON(result);
                        switch (type) {
                            case 'medialist':
                                var data = result.mediaList;
                            break;
                            case 'forumlist':
                                var data = result.forumList;
                            break;
                            case 'bloglist':
                                var data = result.blogList;
                            break;
                        }

                        // console.log(data);
                        var content = [];
                		for (i = 0; i < data.length; i++) {
                			id= data[i].id;
                			media= data[i].media;
                			content[i] = [ id, media ];
                		}
                        $('#'+type).DataTable( {
                            data: content,
                            pageLength: 100,
                            dom:
                            "<'uk-margin-top uk-text-small'f>" +
                            "<'uk-margin-small-top'<'uk-width-1-1'tr>>" +
                            "<'uk-margin-small-top uk-flex uk-flex-middle uk-flex-between uk-text-small'li>" +
                            "<'uk-margin-small-top'p>",
                            columns: [
                                { title: "id", width: "5%" },
                                { title: "media" },
                            ],
                            order: [[ 0, "asc" ]]
                        });
                    }
                });
            }
        });
    </script>
@endsection
