<?php

function renata_theme_custom_global_css() {
    ?>
        <style>
            /* G E N E R A L E S */
            *,:before,:after{box-sizing:border-box;margin:0;}
            html{scroll-behavior:smooth;font-family:sans-serif;}
            body{
                font-size:16px;font-weight:400;line-height:1.7;text-align:left;
                background:
                linear-gradient(lightcoral, transparent), linear-gradient(to top left, palegreen, transparent), linear-gradient(to top right, lightblue, transparent);
                background-blend-mode: screen;
            }
            :is(header,footer,aside) :is(ol,ul){padding-left:0;list-style:none;}
            .container .section{width:min(100% - 30px, 1096px);margin-inline:auto;}
            img{display:block;height:auto;}

            /* filtros */
            .section .categories-list{padding:50px 0;list-style:none;display:flex;gap:15px;justify-content:center;}
            .section .categories-list li a{
                padding: 3px 7px;
                background-color: #dbe1e8;
                border: 1px solid #dbe1e8;
                border-radius: 4px;
                color:#4d5f71;
                font-size: 13px;
                display: inline-block;
                text-decoration:none;
                transition:all .5s ease;
            }
            .section .categories-list li a.active{background-color:#acbaca;}

            .section .posts{padding:40px 0;transform:translateY(0);opacity:1;display:grid;gap:30px;grid-template-columns:repeat(auto-fill, minmax(291px, 1fr));transition:all .5s ease;}
            .section .posts.loading{opacity:0;transform:translateY(30px);}

            /* card */
            .section .posts .colaborator-card{
                position:relative;
                align-self:baseline;
                padding:20px;
                box-shadow: rgba(255, 255, 255, 0.1) 0px 1px 1px 0px inset, rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
                border-radius:10px;
                box-sizing:border-box;
                background-color:#fff;
                text-align:center;
                display:grid;
                gap:20px;
            }
            .section .posts .colaborator-card .post-categories{padding:0;list-style:none;display:flex;align-items:center;justify-content:center;flex-wrap:wrap;gap:10px;}
            .section .posts .colaborator-card .post-categories li a{
                padding: 3px 7px;
                background-color: #dbe1e8;
                border: 1px solid #dbe1e8;
                border-radius: 4px;
                color:#4d5f71;
                font-size: 13px;
                display: inline-block;
                text-decoration:none;
            }
            .section .posts .colaborator-card .avatar{border-radius:50%;margin-inline:auto;width:30%;background-color:#dbe1e8;}
            .section .posts .colaborator-card .post-title{text-align:center;font-size:20px;font-weight:400;}
            .section .posts .colaborator-card .link-to-site a{
                text-decoration:none;
                color:#1a73e8;
                background-image: linear-gradient(transparent 0%, transparent 90%, #1a73e8 90%, #1a73e8);
                background-repeat: no-repeat;
                background-size: 0% 100%;
                background-position-x: right;
                transition: background-size .3s;
            }
            .section .posts .colaborator-card .link-to-site a:hover{
                background-size: 100% 100%;
                background-position-x: left;
            }
            .section .posts .colaborator-card .social{padding:0;display:flex;align-items:center;justify-content:center;gap:16px;list-style:none;}
            .section .posts .colaborator-card .social li a{display:inline-flex;font-size:0;}
            .section .posts .colaborator-card .social li a:before{position:relative;padding:11px;display:inline-block;}
            .section .posts .colaborator-card .social li a[href*="whatsapp"]:before{content: ''; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/icons/whatsapp.svg');}
            .section .posts .colaborator-card .social li a[href*="facebook"]:before{content: ''; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/icons/facebook.svg');}
            .section .posts .colaborator-card .social li a[href*="instagram"]:before{content: ''; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/icons/instagram.svg');}
            .section .posts .colaborator-card .social li a[href*="telegram"]:before{content: ''; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/icons/telegram.svg');}
            .section .posts .colaborator-card .social li a[href*="mailto"]:before{content: ''; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/icons/mail.svg');}
            .section .posts .colaborator-card .social li a[href*="tel"]:before{content: ''; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/icons/phone.svg');}
            .section .posts .colaborator-card .social li a[href*="twitter"]:before{content: ''; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/icons/twitter.svg');}
            .section .posts .colaborator-card .social li a[href*="threads"]:before{content: ''; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/icons/threads.svg');}
            .section .posts .colaborator-card .social li a[href*="linkedin"]:before{content: ''; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/icons/linkedin.svg');}
        </style>
    <?php
}
add_action('wp_head', 'renata_theme_custom_global_css');