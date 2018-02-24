			<div id="sidebar-left" class="col-sm-3 col-md-2 sidebar">
				<ul class="nav nav-sidebar">
					<?php
					foreach($pages as $page_url => $page_name) {
						$active = '';
						if ($page_url == $current_page) {
							$active = ' active';
						}
					?>
					<li class="<?= $active ?>"><a href="<?= $page_url ?>"><?= $page_name ?></a></li>
					<?php } ?>
				</ul>

			</div>

			<a href="javascript:void(0);" id="sidebar-toggle" class="sidebar-toggle-left">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>