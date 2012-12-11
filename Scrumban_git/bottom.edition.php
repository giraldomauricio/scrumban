<!--Start Bottom Edition -->
<? if ($_GET["do"] == "delete") { ?>
  <a href="#deleteModal" role="button" class="btn btn-danger" data-toggle="modal">Delete</a>
  <?
} else if ($_GET["do"] == "insert") {
  ?>
  <input type="submit" name="Submit" value="Click to insert this record" class="btn btn-info">
  <?
} else {
  ?>
  <input type="submit" name="Submit" value="Click to save these changes" class="btn btn-success">
  <?
}
?>
<div class="modal hide fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Delete</h3>
  </div>
  <div class="modal-body">
    <p>Are you sure you want to delete this record? You cannot undo this.</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <a hreg="#" onclick="document.getElementById('<?=$form_name?>').submit()" class="btn btn-danger">Delete</a>
  </div>
</div>
<!--End Bottom Edition-->