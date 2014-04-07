<?php get_header(); ?>
        <div id="main" class="clearfix">
            <div id="content">

                <?php $ttrust_home_message = of_get_option('ttrust_home_message'); ?>

                <?php if($ttrust_home_message) : ?>
                    <div id="homeMessage" >
                        <div class="inside clearfix">
                        <p><?php echo $ttrust_home_message ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php query_posts( 'post_type=page&posts_per_page=100&orderby=menu_order&order=asc' ); ?>

                <?php  while (have_posts()) : the_post(); ?>

                    <?php $template = get_post_meta( $wp_query->post->ID, '_wp_page_template', true ); ?>

                    <div id="<?php echo $post->post_name; ?>" class="scrollWrap">
                    <div class="soloSection">
                        <div class="inside clearfix">
                            <h1 class="sectionHeader"><?php the_title(); ?></h1>
                             <?php the_content(); ?>
                        </div>
                        <?php  if ($template == "portfolio.php"): ?>
                            <?php include( TEMPLATEPATH . '/includes/projects.php'); ?>
                        <?php elseif ($template == "petition.php"): ?>
                            <?php include( TEMPLATEPATH . '/../solo-child/includes/petition.php'); ?>
                        <?php endif; ?>
                    </div>
                    </div>

                <?php $i++; endwhile; ?>
            </div>


<?php get_footer(); ?>
