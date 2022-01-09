<!-- Start Grid View Section -->
<div class="product_sort">
	<div class="row-1">
		<div class="left">
			<form action="showCategory.php?id={CATEGORY_ID}&view={VIEW}" method="post">
				<span class="s-title">Сортировать по</span>
				<span class="list-nav">
					<select name="sort">
						<option value="rating">рейтингу</option>
						<option value="date">дате добавления</option>
						<option value="name">названию</option>
						<option value="year">году издания</option>
						<option value="download">кол-ву скачиваний</option>
					</select> &nbsp;&nbsp;
					<button type="submit" class="more-btn">
						Вперед!
					</button> </span>
			</form>
		</div>
	</div>
	<div class="row-2">
		<span class="left">Книги с {itemsStart} по {itemsEnd} из {itemsTotal} всего</span>
		<ul class="product_view">
			<li>
				Показать как:
			</li>
			<li>
				<a class="grid-view" href="showCategory.php?id={CATEGORY_ID}&view=grid&page={NUMPAGE_CURRENT}&sort={SORT}">сетку</a>
			</li>
			<li>
				<a class="list-view" href="showCategory.php?id={CATEGORY_ID}&view=list&page={NUMPAGE_CURRENT}&sort={SORT}">список</a>
			</li>
		</ul>
	</div>
</div>
<section class="grid-holder features-books">
	{VIEW_ITEM}
</section>
<div class="blog-footer">
	{PAGINATION_CONTENT}

	<ul class="product_view">
		<li>
			Показать как:
		</li>
		<li>
			<a class="grid-view" href="showCategory.php?id={CATEGORY_ID}&view=grid&page={NUMPAGE_CURRENT}">сетку</a>
		</li>
		<li>
			<a class="list-view" href="showCategory.php?id={CATEGORY_ID}&view=list&page={NUMPAGE_CURRENT}">список</a>
		</li>
	</ul>
</div>
<!-- End Grid View Section -->