{include file="admin/imagedb/_header.tpl" title="ImageDB"}

{foreach $images as $image}
<div class="imageContainer admin_image">
    {image id=$image->getId() height="135" width="135"}
    <a href="{$image->getPath()}" class="image_view" rel="prettyPhoto">Show<img src="{$image->getPath()}" alt="{$image->getName()}" style="display:none;" /></a>
    <a href="{$image->getId()}" rel="{$image->getPath(80, 80)}" class="js-selectImage">Select</a>
</div>
{/foreach}

{include file="admin/imagedb/_footer.tpl"}