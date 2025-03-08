<?php 
$fact_keys = [
    ['title'=>'birth-month', 'searchable' => 1],
    ['title'=>'birth-year', 'searchable' => 1],
    ['title' =>'birthplace', 'searchable' => 1],
    ['title'=>'death-month', 'searchable' => 1],
    ['title'=>'death-year', 'searchable' => 1],
    ['title'=>'age', 'searchable' => 0],
    ['title'=>'partner', 'searchable' => 0],
    ['title'=>'husband', 'searchable' => 0],
    ['title'=>'boyfriend', 'searchable' => 0],
    ['title'=>'son', 'searchable' => 0],
    ['title'=>'brother', 'searchable' => 0],
    ['title'=>'father', 'searchable' => 0],
];

$post_id = get_the_ID();
$has_facts = false;

// Check if any fact field has a value
foreach ($fact_keys as $fact_key) {
    if (get_post_meta($post_id, $fact_key['title'], true)) {
        $has_facts = true;
        break;
    }
}

// If there are facts, render the TOC and facts table
if ($has_facts): 
?>
    <div id="table-of-contents">
        <!-- TOC content here -->
    </div>

    <div class="facts">
        <table class="table facts">
            <tbody>
                <?php 
                $birthFound = 0;
                $deathFound = 0; 
                foreach ($fact_keys as $fact_key):
                    $fact_value = get_post_meta($post_id, $fact_key['title'], true); 
                    if ($fact_value):
                        if ($fact_key['title'] == 'birth-month' || $fact_key['title'] == 'birth-year'):
                            if ($birthFound == 0):
                                $birthFound = 1;
                ?>
                                <tr class="single-fact">
                                    <td class="fact-key">Birthday</td>
                                    <td class="fact-value">
                                        <?php
                                        $birth_year = get_post_meta($post_id, "birth-year", true);
                                        $birth_month = get_post_meta($post_id, "birth-month", true);
                                        $birth_day = get_post_meta($post_id, "birth-day", true);
                                        ?>
                                        <?php if ($birth_day && $birth_month): ?>
                                            <?php echo $birth_month; ?>
                                            <?php echo ($birth_day ? $birth_day . ', ' : ''); ?>
                                        <?php else: ?>
                                            <?php echo $birth_month; ?>
                                        <?php endif; ?>
                                        <?php echo $birth_year; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php elseif ($fact_key['title'] == 'death-month' || $fact_key['title'] == 'death-year'):
                            if ($deathFound == 0):
                                $deathFound = 1;
                        ?>
                                <tr class="single-fact">
                                    <td class="fact-key">Death</td>
                                    <td class="fact-value">
                                        <?php $death_month = get_post_meta($post_id, "death-month", true); echo $death_month; ?>
                                        <?php $death_day = get_post_meta($post_id, "death-day", true); echo ($death_day ? $death_day . ', ' : ''); ?>
                                        <?php $death_year = get_post_meta($post_id, "death-year", true); echo $death_year; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if ($fact_key['title'] == 'partner' || $fact_key['title'] == 'husband' || $fact_key['title'] == 'boyfriend' || $fact_key['title'] == 'son' || $fact_key['title'] == 'brother'): ?>
                                <tr class="single-fact">
                                    <td class="fact-key"><?php echo slugToPascal($fact_key['title']); ?></td>
                                    <td class="fact-value">
                                        <?php $link_value = get_post_meta($post_id, 'link', true); if ($link_value): ?>
                                            <a style="color: #4da7df" href="<?php echo $link_value; ?>">
                                                <?php echo $fact_value; ?>
                                            </a>
                                        <?php else: ?>
                                            <?php echo $fact_value; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <tr class="single-fact">
                                    <td class="fact-key"><?php echo slugToPascal($fact_key['title']); ?></td>
                                    <td class="fact-value"><?php echo $fact_value; ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php elseif ($fact_key['title'] == "age"):
                        if (isset($birth_year) && is_numeric($birth_year)): 
                    ?>
                        <tr class="single-fact">
                            <td class="fact-key">Age</td>
                            <td class="fact-value">
                                <?php 
                                $birth_day = isset($birth_day) ? $birth_day : null;
                                $birth_month = isset($birth_month) ? $birth_month : null;
                                $death_day = isset($death_day) ? $death_day : null;
                                $death_month = isset($death_month) ? $death_month : null;
                                $death_year = isset($death_year) ? $death_year : null;
                                $a = calculateAge($birth_day, $birth_month, $birth_year, $death_day, $death_month, $death_year);
                                echo $a; 
                                ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
