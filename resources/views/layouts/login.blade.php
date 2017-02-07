@include('includes.header')
@yield('content')

<footer class="sm-footer">
    Copyright &copy; <?php echo date('Y'); ?> <a class="grey-text text-darken-1" href="http://www.sinarmas.com" target="_blank" title="Sinarmas">Sinarmas</a> | Powered by <a class="grey-text text-darken-1" href="http://www.mediawave.biz" target="_blank" title="MediaWave">MediaWave</a>
</footer>

<script src="{!! asset('assets/js/jquery.min.js') !!}"></script>
<script src="{!! asset('assets/js/uikit.min.js') !!}"></script>
@section('page-level-scripts')
@show

</body>
</html>