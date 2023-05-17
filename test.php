<!doctype html>
<html lang = "en">
<head>
    <meta charset = "utf-8">
    <title>jQuery UI Datepicker functionality</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>

<body>

    <form class="form" name="form" method="GET" action="submit.php">
        <?php
            $current_user = wp_get_current_user();
            echo $current_user->user_email;
        ?>
        <input type="text" id="datetime" name="data">
        <input type="submit" value="Submit">
    </form>

    <script>
        flatpickr("#datetime", {
            minDate: "today",
            maxDate: new Date().fp_incr(60), // 60 days from now
            mode: "multiple",
            enableTime: false,
            inline: true,
            //wrap: true,
            
            altInput: true,
            altFormat: "D j F, Y",
            dateFormat: "Y-m-d",
            theme: "dark",

            onChange: function( selectedDates, dateStr, instance ) {
                console.log( selectedDates ) ;
            },

        });
    </script>
    
</body>
</html>