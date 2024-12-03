<main class="container body-post">
    <section class="section">
        <article class="post">
            <?php the_title('<h1 class="main-title">', '</h1>'); ?>
            <div class="content">
                <?php the_content(); ?>
            </div>
        </article>
        <?php 
            if ( is_active_sidebar('page-sidebar') ) {
                dynamic_sidebar('page-sidebar'); 
            } 
        ?>
    </section>
</main>