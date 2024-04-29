<?php
/**
* Plugin Name: StickyContent
* Plugin URI: https://github.com/cnoid/StickyContent-wp
* Description: Creates a Sticky Table of Content for pages. See the README on Plugin page for information. Modified for TranslatePress.
* Version: 0.6.1-TrPs
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
    document.addEventListener("DOMContentLoaded", function() {
        var tocBox = document.getElementById("tocBox");
        var tocBoxMobile = document.getElementById("tocBoxMobile");

        function updateTableOfContents() {
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

            if (tocBox) {
                tocBox.innerHTML = '';
                tocBox.appendChild(table.cloneNode(true));
            }
            if (tocBoxMobile) {
                tocBoxMobile.innerHTML = '';
                tocBoxMobile.appendChild(table.cloneNode(true));
            }
        }

        // TranslatePress integration
        function hasTranslationCompleted() {
            
            return document.querySelector('html').lang !== 'en' || document.querySelectorAll("[data-translatepress]").length > 0;
        }

        // Polling to wait for TranslatePress
        function waitForTranslation() {
            if(hasTranslationCompleted()) {
                updateTableOfContents();
            } else {
                setTimeout(waitForTranslation, 500); // 500ms wait time for polling, change if required
            }
        }

        waitForTranslation(); 
    });
    </script>
    <?php
}

add_action('wp_footer', 'table_of_contents');
