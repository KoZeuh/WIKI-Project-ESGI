<?php
    if (isset($errorsAlert)) {
        if (count($errorsAlert) > 0){
            echo '<div class="alert alert-danger text-center" role="alert">';
                foreach ($errorsAlert as $error) {
                    echo ' - '. $error . '<br>';
                }
            echo '</div>';
        }
    }
?>