<form action="print.php" method="post">
    <div class="control-group">
        <label class="control-label">
            <input type="hidden" name="printID" value="{ID}">
            <input type="hidden" name="bookID" value="{BOOK_ID}">
            <input type="hidden" name="action" value="delFromBook">
            <button type="submit" class="btn btn-danger btn-mini">
                <icon class="icon-remove icon-white"></icon>
                удалить
            </button> </label>

        <div class="controls">
    	{name}, {city}
        </div>
    </div>
</form>
