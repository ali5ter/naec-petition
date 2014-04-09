<?php
$temp_query = $wp_query;

$_petition_name = $post->post_name;
$_petition_entries_file = $_petition_name .'-entries.txt';
$_petition_entries_file_lines = file($_petition_entries_file);
$_petition_entries = count($_petition_entries_file_lines);
$_petition_pages = 1;
$_petition_dateFormat = 'D j M Y';
$_petition_timeFormat = 'g:i a';

if ($_GET['petition']) petitionEntry();

function petitionEntry() {
    # TODO: Process POST request
}

function petitionSigners() {
    global $_petition_entries;
    printf("%d",$_petition_entries);
}

function petitionPages() {
    global $_petition_name, $_petition_entries, $_petition_pages;

    if(empty($_GET['n'])) { $n = 1; }
    else { $n = $_GET['n']; }

    $d = $_petition_entries / 10;
    $f = floor($d);
    $_petition_pages = ($d == $f)? $f : $f + 1;
    $anchor = '#'.$_petition_name.'_petition';

    if ($n > 1) { echo '<a class="first" href="?n='.($n - 1).$anchor.'">&#9669;</a> '; }

    for ($i = 1; $i <= $_petition_pages; $i++) {
        if ($i == $n) { echo '<span class="selected">'.$i.'</span> '; }
        else { echo '<a href="?n='.$i.$anchor.'">'.$i.'</a> '; }
    }

    if ($n < $_petition_pages) { echo '<a class="last" href="?n='.($n + 1).$anchor.'">&#9659;</a> '; }
}

function petitionBook() {
    global $_petition_entries_file_lines, $_petition_entries;

    $n = (empty($_GET['n']))? 1 : $_GET['n'];
    $min = 10 * ($n - 1);
    $max = 10 * $n - 1;

    foreach($_petition_entries_file_lines as $i => $line) {
        if ($i > $max) break;
        if ($i >= $min) {
            $entryNum = $_petition_entries - $i;
            echo $line;
        }
    }
}

?>
<div id="<?php print $_petition_name; ?>_petition" class="petition inside clearfix">
    <form method="post" action="?petition=sign#<?php print $_petition_name; ?>_petition">
        <input type="text"  name="signername" placeholder="Your name" autocomplete="off" tabindex="1">
        <input type="text" name="email" placeholder="Your email address" autocomplete="off" tabindex="2">
        <input type="text" name="address" placeholder="Your home address" autocomplete="off" tabindex="3">
        <textarea name="message" placeholder="Your comments" tabindex="5"></textarea>
        <input type="hidden" name="petition" value="<?php print $_petition_name; ?>">
        <input type="submit" name="submit" tabindex="6" value="Sign the petition!">
    </form>
    <div class="petition_entries_book">
        <p class="pager"><strong><?php petitionSigners(); ?></strong> signatories.<br/><?php petitionPages() ?></p>
        <?php petitionBook() ?>
        <p class="pager"><strong><?php petitionSigners(); ?></strong> signatories.<br/><?php petitionPages() ?></p>
    </div>
</div>
<?php $wp_query = $temp_query; ?>
