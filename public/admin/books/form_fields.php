<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($book)) {
    redirect_to(url_for('/book/books/index.php'));
}
?>



<div class="form-group">
    <label for="bookTitle">Title</label>
    <input type="text" class="form-control" id="bookTitle" name="book[title]" value="<?php echo h($book->title); ?>" placeholder="Book title">
</div>

<div class="form-group">
    <label for="bookAuthor">Author</label>
    <input type="text" class="form-control" id="bookAuthor" name="book[author]" value="<?php echo h($book->author); ?>" placeholder="Book author">
</div>

<div class="form-row">
    <div class="col">
        <label for="bookTitle">Year</label>
        <input type="number" class="form-control" id="bookTitle" name="book[year]" placeholder="Year released" value="<?php echo h($book->year); ?>">
    </div>
    <div class="col">
        <label for="bookPages">Pages</label>
        <input type="number" class="form-control" id="bookPages" name="book[pages]" placeholder="Number of pages" value="<?php echo h($book->pages); ?>">
    </div>
</div>

<div class="form-group">
    <label for="bookDescription">Description</label>
    <textarea name="book[description]" class="form-control" id="bookDescription" rows="3"><?php echo h($book->description); ?></textarea>
</div>