<?php

$networks=(array) $social->links;

$shareLinks=array();

foreach ($networks as $network) {
    if (!empty($network['share']))
        $shareLinks[]=$network;
}

if (empty($shareLinks))
    return;

?>
<ul class="share-links" id="share-buttons">
    <?php foreach ($shareLinks as $network): ?>
        	<li id="<?php echo $network->share->cssClass?>" class="share-button social-button <?php echo $network->share->cssClass?>">
                <?php echo str_replace('{$url}',$this->vars->url,$network->share->widget->literal()); ?>
            </li>
    <?php endforeach; ?>
</ul>
