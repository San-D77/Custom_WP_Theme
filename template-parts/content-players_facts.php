<?php

$post_id = get_the_ID();

$birth_year = get_post_meta($post_id, "birth-year", true);
$birth_day = get_post_meta($post_id, "birth-day", true);
$birth_month = get_post_meta($post_id, "birth-month", true);
$death_day = get_post_meta($post_id, "death-day", true);
$death_month = get_post_meta($post_id, "death-month", true);
$death_year = get_post_meta($post_id, "death-year", true);

function calculateAge($birth_day, $birth_month, $birth_year, $death_day = null, $death_month = null, $death_year = null)
{
    $months = ['January'=>1, 'February'=>2,'March'=>3,'April'=>4,'May'=>5,'June'=>6,
    'July'=>7,'August'=>'8','September'=>9,'October'=>10,'November'=>11,'December'=>12 ];

    $today = new DateTime();

    if(!$birth_month){
        $birth_month = '01';
    }else{
        $birth_month = $months[$birth_month];
    }

    if(!$birth_day){
        $birth_day = '01';
    }
    
    $birth_date = new DateTime("$birth_year-$birth_month-$birth_day");
    
    if (!$death_year) {      
        $age = $today->diff($birth_date)->y;
    }else{

        if(is_numeric($death_year)){
            if(!$death_month){
                $death_month = '01';
            }else{
                $death_month = $months[$death_month];
            }
            if(!$death_day){
                $death_day = '01';
            }

            $death_date = new DateTime("$death_year-$death_month-$death_day");
            $age = $death_date->diff($birth_date)->y;
        }

    }
    if($age > 1){
        return $age . " years";
    }else{
        return $age. " year";
    }
}


$fact_keys = [
    'birthday',
    'death',
    'age',
    'height',
    'weight',
    'college',
    'draft-year',
    'draft-info',
    'retired-year'
];

function slugToPascal($string)
{
    // This function converts a string from camelCase to snake_case.
    return ucwords(str_replace('-', ' ', $string));
}

?>

<table class="player-facts">
    <tbody>

        <?php foreach ($fact_keys as $fact_key) : ?>
            <?php if ($fact_key == 'birthday') : if ($birth_year) : ?>
                    <tr class="single-fact">
                        <td class="fact-key">Birthday</td>
                        <td class="fact-value">
                            <?php 
                                if($birth_month && $birth_day):
                                    echo $birth_month .' '. $birth_day . ', ' . $birth_year;
                                elseif($birth_month):
                                    echo $birth_month . ' ' . $birth_year;
                                else:
                                    echo $birth_year;
                                endif
                            ?>
                        </td>
                    </tr>
            <?php endif;
            endif; ?>
            <?php if ($fact_key == 'death') : if ($death_year) : ?>
                    <tr class="single-fact">
                        <td class="fact-key">Death</td>
                        <td class="fact-value">
                            <?php 
                                if($death_month && $death_day):
                                    echo $death_month .' '. $death_day . ', ' . $death_year;
                                elseif($death_month):
                                    echo $death_month . ' ' . $death_year;
                                else:
                                    echo $death_year;
                                endif
                            ?>
                        </td>
                    </tr>
            <?php endif;
            endif; ?>
            <?php if ($fact_key == "age") : ?>
                <?php if ($birth_year) : ?>
                    <tr class="single-fact">
                        <td class="fact-key">Age</td>
                        <td class="fact-value">
                            <?php
                            echo calculateAge($birth_day, $birth_month, $birth_year, $death_day, $death_month, $death_year);
                            ?>
                        </td>
                    </tr>
                <?php endif ?>
            <?php endif ?>
            <?php if (get_post_meta($post_id, $fact_key, true)) :  ?>
                <tr class="single-fact">
                    <td class="fact-key"><?php echo slugToPascal($fact_key) ?></td>
                    <td class="fact-value"><?php echo  get_post_meta($post_id, $fact_key, true); ?></td>
                </tr>
            <?php endif ?>
        <?php endforeach ?>
    </tbody>
</table>