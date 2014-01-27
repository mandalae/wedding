{include file="admin/imagedb/_header.tpl" title="ImageDB"}

<h1>Upload</h1>

<div class="form-element">
    <label for="tags">Key words (Seperated by comma):</label>
    <input type="text" value="" name="tags" id="tags" />
</div>
<br clear="both" style="margin-bottom: 30px;" />
<div style="display: inline-block; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 5px;" id="imageDbButton">
	<span id="spanButtonPlaceholder"></span>
</div>
<div id="divFileProgressContainer"></div>
<div id="thumbnails"> </div>

{include file="admin/imagedb/_footer.tpl"}