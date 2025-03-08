{{-- <!doctype html>
<html class="no-js" lang="zxx">

@include('frontend.amazy.auth.partials._header')

@section('content')
    @show


@include('frontend.amazy.auth.partials._scripts') --}}

<!doctype html>
<html class="no-js" lang="zxx">
    
    @include('frontend.amazy.auth.partials._header')  <!-- Include Header -->

    <body>
        <!-- Content Section -->
        @section('content')
            @show
        <!-- End of Content Section -->

    </body>

    @include('frontend.amazy.auth.partials._scripts')  <!-- Include Scripts -->
</html>