<div class="header-search">
    <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
        <input type="search" class="search-field" value="<?php echo get_search_query(); ?>" name="s" />
        <button type="submit" class="search-submit">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>