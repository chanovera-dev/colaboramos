<article class="colaborator-card post">
    <?php
        echo the_category();
        echo '<img class="avatar" src="'; the_post_thumbnail_url( 'media' ); echo '" alt="Foto del colaborador" loading="lazy" width="150" height="150">';
        the_title('<h2 class="post-title">', '</h2>');
        the_content();
    ?>
</article>