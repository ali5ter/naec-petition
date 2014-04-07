    <?php $temp_query = $wp_query; ?>

    <?php $section_name = $post->post_name; ?>

    <?php

    $file = $section_name .'-entries.txt';
    $lines = file($file);
    $entries = count($lines);
    $numPages = 1;

    function numsigners(){
        global $entries;
        printf("%d",$entries);
    }

    function numpages(){
        global $entries, $numPages;
        if(!$_SERVER['QUERY_STRING']) { $n = 1; }
        else { $n = $_GET['n']; }
        $d = $entries / 10;
        $f = floor($d);
        $numPages = ($d == $f)? $f : $f + 1;
        if ($n > 1) { echo '<a href="?n='.($n - 1).'">&#9669;</a> '; }
        for ($i = 1; $i <= $numPages; $i++) {
            if ($i == $n) { echo $i.' '; }
            else { echo '<a href="?n='.$i.'">'.$i.'</a> '; }
        }
        if ($n < $numPages) { echo '<a href="?n='.($n + 1).'">&#9659;</a> '; }
    }

    function showbook(){
        global $lines,$entries;
        $n = (!$_SERVER['QUERY_STRING'])? 1 : $_GET['n'];
        $min = 10 * ($n - 1);
        $max = 10 * $n - 1;

        foreach($lines as $i => $line){
            if ($i > $max) break;
            if ($i >= $min){
                $entryNum = $entries - $i;
                echo $line;
            }
        }
    }

    ?>

    <div id="navigate"><b><? numsigners(); ?></b> signatories.<br>page: <? numpages() ?></div>
    <? showbook() ?>
    <div id="navigate"><b><? numsigners(); ?></b> signatories.<br>page: <? numpages() ?></div>

    <div class=sign><s>Sign the petition.</s>
    <p>
    <a name="write"></a>
    Write your message here and push <b>Sign!</b> to post it.
    (<a href="mailto:info@NAeastcambridge.org">Mail us</a> if you have any difficulties.)
    </div>

    <div class="entry">
    <form method="post" action="<?= $PHP_SELF ?>">
    <div class="spacer"></div>
    <label>name:</label><input type="text" name="signername" />
    <div class="spacer"></div>
    <label>email:</label><input type="text" name="email" />
    <div class="spacer"></div>
    <label>address:</label><input type="text" name="address" />
    <div class="spacer"></div>
    <label>message:</label><textarea name="message" rows="5" cols="20"></textarea>
    <input type="hidden" name="bookurl" value="/petition/index.php" />
    <div class="spacer"></div>
    <div id="submit"><input type="submit" name="submit" value="Sign!" class="submit" onmouseover="this.className='submit btnhov'" onmouseout="this.className='submit'"/></div>
    </form>
    </div>

    <?php $wp_query = $temp_query; ?>
