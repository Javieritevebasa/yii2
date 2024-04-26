<?php

use yii\helpers\Html;


?>
<style>
	.containerIframe {
  position: relative;
  overflow: hidden;
  width: 100%;
  padding-top: 56.25%; /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
}

/* Then style the iframe to fit in the container div with full height and width */
.responsive-iframe {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
}
</style>
<div class="dashboard-index">
	<div class="containerIframe">
		<iframe class="responsive-iframe" title="DashboardProducciónDT" width="1140" height="541.25" src="https://app.powerbi.com/reportEmbed?reportId=7e2c0f4f-3cbf-4d4a-be28-74f22a70f0c4&autoAuth=true&ctid=7b9f8988-e1ef-4fd8-8a09-4434b8697059" frameborder="0" allowFullScreen="true"></iframe>
	</div>
</div>