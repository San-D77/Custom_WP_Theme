<?php 
$post_id = get_the_ID();
$fact_keys = [
    'established',
    'first-season',
    'stadium',
    'headquarters',
    'owner',
    'chairman',
    'ceo',
    'president',
    'general-manager',
    'head-coach',
    'previously-known-as',
    'championships',
    'super-bowls'
];

function slugToPascal($string)
{
    // This function converts a string from camelCase to snake_case.
    return ucwords(str_replace('-', ' ', $string));
}

?>

<table class="team-facts">
    <tbody>

        <?php foreach ($fact_keys as $fact_key) : ?>
            <?php if (get_post_meta($post_id, $fact_key, true)) :  ?>
                <tr class="single-fact">
                    <td class="fact-key"><?php echo slugToPascal($fact_key) ?></td>
                    <td class="fact-value"><?php echo  get_post_meta($post_id, $fact_key, true); ?></td>
                </tr>
            <?php endif ?>
        <?php endforeach ?>
    </tbody>
</table>