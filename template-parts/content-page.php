<div id="main" class="site-main" role="main">
    <article class="page" id="<?php the_ID(); ?>">
        <header class="block">
            <div class="content">
                <div class="frame">     
                    <div class="frame-bg">
                        <img class="bg-color album-artwork" src="https://relatosycartas.com/wp-content/uploads/2025/04/pequena-dama-min.webp"/>
                        <img class="bg-black album-artwork" src="https://relatosycartas.com/wp-content/uploads/2025/05/Gr_IUuLWoAAmn8Z.jpeg"/>
                    </div>	
                </div>
                <?php
                if ( has_post_thumbnail() ) {
                        echo get_the_post_thumbnail( null, 'full', [ 'class' => 'background-hero', 'alt'   => get_the_title(), 'loading' => 'lazy', 'data-speed' => '0.25' ] );
                    }

                    the_title( '<h1 class="page-title">', '</h1>' );
                ?>
            </div>
        </header>
        <section class="block">
            <div class="content is-layout-constrained">
                <?php the_content(); ?>
            </div>
        </section>
    </article>
</div>