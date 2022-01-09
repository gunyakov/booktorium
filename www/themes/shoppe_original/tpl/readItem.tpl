<div class="heading-bar">
    <h2><a href="showBook.php?id={ID}">{name}</a> -> <strong><a href="read.php?id={ID}&file={FILE_ID}">{fileName}</a></strong></h2>
    <span class="h-line"></span>
</div>
<!-- Start Main Content -->
<section class="span9 first">
    <!-- Breadcrumbs End -->
    <div class="product_sort">
        <div class="row-1">
            <div class="left">
                {LANG_PAGE} {NUMPAGE_CURRENT} из {pages}
            </div>
            <div class="right">
                
            </div>
        </div>
    </div>
    {READ_CONTENT}
    <hr />
    <div class="blog-footer">
        {PAGINATION_CONTENT}
    </div>
</section>