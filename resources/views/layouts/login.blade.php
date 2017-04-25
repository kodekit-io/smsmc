@include('includes.header')
@yield('content')

<footer class="sm-footer">
    Copyright &copy; <?php echo date('Y'); ?> <a class="grey-text text-darken-1" href="http://www.sinarmas.com" target="_blank" title="Sinar Mas">Sinar Mas</a> | Powered by <a class="grey-text text-darken-1" href="http://www.mediawave.biz" target="_blank" title="MediaWave">MediaWave</a>
</footer>

@section('page-level-scripts')
@show

</body>
</html>