<!-- ================Footer Area ================= -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                @php 
                    $copyRightText = app('general_setting')->footer_copy_right; 
                    $currentYear = date('Y'); // Get the current year
                    // Replace the year in the footer text
                    $updatedCopyRightText = str_replace('2024', $currentYear, $copyRightText);
                    echo $updatedCopyRightText; 
                @endphp
            </div>
        </div>
    </div>
</footer>

<!-- ================End Footer Area ================= -->