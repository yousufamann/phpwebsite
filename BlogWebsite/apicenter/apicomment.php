<?php
require_once '../website/apicenter.php';

?>
<h2 style="text-align: center;">Comment Api</h2>
<br>
<div class="action-buttons">
    <a href="../apicenter/commentapi/insert.php">
        <button class="btn btn-insert">
        <i class="fas fa-plus"></i> Insert
    </button>
    </a>
    <a href="../apicenter/commentapi/update.php">
        <button class="btn btn-update">
        <i class="fas fa-edit"></i> Update
    </button>
    </a>
   <a href="../apicenter/commentapi/delete.php">
     <button class="btn btn-delete">
        <i class="fas fa-trash"></i> Delete
    </button>
   </a>
  <a href="../apicenter/commentapi/select.php">
      <button class="btn btn-select">
        <i class="fas fa-list"></i> Select
    </button>
  </a>
</div>
<?php
require_once '../website/footerapi.php';

?>