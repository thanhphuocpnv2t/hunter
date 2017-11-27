<?php
/*
  Template Name: Template About
 */
?>
<?php get_header(); ?>
<div id="contents" class="contents">
    <main class="main">
        <section class="section about_us">
            <div class="inner_sm">
                <div class="section_content element translateup" id="about_us">
                    <?php dynamic_sidebar('about-us'); ?>
                </div>
            </div>
        </section>
    </main>
</div>
<?php get_footer(); ?>
