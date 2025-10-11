<article class="post">
    <div class="backdrop"></div>
    <?php
        if ( has_post_thumbnail() ) {
            echo get_the_post_thumbnail( null, 'loop-picture', [ 'class' => 'thumbnail', 'alt'   => get_the_title(), 'loading' => 'lazy' ] );
        }
    ?>
    <div class="post--content">
        <div class="post--categories">
            <?php
                $categories = get_the_category();
                if ( ! empty( $categories ) ) {
                    foreach ( $categories as $category ) {
                        // Escapar el nombre y generar link seguro
                        $cat_name = esc_html( $category->name );
                        $cat_link = esc_url( get_category_link( $category->term_id ) );

                        echo "<a href='{$cat_link}' class='post-category button small-button'><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-bookmark\" viewBox=\"0 0 16 16\"><path d=\"M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z\"/></svg>{$cat_name}</a> ";
                    }
                }
            ?>
        </div>
        <a href="<?php the_permalink(); ?>" class="post--permalink">
            <?php the_title( '<h3 class="post--title">', '</h3>' ); ?>
        </a>
    </div>
</article>