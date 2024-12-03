<main class="container body-post">
    <section class="section heading">
    <?php the_title('<h1 class="main-title">', '</h1>'); ?>
    </section>
    <section class="section">
        <article class="post">
            <div class="content">
                <?php the_content(); ?>
            </div>
        </article>
        <?php 
            if ( is_active_sidebar('page-sidebar') ) {
                echo '<aside>';
                dynamic_sidebar('page-sidebar');
                echo '</aside>'; 
            } 
        ?>
    </section>
</main>