<?php
/**
* Plugin Name: StickyContent
* Plugin URI: https://github.com/cnoid/StickyContent-wp
* Description: Creates a Sticky Table of Content for pages. See the README on Plugin page for information.
* Version: 0.6.1
* Author: Eivind G.
* Author URI: https://github.com/cnoid
* License: GPLv3
*/

function myplugin_enqueue_styles() {
    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'mypluginstyle', $plugin_url . 'style.css', array(), '1.0', 'all');
}
add_action( 'wp_enqueue_scripts', 'myplugin_enqueue_styles', 999 );

function table_of_contents() {
    ?>
    <script>
    window.onload = function() {
        var headerTags = document.querySelectorAll("h2, h3");

        var table = document.createElement("table");

        headerTags.forEach(function(header) {

            if (header.innerText !== "Elements to copy:") {

                var row = document.createElement("tr");
                var cell = document.createElement("td");

                var link = document.createElement("a");
                link.setAttribute("href", "#" + header.id);
                link.innerText = header.innerText;

                cell.appendChild(link);
                row.appendChild(cell);
                table.appendChild(row);
            }
        });

        var tocBox = document.getElementById("tocBox");
        var tocBoxMobile = document.getElementById("tocBoxMobile");

        tocBox.appendChild(table.cloneNode(true));

        tocBoxMobile.appendChild(table.cloneNode(true));
    }
    </script>
    <?php
}

add_action('wp_footer', 'table_of_contents');
?>
