<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<body oncontextmenu="return false;">
<embed src="{{ asset($link) }}" id="pdfEmbed" type="application/pdf" download="" width="100%" height="100%"/>

    <script>
        $(document).ready(function() {
            $(document).bind("contextmenu", function() {
                return false;
            });
        });

</script>
</body>




