<div class="control-group">
    <label class="control-label">
        <form action="category.php" method="post">
            <input type="hidden" name="categoryID" value="{ID}">
            <input type="hidden" name="bookID" value="{BOOK_ID}">
            <input type="hidden" name="action" value="delFromBook">
            <button type="submit" class="btn btn-danger btn-mini">
                <icon class="icon-remove icon-white"></icon>
                удалить
            </button>
        </form> 
    </label>
    <div class="controls">
        {name}
    </div>
</div>