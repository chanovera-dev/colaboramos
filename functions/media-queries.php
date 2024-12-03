<?php

function renata_theme_media_queries() {
    ?>
        <style>
            :root{}
            
            @media(min-width:768px){}

            @media(min-width:1024px){
                /* cabecera */
                #mobile-header{display:none;}
                #desktop-header{display:inherit;}

                /* single post */
                <?php
                    if ( is_active_sidebar('page-sidebar') ) {
                        echo '.page-template-default main.body-post .section{display:grid;grid-template-columns:1fr 256px;gap:30px 90px;}';
                    }
                ?>
            }

            @media(min-width:1096px){}

        </style>
    <?php
}
add_action('wp_head', 'renata_theme_media_queries');