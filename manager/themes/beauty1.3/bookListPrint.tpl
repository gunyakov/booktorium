<form action="printEdit.php?id={PRINT_ID}" method="post">
    <div class="control-group">
        <label class="control-label">
            <input type="hidden" name="bookID" value="{ID}">
            <input type="hidden" name="action" value="linkPrint">
            <button type="submit" class="btn btn-add-page btn-mini">
                <icon class="icon-remove icon-white"></icon>
                Выполнить
            </button> </label>
        <div class="controls">
            {name}
        </div>
        <div class="controls">
            <select name="printTo">
                <option value="-1">Удалить</option>
                {PRINT_LIST_CONTENT}
            </select>
        </div>
    </div>
</form>
