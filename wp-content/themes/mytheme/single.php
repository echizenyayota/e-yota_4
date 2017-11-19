<?php get_header(); ?>

<div class="sub-header">
  <div class="ad1">
    <p><img src="" width=320 height="50" ></p>
  </div>
<div class="bread">
  <ol>
    <li>
      <a href="<?php echo esc_url( home_url() ); ?>"><i class="fa fa-home"></i><span>TOP</span></a>
    </li>
    <li>
      <?php if ( has_category()) : ?>
        <?php $postcat = get_the_category(); ?>
        <?php echo get_category_parents( $postcat[0], true, '</li><li>'); ?>
      <?php endif; ?>
      <a><?php the_title(); ?></a>
    </li>
</ol>
</div>
</div>

<div class="container">
  <div class="default_thumbnail">
    <?php
    // http://kachibito.net/wordpress/custom/saving-a-default-post-thumbnail.html
    // if (has_post_thumbnail()) {
    //   the_post_thumbnail();
    // }else {
    //   echo '<img src="' . get_bloginfo('template_directory') . '/ecoteki-image.png' . '" width="592" height="400" alt="thumbnail" />';
    // }
  ?>
  </div>
  <div class="contents">
    <?php if (have_posts()): while(have_posts()): the_post(); ?>
      <article <?php post_class('kiji'); ?>>

        <div class="kiji-tag">
          <?php the_tags('<ul><li>', '</li><li>','</li></ul>'); ?>
        </div>

        <h1><?php the_title(); ?></h1>

        <div class="kiji-date">
          <i class="fa fa-pencil"></i>
          <time datetime="<?php the_time('c'); ?>">
            投稿日:<?php echo get_the_date(); ?>
          </time>
          <?php if (get_the_modified_date( 'Y-m-d' ) > get_the_date( 'Y-m-d' )) : ?>
            |
          <time datetime="<?php echo get_the_modified_date( 'Y-m-d' ); ?>">
            更新日:<?php echo get_the_modified_date(); ?>
          </time>
          <?php endif; ?>
        </div>

        <?php if (has_post_thumbnail()) : ?>
          <div class="catch">
            <?php the_post_thumbnail( 'large' ); ?>
            <p class="wp-caption-text">
              <?php
                $post_thumbnail_id = get_post_thumbnail_id();
                if($post_thumbnail_id) {
                  echo get_post( $post_thumbnail_id )->post_excerpt;
                 }
                ; ?>
            </p>
          </div>
        <?php else: ?>
          <div class="catch">
            <?php echo '<img src="' . get_bloginfo('template_directory') . '/ecoteki-image.png' . '" width="592" height="400" alt="thumbnail" />'; ?>
          </div>
        <?php endif; ?>

        <div class="kiji-body">
          <?php the_content(); ?>
        </div>

        <div class="google-ad">
          <div class="ad2">
            <p><img src="" width=300 height="250"></p>
          </div>
          <div class="ad3">
            <p><img src="" width=300 height="250"></p>
          </div>
        </div>

        <div class="share">
          <ul>
            <li>
              <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( get_the_title() . ' - ' . get_bloginfo('name') ); ?>&amp;url=<?php echo urlencode( get_permalink() ); ?>&amp;via=echizenya_yota"
            	onclick="window.open(this.href, 'SNS', 'width=500, height=300, menubar=no, toolbar=no, scrollbars=yes'); return false;" class="share-tw">
                <i class="fa fa-twitter"></i>
                <span>Twitterでシェア</span>
              </a>
            </li>
            <li>
              <a href="http://www.facebook.com/share.php?u=<?php echo urlencode( get_permalink() ); ?>"
            	onclick="window.open(this.href, 'SNS', 'width=500, height=500, menubar=no, toolbar=no, scrollbars=yes'); return false;" class="share-fb">
                <i class="fa fa-facebook"></i>
                <span>Facebookでシェア</span>
              </a>
            </li>
            <li>
              <a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink() ); ?>" onclick="window.open(this.href, 'SNS', 'width=500, height=500, menubar=no, toolbar=no, scrollbars=yes'); return false;" class="share-gp">
                <i class="fa fa-google-plus"></i>
                <span>Google+でシェア</span>
              </a>
            </li>
          </ul>
        </div>

        <?php
          if (has_category()) {
            $cats = get_the_category();
            $catkwds = [];
            foreach ($cats as $cat) {
              $catkwds = $cat->term_id;
            }
          }
         ?>
        <?php
          $myposts = get_posts( array(
            'post_type' => 'post',
            'posts_per_page' =>'4',
            'post__not_in' => array($post->ID),
            'category__in' => $catkwds,
            'orderby' => 'rand',
          ));
          if ($myposts) : ?>

        <aside class="mymenu mymenu-thumb mymenu-related">
          <h2>関連記事</h2>
          <ul>
            <?php foreach($myposts as $post): setup_postdata($post); ?>
              <li>
                <a href="<?php the_permalink(); ?>">
                <div class="thumb" style="background-image: url(<?php echo mythumb('thumbnail'); ?>)"></div>
                <div class="text">
                  <?php the_title(); ?>
                </div>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </aside>
        <?php wp_reset_postdata(); endif; ?>

      </article>
    <?php endwhile; endif; ?>
  </div>

  <div class="sub">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>

<?php // アクセス数の記録(ログインしているユーザーは除外)
  if (!is_user_logged_in() ) {
    $count_key = 'postviews';
    $count = get_post_meta($post->ID, $count_key, true);
    $count++;
    update_post_meta($post->ID, $count_key, $count);
  }
?>
