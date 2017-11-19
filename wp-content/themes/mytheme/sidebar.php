<?php dynamic_sidebar('ad'); ?>

<?php
  $location_name = 'pickup';
  $locations = get_nav_menu_locations();

  // var_dump($locations);
  // exit;

  $myposts = wp_get_nav_menu_items($locations[$location_name]);
  if ($myposts) : ?>

<aside class="mymenu mymenu-large">
  <h2>おすすめ記事</h2>
  <ul>
    <?php foreach($myposts as $post):
       if ($post->object == 'post'):
       $post = get_post($post->object_id);
       setup_postdata($post); ?>
      <li>
        <a href="<?php the_permalink(); ?>">
          <div class="thumb" style="background-image: url(<?php echo mythumb('medium'); ?>)"></div>
          <div class="text">
            <?php the_title(); ?>
          </div>
        </a>
      </li>
    <?php endif; endforeach; ?>
  </ul>
</aside>
<?php wp_reset_postdata(); endif; ?>

<?php
  $myposts = get_posts( array(
    'post_type' => 'post',
    `posts_per_page` =>'6',
    'meta_key' => 'postviews',
    'orderby' => 'meta_value_num',
  ));
  if ($myposts) : ?>
<aside class="mymenu mymenu-thumb">
  <h2>最新記事</h2>
  <ul>
  <?php
    $args = array(
      'posts_per_page' => 5 // 表示件数の指定
    );
    $posts = get_posts( $args );
    foreach ( $posts as $post ): // ループの開始
    setup_postdata( $post ); // 記事データの取得
  ?>
  <li>
    <a href="<?php the_permalink(); ?>">
      <div class="thumb" style="background-image: url(<?php echo mythumb('thumbnail'); ?>)"></div>
      <div class="text">
        <?php the_title(); ?>
        <?php if (has_category()) : ?>
          <?php $postcat = get_the_category(); ?>
          <?php
            // カテゴリーにリンクをつける
            $category_id = get_cat_ID( $postcat[0]->name );
            $category_link = get_category_link($category_id);
            // var_dump($category_link);
            // exit;
          ?>
          <span>
            <?php echo $postcat[0]->name; ?>
            <!-- <a href="<?php echo esc_url( $category_link ); ?>"><?php echo $postcat[0]->name; ?></a> -->
            <time datetime="<?php the_time('c'); ?>">投稿日:<?php echo get_the_date(); ?></time>
          </span>
        <?php endif; ?>
      </div>
    </a>
  </li>
  <?php
    endforeach; // ループの終了
    wp_reset_postdata(); // 直前のクエリを復元する
  ?>
  </ul>
</ul>
</aside>
<aside class="mymenu mymenu-thumb">
  <h2>人気記事</h2>
  <ul>
    <?php foreach($myposts as $post): setup_postdata($post); ?>
      <li>
        <a href="<?php the_permalink(); ?>">
        <div class="thumb" style="background-image: url(<?php echo mythumb('thumbnail'); ?>)"></div>
        <div class="text">
          <?php the_title(); ?>
          <?php if (has_category()) : ?>
            <?php $postcat = get_the_category(); ?>
            <span>
              <?php echo $postcat[0]->name; ?>
              <time datetime="<?php the_time('c'); ?>">投稿日:<?php echo get_the_date(); ?></time>
            </span>
          <?php endif; ?>
        </div>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</aside>
<?php wp_reset_postdata(); endif; ?>
<?php dynamic_sidebar('submenu'); ?>

<!-- 月別アーカイブリスト -->
<?php
  // my_get_archives_link("http://wocker.dev/2017/03/");
  // add_nen_year_archives();
?>
