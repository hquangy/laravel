@if (count($errors))
<div class="alert alert-danger alert-dismissible alert-absolute">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> Errors!</h4>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
<script>
    $('div.alert-danger').delay(12000).fadeOut(1000);
</script>
@endif
