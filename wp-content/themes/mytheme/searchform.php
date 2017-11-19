<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="<?php echo $unique_id; ?>">
        <span class="screen-reader-text">検索</span>
    </label>
    <input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="検索" value="<?php the_search_query(); ?>" name="s" />
    <button type="submit" class="search-submit">検索<span class="screen-reader-text">検索</span></button>
</form>
