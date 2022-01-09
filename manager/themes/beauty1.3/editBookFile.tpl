<form action="file.php" method="post">
    <div class="control-group">
        <label class="control-label">
            <input type="hidden" name="fileID" value="{ID}">
            <input type="hidden" name="bookID" value="{BOOK_ID}">
            <input type="hidden" name="action" value="delFromBook">
            <button type="submit" class="btn btn-danger btn-mini">
                <icon class="icon-remove icon-white"></icon>
                удалить
            </button> </label>

        <div class="controls">
            {fileName} {fileSize}, pages: {pages}&nbsp;
            <input type="checkbox" name="forceDel" value="yes">
            Удалить принудительно</input>
        </div>
    </div>
</form>