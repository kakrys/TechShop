<?php
/**
 * @var \Up\Models\Tag[] $tags
 */
?>
<nav class="toolbar">
	<ul class="toolbar__list">
		<li class="toolbar__item" data-tab-Index="0">
			<a href="/catalog/all/1/" class="toolbar__btn">
				<img src="/assets/images/tags/all.svg" alt="all category" class="toolbar__img">
				<p class="toolbar__category">All</p>
			</a>
		</li>
        <?php foreach($tags as $tag):?>
		<li class="toolbar__item" data-tab-Index="1">
			<a href="/catalog/<?=$tag->getTitle()?>/1/" class="toolbar__btn">
				<img src="/assets/images/tags/<?=$tag->getId()?>.svg" alt="mobile category" class="toolbar__img">
				<p class="toolbar__category"><?=$tag->getTitle()?></p>
			</a>
		</li>
        <?php endforeach;?>

		<li class="toolbar__line"></li>
	</ul>
</nav>
