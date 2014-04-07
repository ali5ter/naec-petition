    <?php $temp_query = $wp_query; ?>

    <?php $section_name = $post->post_name; ?>

    <div class="projects">
    <?php  while (have_posts()) : the_post(); ?>
        <?php $project_id = get_the_ID(); ?>

        <div id="<?php echo $post->post_name; ?>" class="projectDetails">
            <span class="<?php echo $section_name; ?> closeBtn"><a href="#index"><?php __('Close Project', 'themetrust'); ?></a></span>
            <div class="inside">
                <h2 class="projectHeader"><?php the_title(); ?></h2>

                <?php $ttrust_project_images = get_post_meta($project_id, "_ttrust_slideshow_images_value", true); ?>
                <?php $ttrust_project_images = explode("\n", $ttrust_project_images); ?>
                <?php if (sizeof($ttrust_project_images) > 1) : ?>
                <?php reset($ttrust_project_images); ?>
                <?php $ttrust_slideshow_height = get_post_meta($project_id, "_ttrust_slideshow_height_value", true);?>
                <div id="slideshow-<?php echo $project_id ?>" class="slideshow" <?php if ($ttrust_slideshow_height) echo 'style="height:'.$ttrust_slideshow_height.'px !important;"'; ?>>
                    <ul>
                    <?php $c=1; foreach ($ttrust_project_images as $project_image) {?>
                        <?php $img_url = str_replace("\r", "", $project_image); ?>
                        <li <?php if ($ttrust_slideshow_height) echo 'style="height:'.$ttrust_slideshow_height.'px !important;"'; ?>><img src="<?php echo $img_url; ?>" alt=""/></li>
                    <?php } ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php the_content(); ?>

            </div>
         </div>

    <?php $i++; endwhile; ?>
    </div>

    <?php wp_reset_query();?>

    <?php if ($page_skills) : // if there are a limited number of skills set ?>
        <?php query_posts( 'skill='.$skill_slugs.'&post_type=projects&posts_per_page=200' ); ?>
    <?php else : // if not, use all the skills ?>
        <?php query_posts( 'post_type=projects&posts_per_page=100' ); ?>
    <?php endif; ?>

    <ul class="projectThumbs clearfix">
    <?php  while (have_posts()) : the_post(); ?>

        <li id="thumb-<?php echo $post->post_name; ?>">
            <a href="#<?php echo $post->post_name; ?>" class="<?php echo $section_name; ?>" rel="bookmark" ><?php the_post_thumbnail('ttrust_threeColumn', array('class' => 'thumb', 'alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?></a>
            <h1><?php the_title(); ?></h1>
         </li>

    <?php $i++; endwhile; ?>
    </ul>

    <?php $wp_query = $temp_query; ?>
