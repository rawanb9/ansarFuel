<script>
    @if ((isset($success)  && $message = $success) || $message = \Illuminate\Support\Facades\Session::get('success'))
    @if(is_array($message))
    let s = "<ul>";
    @foreach ($message as $successM)
        s = s + "<li>{{ $successM }}</li>";
    @endforeach
        s = s + "</ul>";
    Swal.fire({
        icon: 'success',
        html: s,
        title: 'Success'
    });
    @else
    Swal.fire({
        icon: 'success',
        text: '{{$message}}',
        title: 'Success'
    });
    @endif
    @endif

    @if ((isset($warning)  && $message = $warning) || $message = \Illuminate\Support\Facades\Session::get('warning'))
    @if(is_array($message))
    let w = "<ul>";
    @foreach ($message as $warning)
        w = w + "<li>{{ $warning }}</li>";
    @endforeach
        w = w + "</ul>";
    Swal.fire({
        icon: 'warning',
        html: w,
        title: 'Warning'
    });
    @else
    Swal.fire({
        icon: 'warning',
        text: '{{$message}}',
        title: 'Warning'
    });
    @endif
    @endif

    @if ((isset($danger)  && $message = $danger) || $message = \Illuminate\Support\Facades\Session::get('danger'))
    @if(is_array($message))
    let d = "<ul>";
    @foreach ($message as $dangerM)
        d = d + "<li>{{ $dangerM }}</li>";
    @endforeach
        d = d + "</ul>";
    Swal.fire({
        icon: 'error',
        html: d,
        title: 'Error'
    });
    @else
    Swal.fire({
        icon: 'error',
        text: '{{$message}}',
        title: 'error'
    });
    @endif
    @endif

    @if ((isset($info)  && $message = $info) || $message = \Illuminate\Support\Facades\Session::get('info'))
    @if(is_array($message))
    let i = "<ul>";
    @foreach ($message as $infoM)
        i = i + "<li>{{ $infoM }}</li>";
    @endforeach
        i = i + "</ul>";
    Swal.fire({
        icon: 'info',
        html: i,
        title: 'Info'
    });
    @else
    Swal.fire({
        icon: 'info',
        text: '{{$message}}',
        title: 'Info'
    });
    @endif
    @endif

    @if ((isset($error)  && $message = $error) || $message = \Illuminate\Support\Facades\Session::get('error'))
    @if(is_array($message))
    let e = "<ul>";
    @foreach ($message as $errorM)
        e = e + "<li>{{ $errorM }}</li>";
    @endforeach
        e = e + "</ul>";
    Swal.fire({
        icon: 'error',
        html: e,
        title: 'Error'
    });
    @else
    Swal.fire({
        icon: 'error',
        text: '{{$message}}',
        title: 'error'
    });
    @endif

    @elseif ($errors->any())
    let es = "<ul>";
    @foreach ($errors->all() as $errorsM)
        es = es + "<li>{{ $errorsM }}</li>";
    @endforeach
        es = es + "</ul>";
    Swal.fire({
        icon: 'error',
        html: es,
        title: 'Error'
    });
    @endif
</script>
