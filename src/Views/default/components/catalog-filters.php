<?php
/**
 * @var \Up\Models\Brand[] $brandArray
 * @var array $activeBrands
 * @var string $tagName
 * @var $sortBy
 */
?>
<form action="/catalog/<?=$tagName?>/1/" method="post">
	<aside class="categorySections">
		<div class="filter btn-reset">
			<h2 class="filter__title">Filters</h2>
			<button class="categorySection__clear" type="button">Clear all</button>
		</div>
		<div class="categorySection">
			<div class="categorySection__top">
				<div class="categorySection__caption">
					<h3 class="categorySection__title">Brands</h3>
					<div class="categorySection__toogle"></div>
				</div>
			</div>
			<div class="categorySection__bottom">
				<ul class="categorySection__list">
					<?php foreach($brandArray as $brand):?>
					<?php if (isset($activeBrands)): ?>
					<?php if (in_array($brand->getId(),$activeBrands)): ?>
					<li class="categorySection__item">
						<label class="customCheckbox">
							<input type="checkbox" name=activeBrands[] value="<?=$brand->getId()?>" checked class="customCheckbox__input">
							<span class="customCheckbox__text"><?=$brand->getTitle()?></span>
						</label>
					</li>
							<?php else: ?>
                                <li class="categorySection__item">
                                    <label class="customCheckbox">
                                        <input type="checkbox" name=activeBrands[] value="<?=$brand->getId()?>"  class="customCheckbox__input">
                                        <span class="customCheckbox__text"><?=$brand->getTitle()?></span>
                                    </label>
                                </li>
							<?php endif; ?>
						<?php else: ?>
                            <li class="categorySection__item">
                                <label class="customCheckbox">
                                    <input type="checkbox" name=activeBrands[] value="<?=$brand->getId()?>" class="customCheckbox__input">
                                    <span class="customCheckbox__text"><?=$brand->getTitle()?></span>
                                </label>
                            </li>
						<?php endif; ?>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
		<div class="categorySection">
			<div class="categorySection__top">
				<div class="categorySection__caption">
					<h3 class="categorySection__title">Sort by</h3>
					<div class="categorySection__toogle"></div>
				</div>
			</div>
			<div class="categorySection__bottom">
				<ul class="categorySection__list">
					<li class="categorySection__item">
						<label class="customCheckbox">
                            <?php if($sortBy==1):?>
							<input type="radio" name="sortBy" value="1" class="customCheckbox__input" checked>
                            <?php else:?>
                            <input type="radio" name="sortBy" value="1" class="customCheckbox__input">
							<?php endif;?>
							<span class="customCheckbox__text">Price: Low-High</span>
						</label>
					</li>
					<li class="categorySection__item">
						<label class="customCheckbox">
							<?php if($sortBy==2):?>
                                <input type="radio" name="sortBy" value="2" class="customCheckbox__input" checked>
							<?php else:?>
                                <input type="radio" name="sortBy" value="2" class="customCheckbox__input">
							<?php endif;?>
							<span class="customCheckbox__text">Price: High-Low</span>
						</label>
					</li>
					<li class="categorySection__item">
						<label class="customCheckbox">
							<?php if($sortBy==3):?>
                                <input type="radio" name="sortBy" value="3" class="customCheckbox__input" checked>
							<?php else:?>
                                <input type="radio" name="sortBy" value="3" class="customCheckbox__input">
							<?php endif;?>
							<span class="customCheckbox__text">Name: A-Z</span>
						</label>
					</li>
					<li class="categorySection__item">
						<label class="customCheckbox">
							<?php if($sortBy==4):?>
                                <input type="radio" name="sortBy" value="4" class="customCheckbox__input" checked>
							<?php else:?>
                                <input type="radio" name="sortBy" value="4" class="customCheckbox__input">
							<?php endif;?>
							<span class="customCheckbox__text">Name: Z-A</span>
						</label>
					</li>
				</ul>
			</div>
		</div>
	</aside>
	<button type="submit" id="filterBtn">Sort !</button>
</form>
