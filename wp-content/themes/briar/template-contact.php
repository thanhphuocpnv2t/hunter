<?php
/*
  Template Name: Template Contact
 */
?>
<?php get_header(); ?>
    <div id="contents" class="contents">
        <main class="main">
            <section class="section contact">
                <div class="inner_sm">
                    <div class="section_content element translateup" id="contact">
                        <h3 class="ttl">Let's <span>get in touch</span></h3>
                        <div class="cont_contents ">
                            <?php dynamic_sidebar( 'contact-infomation' ); ?>
                            <div class="cont_right">
                                <?php echo do_shortcode( '[contact-form-7 id="17" title="Contact Form"]'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
<?php get_footer(); ?>
