<?php get_header(); ?>

<div class="sub-header">
  <div class="container">
    <div class="ad1">
      <p><img src="" width=320 height="50" ></p>
    </div>
  </div>
<div class="bread">
  <ol>
    <li>
      <a href="<?php echo esc_url(home_url()); ?>"><i class="fa fa-home"></i><span>TOP</span></a>
    </li>
    <li>
      <?php if ( has_category()) : ?>
        <?php $postcat = get_the_category(); ?>
        <?php echo esc_html( get_category_parents( $postcat[0], true, '</li><li>') ); ?>
      <?php endif; ?>
      <a><?php the_title(); ?></a>
    </li>
</ol>
</div>
</div>

<div class="container">
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
              <?php echo  get_post( get_post_thumbnail_id() )->post_excerpt; ?>
            </p>
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

      </article>
    <?php endwhile; endif; ?>
  </div>

  <div class="sub">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>
