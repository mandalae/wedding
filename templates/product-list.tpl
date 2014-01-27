{foreach from=$products item='product'}
    <section>
        <div class="image">
            {if $product['image'] > 0}
                {image id=$product['image'] height="200" width="250"}
            {else}
                <img src="/_gfx/no-image.png" height="200" width="250" />
            {/if}
        </div>
        <div class="product-list-info">{$product['name']}</div>
        <a href="/product/{$product['seo']}" class="product-link button blue">Product information</a>
    </section>
{/foreach}
<div class="pagination">
    {if $previousPage >= 0}
        {if isset($categorySeo)}
            <a href="/category/{$categorySeo}/page/{$previousPage}" class="button black">Previous</a>
        {elseif isset($brandSeo)}
            <a href="/brand/{$brandSeo}/page/{$previousPage}" class="button black">Previous</a>
        {else}
            <a href="/products/page/{$previousPage}" class="button black">Previous</a>
        {/if}
    {/if}
    {if $showMore}
        {if isset($categorySeo)}
            <a href="/category/{$categorySeo}/page/{$nextPage}" class="button black">Next</a>
        {elseif isset($brandSeo)}
            <a href="/brand/{$brandSeo}/page/{$nextPage}" class="button black">Next</a>
        {else}
            <a href="/products/page/{$nextPage}" class="button black">Next</a>
        {/if}
    {/if}
</div>