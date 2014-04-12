<?php
/**
 * @file petition.php
 * Logic, submission form and signatories list for a petition using a custom
 * page template. Most of this code was re-factoring from a standalone PHP
 * application supplied by Michael Hawley.
 * @author Alister Lewis-Bowen <alister@different.com>
 * @license GPL-v2
 * @version 1.0
 */

$temp_query = $wp_query;
$_petition_name = $post->post_name;
$_petition_entries_file = '';
$_petition_entries_file_lines = '';
$_petition_entries = 0;
$_petition_pages = 1;

# TODO: Potential configuration vars to pull out into admin form at future date
$_petition_entries_file_prefix = '';
$_petition_safe_tags = '<a><em><strong><b><i><img><u>';
$_petition_unsafe_attr = 'javascript:|onclick|ondblclick|onmousedown|onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|onkeydown|onkeyup|style|class|id';
$_petition_spam_terms = '{(pdfs|drugs|nikaxywotaqo|pharmapdf|medicpdf|pdf.com)}';
$_petition_dateFormat = 'D j M Y';
$_petition_timeFormat = 'g:i a';
$_petition_entry_format = '
        <div class="entry">
            <div class="name">%%signername%% </div><br/>
            <div class="address">%%address%%</div>
            <div class="date">%%date%% %%time%%</div>
            <p/><div class="message">%%message%%</div><p/>
        </div>';
$_petition_email_format = '<a class="off" href="mailto:%%email%%" title="mail %%email%%">%%signername%%</a>';

function petitionEntriesFile($petitionName) {
    global $_petition_entries_file_dir,
           $_petition_entries_file,
           $_petition_entries_file_lines,
           $_petition_entries;
    $_petition_entries_file = $_petition_entries_file_dir . $petitionName .'-entries.txt';
    $_petition_entries_file_lines = file($_petition_entries_file);
    $_petition_entries = count($_petition_entries_file_lines);
}

function petitionSafeAttributes($tagSource) {
  global $_petition_unsafe_attr;
  return stripslashes(preg_replace("/$_petition_unsafe_attr/i", 'forbidden', $tagSource));
}

function petitionSafeTags($source) {
    global $_petition_safe_tags;
    $source = strip_tags($source, $_petition_safe_tags);
    return preg_replace('/<(.*?)>/ie', "'<'.petitionSafeAttributes('\\1').'>'", $source);
}

function petitionBlank($s) { return ereg("^[ \n\r\t]*$", $s); }

function petitionSpam($s) { return preg_match("/$_petition_spam_terms/i", $s); }

# TODO: Why? Seems to insert a space at 60th char of a word over 60 chars
#       A proper word wrap would use the PHP wordwrap function
function petitionWordWrap($message) {
    $maxLength = 60;
    $cut = ' ';
    $result = '';
    $wordlength = 0;
    $length = strlen($message);
    $tag = FALSE;

    for ($i = 0; $i < $length; $i++){
        $char = substr($message, $i, 1);
        if ($char == '<') { $tag = TRUE; }
        elseif ($char == '>') { $tag = FALSE; }
        elseif (!$tag && $char == ' ') { $wordlength = 0; }
        elseif (!$tag) { $wordlength++; }
        if (!$tag && !($wordlength%$maxLength)) { $char .= $cut; }
        $result .= $char;
    }
    return $result;
}

function petitionProcessEntry() {
    if (empty($_POST['message'])) {
        # TODO: Empty message?
    }
    else {
        global $_petition_etries_file,
               $_petition_entry_format,
               $_petition_email_format,
               $_petition_dateFormat,
               $_petition_timeFormat;

        petitionEntriesFile($_POST['petition_name']);

        $message = stripslashes($_POST['message']);
        $message = petitionWordWrap(petitionSafeTags($message));
        $message = str_replace(array('&', "\r\n\r\n"),
            array('&amp;', '</p><p>'), $message);
        $message = str_replace(array('&amp;gt;', '&amp;lt;', "\r\n"),
            array('&gt;', '&lt;', '<br />'), $message);
        $signername = strip_tags(stripslashes($_POST['signername']));
        $address = strip_tags(stripslashes($_POST['address']));
        $email = urlencode(strip_tags(stripslashes($_POST['email'])));
        $email = str_replace("%40","@",$email);

        $vars = array("\n", '%%signername%%', '%%email%%', '%%address%%',
            '%%message%%', '%%date%%', '%%time%%');
        $inputs = array('', $signername, $email, $address, $message,
            date($_petition_dateFormat), date($_petition_timeFormat));

        $formatted = $_petition_entry_format;
        if (!petitionBlank($email)) {
            $formatted = str_replace("%%signername%%",
                $_petition_email_format, $formatted);
        }
        $formatted = str_replace($vars, $inputs, $formatted);

        if (!petitionSpam($formatted)) {
            print $formatted;
            return;
            $content = '';
            $fs = filesize($_petition_entries_file);
            if ($fs > 0) {
                $oldEntries = fopen($entryFile, 'r');
                $content = fread($oldEntries, $fs);
                fclose($oldEntries);
            }
            $newContent = $formatted ."\n". $content;
            $allEntries = fopen($entryFile, 'w');
            fwrite($allEntries, $newContent);
            fclose($allEntries);
        }
        print 'ALL DONE';
    }
}

function petitionSigners() {
    global $_petition_entries;
    printf("%d",$_petition_entries);
}

function petitionPages() {
    global $_petition_name,
           $_petition_entries,
           $_petition_pages;

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
    global $_petition_entries_file_lines,
           $_petition_entries;

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

petitionEntriesFile($_petition_name);
if ($_GET['petition']) petitionProcessEntry();

?>
<div id="<?php print $_petition_name; ?>_petition" class="petition inside clearfix">
    <form method="post" action="?petition=sign#<?php print $_petition_name; ?>_petition">
        <input type="text"  name="signername" placeholder="Your name" autocomplete="off" tabindex="1">
        <input type="text" name="email" placeholder="Your email address" autocomplete="off" tabindex="2">
        <input type="text" name="address" placeholder="Your home address" autocomplete="off" tabindex="3">
        <textarea name="message" placeholder="Your comments" tabindex="5"></textarea>
        <input type="hidden" name="petition_name" value="<?php print $_petition_name; ?>">
        <input type="submit" name="submit" tabindex="6" value="Sign the petition!">
    </form>
    <div class="petition_entries_book">
        <p class="pager"><strong><?php petitionSigners(); ?></strong> signatories.<br/><?php petitionPages() ?></p>
        <?php petitionBook() ?>
        <p class="pager"><strong><?php petitionSigners(); ?></strong> signatories.<br/><?php petitionPages() ?></p>
    </div>
</div>
<?php $wp_query = $temp_query; ?>
