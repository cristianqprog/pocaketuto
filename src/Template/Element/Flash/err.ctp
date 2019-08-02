<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-danger" role="alert">
    
    <span  class="glyphicon glyphicon-exlamation-sign"   aria-hidden="true"><span>
    	<span class="sr-only">Error:</span>
        
    <?= $message ?>
</div>
